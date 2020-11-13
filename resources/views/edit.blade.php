<h2>Modifica Laptop {{$laptop->name}}</h2>

<!-- inizio form -->
<form action="{{ route('laptop.update' , $laptop) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

    <div>
        <img src="{{asset('storage') . '/' . $laptop->image_path}}" alt="">
    </div>

<!-- inizio input immagine -->
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="image_path">Carica immagine</label><br>
            <input type="file" name="image_path" placeholder="Image_path" accept="image/*">
        </div>
    </div>
    <!-- fine input immagine -->

    <!-- inizio button -->
    <div class="form-group row">
        <div class="offset-lg-10 col-lg-2">
            <input class="btn btn-success" type="submit" value="Invia i dati">
        </div>
    </div>
    <!-- fine button -->
</form>
