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
                        <h1 class="page-header-title">Find your best laptop</h1>
                        <p class="page-header-text mb-5">Welcome to Laptop Easy, a simple yet powerful search engine to
                            find out the best laptop according to your needs, whether they're gaming, business or
                            creative.</p>
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


    <section id="show" class="bg-white py-10">

        {{--        Contenuto         --}}
        <div class="container">

            <h2 class="text-center">{{$laptop->name}}</h2>

            <div class="box-product">

                <div class="left-box">
                    @if(isset($laptop->image_path))
                    <img src="{{asset('storage') . '/' . $laptop->image_path}}" alt="laptop">
                    @else
                    <img src="{{asset('storage') . '/' . 'images/laptop.jpg'}}" alt="laptop">
                    @endif
                </div>
                <div class="right-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi corporis doloribus eaque error
                        eum, facilis inventore ipsum laborum maxime necessitatibus non obcaecati quia quos rerum totam
                        ut voluptate voluptatum!</p>

                    <div class="product-list">
                        <span class="grey-span bold">Brand: {{$laptop->brand}}</span>
                        <span>Cpu: {{$laptop->cpu_name}}</span>
                        <span class="grey-span"># Cores: {{$laptop->cpu->cores}} </span>
                        <span>Ram: {{$laptop->ram_memory}} Gb</span>
                        <span class="grey-span">Motherboard: {{$laptop->motherboard}}</span>
                        <span>Network: {{$laptop->network}}</span>
                        <span class="grey-span">Connections: {{$laptop->connections}}</span>
                        <span>Display size: {{$laptop->display_size}}"</span>
                        <span class="grey-span">Storage: {{$laptop->storage_size}} Gb</span>
                        <span>Videocard: {{$laptop->videocard_name}}</span>
                        <span class="grey-span">Passmark Score: {{$laptop->videocard->score}}</span>
                        <span>Battery: {{$laptop->battery}}</span>
                        <span class="grey-span">Weight: {{$laptop->weight}} Kg</span>
                        <span>Price: {{$laptop->price}} $</span>

                    </div>


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




