@extends('principal')

@section('titulo')
    {{ config('app.name', 'DEISA') }}
@endsection

@section('csss')
    <link rel="stylesheet" type="text/css" href="{{asset('css/carrusel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/servicios.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/navegacion.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/articulos_interes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/acreditaciones.css')}}">
@endsection

@section('contenido')
    @include('pagina_principal.cuerpo')
    @include('pie_pagina')
@endsection