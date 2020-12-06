@extends('layout.app')

@section('title')
    Laptop Easy
@endsection


@section('section')

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="page-header-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-header-title">{{$laptop->name}}</h1>
                        <p class="page-header-text mb-5">The {{$laptop->name}} is equipped with {{$laptop->ram_memory}}Gb of Ram, a {{$laptop->display_size}}" monitor, and
                        it costs {{$laptop->price}}$</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="svg-border-rounded text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                 fill="currentColor">
                <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
            </svg>
        </div>

    </header>


    <section id="show" class="bg-white py-5">

        {{--        Contenuto         --}}
        <div class="container">

            <div class="box-product mb-3">

                <div class="left-box">
                    @if(isset($laptop->image_path))
                        <img src="{{asset('storage') . '/' . $laptop->image_path}}" alt="laptop">
                    @else
                        <img src="{{asset('storage') . '/' . 'images/laptop.jpg'}}" alt="laptop">
                    @endif
                </div>
                <div class="right-box">

                    <div id="laptop-info" class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Brand: {{$laptop->brand}}</li>
                            <li class="list-group-item list-group-item-dark">Motherboard: {{$laptop->motherboard}}</li>
                            <li class="list-group-item">Display size: {{$laptop->display_size}}"</li>
                            <li class="list-group-item list-group-item-dark">Ram: {{$laptop->ram_memory}} Gb</li>
                            <li class="list-group-item">Storage: {{$laptop->storage_size}} Gb</li>
                            <li class="list-group-item list-group-item-dark">Battery: {{$laptop->battery}} Wh</li>
                            <li class="list-group-item">Weight: {{$laptop->weight}} Kg</li>
                        </ul>
                    </div>


                </div>

            </div>

            <div class="box-product mb-3">

                <div id="cpu-info" class="box card pt-5">

                    <div class="text-center">
                        <img src="{{asset('storage') . '/' . 'images/cpu.png'}}" alt="cpu">
                    </div>
                    <ul class="list-group list-group-flush pt-5 text-center">
                        <li class="list-group-item">{{$laptop->cpu_name}}</li>
                        <li class="list-group-item list-group-item-dark"># Cores: {{$laptop->cpu->cores}}</li>
                    </ul>

                </div>

                <div id="videocard-info" class="box card pt-5">

                    <div class="text-center">
                        <img src="{{asset('storage') . '/' . 'images/gpu.png'}}" alt="cpu">
                    </div>

                    <ul class="list-group list-group-flush pt-5 text-center">
                        <li class="list-group-item">{{$laptop->videocard_name}}</li>
                        <li class="list-group-item list-group-item-dark">Passmark Score: {{$laptop->videocard->score}}
                            <span class="float-right" data-toggle="tooltip" data-placement="top"
                                  title="Show the score of the video card based on the Passmark benchmark. The higher the better."><img
                                    src="{{asset('storage') . '/' . 'images/info.png'}}" alt="info"></span></li>
                    </ul>

                </div>

                <div id="price" class="box card pt-5">

                    <div class="text-center">
                        <img src="{{asset('storage') . '/' . 'images/dollar-sign.png'}}" alt="cpu">
                    </div>

                    <h5 class="text-center font-weight-bold pt-5">{{$laptop->price}}</h5>
                </div>



            </div>

            <div class="box-product">

                <div id="max-temperature" class="box card pt-4">

                    <div id="thermometer" class="box-image">
                        <div class="thermo-container">
                            <div class="outer-circle">
                                <div class="middle-circle">
                                    <div class="inner-circle">
					                    <span class="top">27</span>
                                        <span class="mid">90</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-list">
                        <ul class="list-group list-group-flush pt-4 text-center">
                            <li class="list-group-item">Chassis Max Temperature</li>
                            <li class="list-group-item list-group-item-dark font-weight-200">Sotto i 40 il laptop risulta confortevole se appoggiato
                                sulle gambe</li>
                        </ul>
                    </div>



                </div>

                <div id="max-noise" class="box card pt-4">

                    <div class="box-image text-center">
                        <img src="{{asset('storage') . '/' . 'images/fan.png'}}" alt="cpu">

                        <h5 class="text-center font-weight-bold pt-2">40 db</h5>
                    </div>



                    <div class="box-list">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Laptop Max Loudness</li>
                            <li class="list-group-item list-group-item-dark font-weight-200">Sotto i 40 il laptop risulta confortevole se appoggiato
                                sulle gambe</li>
                        </ul>
                    </div>


                </div>

                <div id="motherboard-info" class="box card pt-5">

                    <div class="text-center">
                        <img src="{{asset('storage') . '/' . 'images/ethernet.png'}}" alt="cpu">
                    </div>

                    <ul class="list-group list-group-flush pt-4 text-center">

                        <li class="list-group-item">Network</li>
                        <li class="list-group-item list-group-item-dark font-weight-300">{{$laptop->network}}</li>
                    </ul>

                </div>


            </div>


        </div>

        <div class="svg-border-rounded text-light">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                 fill="currentColor">
                <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
            </svg>
        </div>

    </section>


    <section class="bg-light py-10">
        <div class="container">
            <div class="row align-items-center justify-content-center">
            </div>
        </div>
    </section>

    <hr class="m-0"/>


@endsection

<link rel="stylesheet" href="{{asset('css/show.css')}}">
<link rel="stylesheet" href="{{asset('css/thermometer.css')}}">




