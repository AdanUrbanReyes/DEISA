@extends('principal')

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Areas' }}
@endsection

@section('csss')

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
	    <form id="areas" class="container menu{{ $errors->has('nombre') || $errors->has('departamento') || $errors->has('supervisor') ? ' was-validated' : '' }}" method="POST" action="{{ route('areas') }}" novalidate>
	        {{ csrf_field() }}
	        <input id="_method" type="hidden" name="_method" value="POST">
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label for="nombre" class="control-label">Nombre:</label>
	        			<div class="input-group">
	        				<input id="nombre" type="text" class="form-control typeahead" name="nombre" value="{{ old('nombre') }}" data-provide="typeahead" required autofocus>
	        				<span class="input-group-btn">
	        					<button id="buscar" class="btn btn-success" type="button">
	        						<img src="{{asset('imagenes/buscar.png')}}" class="img-fluid crud">
	        					</button>
	        					<button id="cancelar" class="btn btn-outline-secondary" type="button" hidden>
	        						<img src="{{asset('imagenes/multiplicacion.png')}}" class="img-fluid crud">
	        					</button>
	        				</span>
	        			</div>
	        			<small class="invalid-feedback">{{ $errors->first('nombre') }}</small>
	        		</div>
	        	</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="departamento" class="control-label">Departamento:</label>
						<select id="departamento" name="departamento" class="form-control" required>
							<option value="{{ Auth::user()->departamento }}" selected> {{ Auth::user()->departamento }}</option>
						</select>
						<small class="invalid-feedback">{{ $errors->first('departamento') }}</small>
					</div>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label for="supervisor" class="control-label">Supervisor:</label>
	        			<input id="supervisor" type="email" class="form-control typeahead" name="supervisor" value="{{ old('supervisor') }}" data-provide="typeahead" required>
	        			<small class="invalid-feedback">{{ $errors->first('supervisor') }}</small>
	        		</div>	        		
	        	</div>
				<div class="col-md-6" style="margin-top: 31px;">
					<div class="form-group text-right">
						<button id="guardar" type="submit" class="btn btn-primary" value="guardar" name="accion">
							<img src="{{asset('imagenes/guardar.png')}}" class="img-fluid crud">
						</button>
						<button id="modificar" type="submit" class="btn btn-warning" value="modificar" name="accion" hidden>
							<img src="{{asset('imagenes/modificar.png')}}" class="img-fluid crud">
						</button>
					</div>	        		
	        	</div>
	        </div>	        
	    </form>
	</div>
@endsection

@section('after_load_scripts')
	<script type="text/javascript" src="{{ asset('js/areas.js') }}"></script>
@endsection