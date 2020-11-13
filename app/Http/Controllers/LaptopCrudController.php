<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laptop;


class LaptopCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Laptop $laptop
     * @return void
     */
    public function edit(Laptop $laptop)
    {
        return view('edit',compact('laptop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Laptop $laptop
     * @return void
     */
    public function update(Request $request, Laptop $laptop)
    {
        $requested_data = $request->all();

        if (isset($requested_data['image_path'])) {
            $path = $request->file('image_path')->store('images', 'public');
            $requested_data['image_path'] = $path;
        }

        $laptop->update($requested_data);

        if ($laptop) {
            return redirect()->route('laptop.edit', $laptop);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
