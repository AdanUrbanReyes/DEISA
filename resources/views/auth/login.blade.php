@extends('principal')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Inicio Sesion' }}
@endsection

@section('contenido')
    <div class="centrado_vertical" >
        <form id="inicio_sesion" style="background: url( {{ asset('imagenes/inicioSesion/fondoEstandar.jpg') }} ); width: 400px; height: 500px; margin: 0 auto; color: blue;     box-shadow: 7px 11px #CCCCCC;" class="container{{ $errors->has('email') || $errors->has('password') ? ' was-validated' : '' }}"  method="POST" action="{{ route('login') }}" novalidate>
        {{ csrf_field() }}
                <div style="margin-top: 200px;" class="form-group">
                    <label for="email" class="control-label">Correo electronico:</label>
                    <input id="email" style="background-color: transparent; color: blue;" type="email" class="form-control text-lowercase" name="email" value="{{ old('email') }}" required autofocus>
                    <small class="invalid-feedback">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Contrasena:</label>
                    <input id="password" style="background-color: transparent; color: blue;" type="password" class="form-control" name="password" required>
                    <small class="invalid-feedback">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">E n t r a r</button>
                </div>
                <div class="form-group text-right">
                    <a class="btn btn-link" style="color: #F3D23E;" href="{{ route('password.request') }}">Olvidaste tu contrasena?</a>
                </div>
        </form>
    </div>
@endsection