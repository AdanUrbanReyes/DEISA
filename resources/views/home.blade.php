@extends('principal')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Menus' }}
@endsection

@section('csss')
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
@endsection

@section('contenido')
    <div class="centrado_vertical" >
        <div id="menu" class="container">
            <hr>
            <div class="row" style="color:#3D0078;">
                <div class="col-sm-4">
                    <h2 class="text-center text-uppercase"><b>!Bienvenido!</b></h2>
                </div>
                <div class="col-sm-4" style="">
                    <h2 class="text-capitalize text-center">{{ Auth::user()->name }} {{Auth::user()->primer_apellido}} {{Auth::user()->segundo_apellido}}</h2>
                </div>
                <div class="col-sm-4" style="">
                    <h2 class="text-center">{{ Auth::user()->puesto }} de {{ Auth::user()->departamento }}</h2>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($menus as $menu)
                    <a href="{{ route($menu->ruta) }}" class="col-md-3 col-sm-4 col-xs-12 text-center menu">
                        <h4 class="text-uppercase">{{ $menu->titulo }}</h4>
                        <img alt="{{$menu->descripcion}}" class="img-fluid menu" src="{{asset('imagenes/menus/' . $menu->imagen)}}"/>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
