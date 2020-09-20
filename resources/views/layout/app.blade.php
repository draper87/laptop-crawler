<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laptop Easy</title>
    <link rel="stylesheet" href="css/lc_switch.css">
    <link rel="stylesheet" href="css/rSlider.min.css">
    <link href="css/app.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>

@include('partials.navbar')

@yield('section')

        </main>
    </div>

@include('partials.footer')

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('js/rSlider.min.js') }}"></script>
<script src="{{ asset('js/lc_switch.min.js') }}"></script>
<script src="js/app.js"></script>

</body>
</html>
