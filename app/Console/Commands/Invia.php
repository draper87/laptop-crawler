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

// funzione che estrapola stringhe, non utilizzata al momento
        function findSpeed($pattern, $stringa)
        {
            preg_match("/$pattern/i", $stringa, $matches);

//    if (isset($matches[1])) {
//        $speed = (int)$matches[1];
//        var_dump($speed);
//    }

            return implode(",", $matches);
        };




        $cache = new FilesystemAdapter('cache', 10, __DIR__); // riportare 10 a 3600

        $client = new Client();

        $searchResultHtml = $cache->get('my_cache_key', function (ItemInterface $item) use ($client) {
            $item->expiresAfter(10); // riportare 10 a 3600

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

        $laptopSheetLinks = [];

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

            $laptopDetails = [];

            // Codice per tirare fuori i dati
            $laptopDetails['name'] = $pageResultCrawler->filter('.specs_header')->first()->text();

            $laptopDetails['brand'] = strtok($pageResultCrawler->filter('h1')->first()->text(), " ");
            $ram_memory = $pageResultCrawler->filter('.specs_element')->eq(2)->text();
            $ram_memory_regex = findSpeed('\d{4,6}', $ram_memory);
            $laptopDetails['ram_memory'] = $ram_memory_regex;
            //    uso il metodo if in quanto se non trova risultati va in errore
            if ($pageResultCrawler->filter('.specs_element')->eq(0)->children('.specs_details a')->count() > 0) {
                $laptopDetails['cpu_brand'] = $pageResultCrawler->filter('.specs_element')->eq(0)->children('.specs_details a')->text();
            }
            $display_size = $pageResultCrawler->filter('.specs_element')->eq(3)->children('.specs_details')->text();
            $display_size_regex = findSpeed('\d\d\.?\d?', $display_size);
            $laptopDetails['display_size'] = $display_size_regex;
            $storage_size = $pageResultCrawler->filter('.specs_element')->eq(5)->children('.specs_details')->text();
            $storage_size_regex = findSpeed('\s\d{3,4}', $storage_size);
            $laptopDetails['storage_size'] = $storage_size_regex;
            $laptopDetails['video_card'] = $pageResultCrawler->filter('.specs_element')->eq(1)->children('.specs_details a')->text();
            $battery_life = $pageResultCrawler->filter('.nbc_additional_specs .specs_element')->eq(4)->children('.specs_details')->text();
            $battery_life_regex = findSpeed('\d\d\.?\d?', $battery_life);
            $laptopDetails['battery'] = $battery_life_regex;
            $laptop_weight = $pageResultCrawler->filter('.specs_element')->eq(14)->children('.specs_details')->text();
            $laptop_weight_regex = findSpeed('\d\.\d\d?\d?', $laptop_weight);
            $laptopDetails['weight'] = $laptop_weight_regex;


            $specifications[] = $laptopDetails;

            var_dump($laptopDetails);

            die();

        }

        foreach ($specifications as $specification) {
            $new_laptop = new Laptop();
            $new_laptop->fill($specification);
            // skippo gli elementi gia esistenti
            if (Laptop::where('name', '=', $new_laptop->name)->exists()) {
                continue;
            }
            $risultato = $new_laptop->save();
        }



        if (isset($risultato)) {
            $this->info('Push avvenuto con successo');
        } else {
            $this->info('Push non avvenuto, probabilmente ci sono duplicati');
        }


        return '';
    }
}
