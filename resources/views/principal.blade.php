<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Ayan">
        <meta name="description" content="Laboratorio de analisis para aguas residuales, alimentos, aguas potables, chimeneas. etc.">
        <meta name="keywords" content="laboratorio, analisis, aguas residuales, aguas potables, alimentos, sangre, chimeneas, emisiones a la atmosfera">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('metadatos')
        <!-- CSRF Token <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <title>@yield('titulo')</title>
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{asset('css/general.css')}}">
        @yield('csss')
        @yield('before_load_scripts')
    </head>
    <body>
        @include('encabezado')
        @yield('contenido')
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap3-typeahead.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/general.js') }}"></script>
        @yield('after_load_scripts')
    </body>
</html>