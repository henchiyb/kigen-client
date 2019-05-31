<!doctype html>
<html lang="{{ app()->getLocale() }}">
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
        {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
        
        <script src="/source/assets/js/modernizr.js"></script>
        <script src="/source/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/source/assets/vendor/popper/popper.min.js"></script>
        <script src="/source/assets/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="/source/assets/vendor/headroom/headroom.min.js"></script>
        <script src="/source/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="/source/assets/js/argon.js?v=1.0.1"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>    

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

   <style>
        #weatherWidget .currentDesc {
            color: #ffffff!important;
        }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
    </style>
    </head>  
    <body>
        @include('layouts.header')
        <main>
            @include('layouts.success-message')
            @include('layouts.error-message')
            @yield('content')
        </main>
        @include('layouts.footer')
        @yield('script')
    </body>
</html>
