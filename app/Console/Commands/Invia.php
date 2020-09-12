<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\Cache\ItemInterface;
use App\Laptop;

class Invia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Invia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invia al database il mio array';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // require __DIR__ . '/vendor/autoload.php';

        // funzione che usa le regex per estrapolare i dati
        function findSpeed($pattern, $stringa)
        {
            preg_match("/$pattern/i", $stringa, $matches);

            return implode(",", $matches);
        }



        $cache = new FilesystemAdapter('cache', 3600, __DIR__);

        $client = new Client();

        $searchResultHtml = $cache->get('my_cache_key', function (ItemInterface $item) use ($client) {
            $item->expiresAfter(3600);

            $result = $client->post('https://www.notebookcheck.net/Laptop_Search.8223.0.html', [
                'form_params' => [
                    'lang'    => '2',
                    'class'   => '-1',
                    'age'     => '1',
                    'orderby' => '0',
                ]
            ]);

            return $result->getBody()->getContents();
        });

        $searchResultCrawler = new Crawler($searchResultHtml);

        // array dove vado a pushare i link estratti dal crawler
        $laptopSheetLinks = [];

        // mi estraggo i link
        $searchResultCrawler
            ->filter('#search')
            ->filter('tr a')
            ->each(function (Crawler $crawler) use (&$laptopSheetLinks) {
                $href = $crawler->attr('href');
                if ($href !== '#nbc_nbcompare_div') {
                    $laptopSheetLinks[] = $href;
                }
            });

        echo 'Trovati ' . count($laptopSheetLinks) . " links\n\n";

        // array dove vado a pushare i singoli laptop
        $specifications = [];


        foreach ($laptopSheetLinks as $link) {

            echo "Working on {$link}\n";

            $cacheKey = md5($link);

            $pageResultHtml = $cache->get("link_{$cacheKey}", function (ItemInterface $item) use ($client, $link) {
                $item->expiresAfter(3600);

                $result = $client->get($link);

                return $result->getBody()->getContents();
            });

            $pageResultCrawler = new Crawler($pageResultHtml);

            // array dove pusho i dati dei miei laptop
            $laptopDetails = [];

            // Codice per tirare fuori i dati

            // estraggo ID univoco
            $id_laptop = $link;
            $id_laptop_regex = findSpeed('\d\d\d\d\d\d', $id_laptop);
            $laptopDetails['laptop_id'] = $id_laptop_regex;

            // estraggo il nome
            $laptopDetails['name'] = $pageResultCrawler->filter('.specs_header')->first()->text();

            // estraggo il brand
            $laptopDetails['brand'] = strtok($pageResultCrawler->filter('h1')->first()->text(), " ");

            // estraggo la ram
            $ram_memory = $pageResultCrawler->filter('.specs_element')->eq(2)->text();
            $ram_memory_regex = findSpeed('\d{4,6}', $ram_memory);
            $laptopDetails['ram_memory'] = $ram_memory_regex;

            // estraggo la scheda madre
            $motherboard = $pageResultCrawler->filter('.specs_element')->eq(4)->children('.specs_details')->text();
            $laptopDetails['motherboard'] = $motherboard;

            // estraggo scheda di rete
            $network = $pageResultCrawler->filter('.specs_element')->eq(8)->children('.specs_details')->text();
            $laptopDetails['network'] = $network;

            // estraggo connessioni
            $connections = $pageResultCrawler->filter('.specs_element')->eq(7)->children('.specs_details')->text();
            $laptopDetails['connections'] = $connections;

            // estraggo la CPU
            //    uso if in quanto se non trova risultati va in errore
            if ($pageResultCrawler->filter('.specs_element')->eq(0)->children('.specs_details a')->count() > 0) {
                $laptopDetails['cpu_brand'] = $pageResultCrawler->filter('.specs_element')->eq(0)->children('.specs_details a')->text();
            }

            // estraggo dimensioni display
            $display_size = $pageResultCrawler->filter('.specs_element')->eq(3)->children('.specs_details')->text();
            $display_size_regex = findSpeed('\d\d\.?\d?', $display_size);
            $laptopDetails['display_size'] = $display_size_regex;

            // estraggo storage
            $storage_size = $pageResultCrawler->filter('.specs_element')->eq(5)->children('.specs_details')->text();
            $storage_size_regex = findSpeed('\s\d{3,4}', $storage_size);
            $laptopDetails['storage_size'] = $storage_size_regex;

            // estraggo scheda video
            $laptopDetails['video_card'] = $pageResultCrawler->filter('.specs_element')->eq(1)->children('.specs_details a')->text();

            // estraggo batteria
            try {
                $battery_life = $pageResultCrawler->filter('.nbc_additional_specs .specs_element')->eq(4)->children('.specs_details')->text();
                $battery_life_regex = findSpeed('\d\d\.?\d?', $battery_life);
                $laptopDetails['battery'] = $battery_life_regex;
            } catch (Throwable $e) {
                echo 'Eccezione: ' . $e->getMessage();
            }

            // estraggo peso laptop
            try {
                $laptop_weight = $pageResultCrawler->filter('.specs_element')->eq(14)->children('.specs_details')->text();
                $laptop_weight_regex = findSpeed('\d\.\d\d?\d?', $laptop_weight);
                $laptopDetails['weight'] = $laptop_weight_regex;
            } catch (Throwable $e) {
                echo 'Eccezione: ' . $e->getMessage();
            }



            $specifications[] = $laptopDetails;

//            var_dump($laptopDetails);
//
//            die();

        }



        // faccio un foreach per salvare i dati nel mio database
        foreach ($specifications as $specification) {
            $new_laptop = new Laptop();
            $new_laptop->fill($specification);
            // skippo gli elementi gia esistenti
            if (Laptop::where('name', '=', $new_laptop->name)->exists()) {
                continue;
            }
            $risultato = $new_laptop->save();
        }


        // faccio il print sul terminale di avvenuta scrittura
        if (isset($risultato)) {
            $this->info('Push avvenuto con successo');
        } else {
            $this->info('Push non avvenuto, probabilmente ci sono duplicati');
        }


        return '';
    }
}
