@extends('principal')

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Perfil' }}
@endsection

@section('csss')
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
@endsection

@section('contenido')
	@if( session()->has('estatus') )
		<?php
			$e = session('estatus');
		?>
		<div class="alert {{$e['clase']}} alert-dismissible fade show" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		  <strong>{{ $e['estatus'] }}</strong> {{ $e['mensaje'] }}
		</div>
	@endif
	<div class="centrado_vertical">
	    <form id="usuarios" class="container{{ $errors->has('email') || $errors->has('password') || $errors->has('name') || $errors->has('primer_apellido') || $errors->has('segundo_apellido') || $errors->has('puesto') ? ' was-validated' : '' }}" method="POST" action="{{ route('perfil') . '/' . Auth::user()->email }}" enctype="multipart/form-data" novalidate>
	        {{ csrf_field() }}
	        <input id="_method" type="hidden" name="_method" value="PUT">
	        <div class="row menu">
	            <div class="col-md-6">
	                <div class="form-group text-center center">
	                    <input type="file" class="form-control-file" id="archivo" name="archivo" accept="image/*" aria-describedby="fileHelp">
	                    <img src="{{ (Storage::disk('public')->exists('avatars/' . explode('@', Auth::user()->email)[0]))  ? asset('storage/avatars/' . explode('@', Auth::user()->email)[0] ) : asset('imagenes/avatar.png') }}" id="avatar" id="avatar" class="img-fluid" style="width: 100%; height: 400px;">
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
	                        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required readonly>
	                        <small class="invalid-feedback">{{ $errors->first('email') }}</small>
	                    </div>
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
	                    <input id="name" type="text" class="form-control" pattern="[A-Za-z ]+" title="Solo se aceptan letras y espacios" name="name" value="{{ (old('name')) ? old('name') : Auth::user()->name }}" required>
	                    <small class="invalid-feedback">{{ $errors->first('name') }}</small>
	                </div>
	                <div class="form-group">
	                    <label for="primer_apellido" class="control-label">Primer apellido:</label>
	                    <input id="primer_apellido" type="text" class="form-control" pattern="[A-Za-z]+" title="Solo se aceptan letras" name="primer_apellido" value="{{ (old('primer_apellido')) ? old('primer_apellido') : Auth::user()->primer_apellido }}" required>
	                    <small class="invalid-feedback">{{ $errors->first('primer_apellido') }}</small>
	                </div>
	                <div class="form-group">
	                    <label for="segundo_apellido" class="control-label">Segundo apellido:</label>
	                    <input id="segundo_apellido" type="text" class="form-control" pattern="[A-Za-z]+" title="Solo se aceptan letras" name="segundo_apellido" value="{{ (old('segundo_apellido')) ? old('segundo_apellido') : Auth::user()->segundo_apellido }}" required>
	                    <small class="invalid-feedback">{{ $errors->first('segundo_apellido') }}</small>
	                </div>
	                <div class="form-group">
	                    <label for="puesto" class="control-label">Puesto:</label>
	                    <select id="puesto" name="puesto" class="form-control" required readonly>
	                    	<option value="{{ Auth::user()->puesto }}" selected> {{ Auth::user()->puesto }} </option>
	                    </select>
	                    <small class="invalid-feedback">{{ $errors->first('puesto') }}</small>
	                </div>
	                <div class="form-group text-right">
	                    <button id="modificar" type="submit" class="btn btn-warning" value="modificar" name="accion">
	                        <img src="{{asset('imagenes/modificar.png')}}" class="img-fluid crud">
	                    </button>
	                </div>                        
	            </div>
	        </div>
	    </form>
	</div>
@endsection

@section('after_load_scripts')
	<script type="text/javascript" src="{{ asset('js/archivos.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/perfil.js') }}"></script>
@endsection