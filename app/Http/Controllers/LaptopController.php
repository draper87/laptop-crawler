<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laptop;

class LaptopController extends Controller
{
    public function index() {

        $laptops = Laptop::all();

        return view('laptop.index', compact('laptops'));
    }


}
