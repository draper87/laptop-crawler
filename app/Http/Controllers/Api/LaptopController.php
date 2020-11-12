<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Laptop;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        // inizializzo la mia query
        $query = Laptop::query(); // inizializzo la mia query al database

        // restituisco solamente i risultati con la scheda video selezionata
        if ($videoCardName = $request->get('video_card')){
            $query->where('videocard_name', $videoCardName);
        }

        // restituisco solamente i risultati con la CPU selezionata
        if ($cpuName = $request->get('cpu')){
            $query->where('cpu_name', $cpuName);
        }

        // restituisco solamente i risultati con la ram selezionata
        if ($ram_memory = $request->get('ram')) {
            if ($request->input('ramchecked') == 1) { // stampo anche i quantitativi di ram maggiori
                $query->where('ram_memory', '>=' , $ram_memory);
            }
            elseif ($request->input('ramchecked') == 0) { // stampo solo il quantitativo di ram selezionato
                $query->where('ram_memory', $ram_memory);
            }
        }


        // restituisco solamente i risultati con il display size selezionato
        if ($displaySize = $request->get('display')){
            $displaySize_array = explode(",", $displaySize); // displaysize è una stringa, uso explode per ottenere un array di 2 numeri
            $display1 = floatval($displaySize_array[0]); // trasformo il valore in un integer
            $display2 = floatval($displaySize_array[1]); // trasformo il valore in un integer
            $query->whereBetween('display_size', [$display1, $display2]);
        }

        // restituisco solamente i risultati con il prezzo selezionato
        if ($price = $request->get('price')){
            $price_array = explode(",", $price); // price è una stringa, uso explode per ottenere un array di 2 numeri
            $price1 = intval($price_array[0]); // trasformo il valore in un integer
            $price2 = intval($price_array[1]); // trasformo il valore in un integer
            $query->whereBetween('price', [$price1, $price2]);
        }





//        if ($request->has('cpu_id')){
//            $cpu = Cpu::find($request->get('cpu_id'));
//
//            $query->whereHas('cpu', function ($query) use ($cpu) {
//                // Query sul model CPU
//                return $query->where('score', '>=', $cpu->score);
//            });
//        }
//
//
//        if ($request->has('ram')){
//            $query->where('ram',  $request->get('ram'));
//        }

//        $query->with(['Cpu', 'Videocard']);

         return $query->paginate(15);
    }
}

