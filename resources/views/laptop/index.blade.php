@extends('laptop.layout.app')

@section('title')
    Laptop Finder
@endsection

@section('titolo')
    Laptop Finder
@endsection


@section('section')
<main>
    <form name="modulo">
        <select name="video_card" id="videocard">
            <option value="" selected>Choose your videocard</option>
            @foreach ($videocards as $videocard)
                <option value="{{ $videocard->name }}">{{ $videocard->name }}</option>
            @endforeach
        </select>

        <select name="ram_memory" id="ram_memory">
            <option value="" selected>Choose your ram</option>

            // per evitare duplicati nella select della Ram uso array_unique
            // cosa che non ho fatto nelle altre select perchè non ne hanno bisogno in quanto prendono i dati
            // dal loro model, forse è il caso di creare una model anche per la Ram?
            @php
                foreach ($laptops as $laptop){
                    $array[] = $laptop->ram_memory;
                    $array_unique = array_unique($array);
                }

                sort($array_unique);
            @endphp
            @foreach ($array_unique as $ram) {
                 <option value="{{ $ram }}">{{ $ram }}</option>
            @endforeach
        </select>


        <select name="cpu" id="cpu">
            <option value="" selected>Choose your cpu</option>
            @foreach ($cpus as $cpu)
                <option value="{{ $cpu->name }}">{{ $cpu->name }}</option>
            @endforeach
        </select>

        <input type="text" id="sliderdisplay" class="slider" hidden><br>

        <input type="text" id="sliderprice" class="slider" hidden><br>

        <input type="button" id="bottone" value="Invia i dati">
    </form>

    <div class="lista">

    </div>


    <script id="entry-template" type="text/x-handlebars-template">
        <div class="laptop">
            <li>@{{name}}</li>
            <li>@{{brand}}</li>
            <li>@{{videocard_name}}</li>
            <li>@{{ cpu_name }}</li>
            <li>@{{ display_size }}</li>
            <li>@{{ price }}</li>
            <li>@{{ ram_memory }}</li>
        </div>
    </script>


</main>
@endsection





