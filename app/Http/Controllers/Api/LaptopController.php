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
        $query = Laptop::query();

        // restituisco solamente i risultati con la scheda video selezionata
        if ($videoCardId = $request->get('video_card')){
            $query->where('video_card', $videoCardId);
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

//        $query->with(['cpu', 'videoCard']);

        return $query->get();
        //return $query->paginate(20);
    }
}

