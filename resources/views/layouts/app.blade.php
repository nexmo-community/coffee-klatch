<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coffee Klatch</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <style>


    </style>
</head>
<body>
<header class="masthead"></header>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="main-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><h1 class="display-2 text-white">CK</h1></a>
    </div>
</nav>
<div class="container" id="main-content">
    @yield('content')
</div>
@yield('scripts')
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>