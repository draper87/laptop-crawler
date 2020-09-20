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
                        <p class="page-header-text mb-5">Welcome to Laptop Easy, a simple yet powerful search engine to find out the best laptop according to your needs, whether they're gaming, business or creative.</p>

                        {{-- Sezione relativa al form --}}
                        <form>

                            <div class="mb-3">
                              <select class="w-50 js-basic-single-videocard" name="video_card" id="videocard">
                                    <option></option>
                                    @foreach ($videocards as $videocard)
                                        <option value="{{ $videocard->name }}">{{ $videocard->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pr-2 pl-2">Or better</span>
                                <input class="bettercheckbox" type="checkbox" name="sample" value="1" />
                                </div>

                            <div class="mb-3">
                                <select class="w-50 js-basic-single-cpu" name="cpu" id="cpu">
                                    <option></option>
                                    @foreach ($cpus as $cpu)
                                        <option value="{{ $cpu->name }}">{{ $cpu->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pr-2 pl-2">Or better</span>
                                <input class="bettercheckbox" type="checkbox" name="sample" value="1" />
                            </div>

                            <div>
                                <select class="w-25 js-basic-multiple-ram" name="ram_memory" id="ram_memory" multiple="multiple">


                                    {{--    per evitare duplicati nella select della Ram uso array_unique--}}
                                    {{--    cosa che non ho fatto nelle altre select perchè non ne hanno bisogno in quanto prendono i dati--}}
                                    {{--    dal loro model, forse è il caso di creare una model anche per la Ram?--}}
                                    @php
                                        foreach ($laptops as $laptop){
                                            $array[] = $laptop->ram_memory;
                                            $array_unique = array_unique($array);
                                        }

                                        sort($array_unique);
                                    @endphp
                                    @foreach ($array_unique as $ram) {
                                    <option value="{{ $ram }}">{{ $ram }}Gb</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5"><label for="sliderdisplay">Display Size</label><input type="text" id="sliderdisplay" class="slider" hidden></div>

                            <div class="mt-5"><label for="sliderprice">Price Range (USD)</label><input type="text" id="sliderprice" class="slider" hidden></div>

                            <input class="mt-5 btn btn-teal btn-marketing rounded-pill lift lift-sm" id="bottone" value="Search">
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="svg-border-rounded text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
        </div>
    </header>


    <section class="bg-white py-10">
        <div class="container">


                <div class="lista row text-center">
                </div>

        </div>
        <div class="svg-border-rounded text-light">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
        </div>
    </section>


    <section class="bg-light py-10">
        <div class="container">
            <div class="row align-items-center justify-content-center">
            </div>
        </div>
    </section>

    <hr class="m-0" />
@endsection

{{--          Sezione relativa ad Handlebars             --}}
<script id="entry-template" type="text/x-handlebars-template">
    <div class="laptop col-lg-4 mb-5 mb-lg-5">
        <a class="card lift h-100" href="#"><div class="card-flag card-flag-dark card-flag-top-right">@{{ price }}$</div>
            <img class="card-img-top" src="/assets/img/laptop.jpg" alt="...">
            <div class="card-body">
                <h3 class="text-primary mb-0">@{{brand}}</h3>
                <div class="small text-gray-800 font-weight-500">@{{name}}</div>
                <div class="small text-gray-500">Videocard: @{{videocard_name}}</div>
                <div class="small text-gray-500">Cpu: @{{cpu_name}}</div>
                <div class="small text-gray-500">Display: @{{display_size}}"</div>
                <div class="small text-gray-500">Ram: @{{ram_memory}}"</div>
            </div>
            <div class="card-footer bg-transparent border-top d-flex align-items-center justify-content-between">
                <div class="small text-gray-500">View listing</div>
                <div class="small text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></div></div></a>
    </div>
</script>

<script type="text/javascript" src="{{ asset('js/rSlider.min.js') }}"></script>
