@extends('laptop.layout.app')

@section('title')
    Laptop Finder
@endsection

@section('titolo')
    Laptop Finder
@endsection


@section('section')


    <form name="modulo">
        <select name="video_card" id="videocard">
            @foreach ($laptops as $laptop)
                <option value="{{ $laptop->video_card }}">{{ $laptop->video_card }}</option>
            @endforeach
        </select>
        <input type="button" id="bottone" value="Invia i dati">
    </form>

    <div class="lista">

    </div>


    <script id="entry-template" type="text/x-handlebars-template">
        <div class="laptop">
            <li>@{{name}}</li>
            <li>@{{brand}}</li>
            <li>@{{video_card}}</li>
        </div>
    </script>



@endsection

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>


