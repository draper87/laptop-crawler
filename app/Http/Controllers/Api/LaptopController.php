<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Videocard;
use Illuminate\Http\Request;
use App\Laptop;
use Illuminate\Database\Eloquent\Builder;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        // inizializzo la mia query
        $queryLaptop = Laptop::query(); // inizializzo la mia query al database

        // restituisco solamente i risultati con la scheda video selezionata
        if ($videoCardName = $request->get('video_card')){
            if ($request->input('videocardChecked') == 1) { // stampo anche le videocards con performance migliori
                $query_video_card = Videocard::query()->where('name','=',$videoCardName)->get();
                $query_video_card_element = $query_video_card->get('0');
                $query_video_card_score = $query_video_card_element['score'];
                $queryLaptop->whereHas('videocard',function (Builder $builder) use($query_video_card_score){
                   $builder->where('score','>=',$query_video_card_score);
                });
            } else { // stampo solamente la videocard selezionata
                $queryLaptop->where('videocard_name', $videoCardName);
            }
        }

        // restituisco solamente i risultati con i # CoresCPU selezionati
        if ($cpuCores = $request->get('cpu')) {
            if ($request->input('coresChecked') == 1) { // stampo anche i # cores superiori
                $queryLaptop->selectRaw("*")
                    ->join('cpus', 'cpus.name', '=', 'laptops.cpu_name')
                    ->where('cores', '>=', $cpuCores);

            } else { // stampo solo i # cores selezionati
                $queryLaptop->selectRaw("*")
                    ->join('cpus', 'cpus.name', '=', 'laptops.cpu_name')
                    ->where('cores', '=', $cpuCores);

            }
        }

        // restituisco solamente i risultati con la ram selezionata
        if ($ram_memory = $request->get('ram')) {
            if ($request->input('ramchecked') == 1) { // stampo anche i quantitativi di ram maggiori
                $queryLaptop->where('ram_memory', '>=' , $ram_memory);
            }
            elseif ($request->input('ramchecked') == 0) { // stampo solo il quantitativo di ram selezionato
                $queryLaptop->where('ram_memory', $ram_memory);
            }
        }


        // restituisco solamente i risultati con il display size selezionato
        if ($displaySize = $request->get('display')){
            $displaySize_array = explode(",", $displaySize); // displaysize è una stringa, uso explode per ottenere un array di 2 numeri
            $display1 = floatval($displaySize_array[0]); // trasformo il valore in un integer
            $display2 = floatval($displaySize_array[1]); // trasformo il valore in un integer
            $queryLaptop->whereBetween('display_size', [$display1, $display2]);
        }

        // restituisco solamente i risultati con il peso selezionato
        if ($laptop_weight = $request->get('mySliderWeight')) {
            $laptop_weight_array = explode(",", $laptop_weight);
            $laptop_weight_array_1 = intval($laptop_weight_array[0]);
            $laptop_weight_array_2 = intval($laptop_weight_array[1]);
            $queryLaptop->whereBetween('weight',[$laptop_weight_array_1, $laptop_weight_array_2]);
        }

        // restituisco solamente i risultati con il prezzo selezionato
        if ($price = $request->get('price')){
            $price_array = explode(",", $price); // price è una stringa, uso explode per ottenere un array di 2 numeri
            $price1 = intval($price_array[0]); // trasformo il valore in un integer
            $price2 = intval($price_array[1]); // trasformo il valore in un integer
            $queryLaptop->whereBetween('price', [$price1, $price2]);
        }


        $queryLaptop->with(['Cpu', 'Videocard']);

        return $queryLaptop->paginate(15);
    }
}

