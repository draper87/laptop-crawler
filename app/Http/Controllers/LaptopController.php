<?php

namespace App\Http\Controllers;

use App\Videocard;
use Illuminate\Http\Request;
use App\Laptop;
use App\Cpu;

class LaptopController extends Controller
{
    public function index()
    {

        $laptops = Laptop::all();
        $videocards = Videocard::query()->orderBy('name', 'asc')->get();
        $cpus = Cpu::all();

        return view('index', compact('laptops', 'videocards', 'cpus'));
    }

    public function show(Laptop $laptop)
    {

        return view('show', compact('laptop'));

    }


}
