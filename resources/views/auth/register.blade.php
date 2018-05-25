@extends('principal')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Usuarios' }}
@endsection

@section('csss')
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
@endsection

@section('contenido')
<div class="centrado_vertical">
    <form id="usuarios" class="container{{ $errors->has('email') || $errors->has('password') || $errors->has('name') || $errors->has('primer_apellido') || $errors->has('segundo_apellido') || $errors->has('puesto') ? ' was-validated' : '' }}" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"  novalidate>
        {{ csrf_field() }}
        <input id="_method" type="hidden" name="_method" value="POST">
        <div class="row menu">
            <div class="col-md-6">
                <div class="form-group text-center center">
                    <input type="file" class="form-control-file" id="archivo" name="archivo" accept="image/*" aria-describedby="fileHelp">
                    <img src="{{asset('imagenes/avatar.png')}}" id="avatar" id="avatar" class="img-fluid" style="width: 100%; height: 400px;">
                    <small id="fileHelp" class="form-text text-muted">Selecciona tu imagen de perfil</small>
                </div>
                <div class="form-group">
                    <label for="departamento" class="control-label">Departamento:</label>
                    <input id="departamento" type="text" class="form-control" name="departamento" value="{{ Auth::user()->departamento }}" required readonly>
                    <small class="invalid-feedback">{{ $errors->first('departamento') }}</small>
                </div>
            </div>                    
            <div class="col-md-6">                        
                <div class="form-group">
                    <label for="email" class="control-label">Correo electronico:</label>
                    <div class="input-group">
                        <input id="email" type="email" class="form-control typeahead" name="email" value="{{ old('email') }}" data-provide="typeahead" required autofocus>
                        <span class="input-group-btn">
                            <button id="buscar" class="btn btn-success" type="button">
                                <img src="{{asset('imagenes/buscar.png')}}" class="img-fluid crud">
                            </button>
                            <button id="cancelar" class="btn btn-outline-secondary" type="button" hidden>
                                <img src="{{asset('imagenes/multiplicacion.png')}}" class="img-fluid crud">
                            </button>
                        </span>
                    </div>
                    <small class="invalid-feedback">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Contrasena:</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" required>
                        <span class="input-group-btn">
                            <button id="mostrar" class="btn btn-outline-info" type="button">
                                <img src="{{asset('imagenes/mostrar.png')}}" class="img-fluid crud">
                            </button>
                        </span>                                
                    </div>
                    <small class="invalid-feedback">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Nombre:</label>
                    <input id="name" type="text" class="form-control" pattern="[A-Za-z ]+" title="Solo se aceptan letras y espacios" name="name" value="{{ old('name') }}" required>
                    <small class="invalid-feedback">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group">
                    <label for="primer_apellido" class="control-label">Primer apellido:</label>
                    <input id="primer_apellido" type="text" class="form-control" pattern="[A-Za-z]+" title="Solo se aceptan letras" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
                    <small class="invalid-feedback">{{ $errors->first('primer_apellido') }}</small>
                </div>
                <div class="form-group">
                    <label for="segundo_apellido" class="control-label">Segundo apellido:</label>
                    <input id="segundo_apellido" type="text" class="form-control" pattern="[A-Za-z]+" title="Solo se aceptan letras" name="segundo_apellido" value="{{ old('segundo_apellido') }}" required>
                    <small class="invalid-feedback">{{ $errors->first('segundo_apellido') }}</small>
                </div>
                <div class="form-group">
                    <label for="puesto" class="control-label">Puesto:</label>
                    <select id="puesto" name="puesto" class="form-control" required>

                    </select>
                    <small class="invalid-feedback">{{ $errors->first('puesto') }}</small>
                </div>
                <div class="form-group text-right">
                        <button id="guardar" type="submit" class="btn btn-primary" value="guardar" name="accion">
                            <img src="{{asset('imagenes/guardar.png')}}" class="img-fluid crud">
                        </button>
                        <button id="modificar" type="submit" class="btn btn-warning" value="modificar" name="accion" hidden>
                            <img src="{{asset('imagenes/modificar.png')}}" class="img-fluid crud">
                        </button>
                        <button id="eliminar" type="submit" class="btn btn-danger" value="eliminar" name="accion" hidden>
                            <img src="{{asset('imagenes/eliminar.png')}}" class="img-fluid crud">
                        </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('after_load_scripts')
<script type="text/javascript" src="{{ asset('js/archivos.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/register.js') }}"></script>
@endsection