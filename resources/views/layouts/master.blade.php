<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Kigen system for traceablity algri">
        <meta name="author" content="Nguyen Duc Nhan">
        <title>Truy xuất nguồn gốc nông sản</title>
        
        <link href="/source/assets/img/brand/favicon.png" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="/source/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="/source/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href="/source/assets/css/argon.css?v=1.0.1" rel="stylesheet">
        <link rel="stylesheet" href="/source/assets/css/reset.css">
	    <link rel="stylesheet" href="/source/assets/css/style.css">
        
        <script src="/source/assets/js/modernizr.js"></script>
        <script src="/source/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/source/assets/vendor/popper/popper.min.js"></script>
        <script src="/source/assets/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="/source/assets/vendor/headroom/headroom.min.js"></script>
        <script src="/source/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="/source/assets/js/argon.js?v=1.0.1"></script>
    </head>  
    <body>
        @include('layouts.header')
        <main>
            @include('layouts.success-message')
            @yield('content')
        </main>
        @include('layouts.footer')
        @yield('script')
    </body>
</html>
