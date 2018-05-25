@extends('principal')

@section('titulo')
{{ config('app.name', 'DEISA') . ':Clientes' }}
@endsection

@section('csss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/clientes.css') }}">
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
	<form id="usuarios" class="container menu{{ count($errors) != 0 ? ' was-validated' : '' }}" method="POST" action="{{ route('clientes') }}" novalidate>
		{{ csrf_field() }}
		<input id="_method" type="hidden" name="_method" value="POST">
		<div id="informacion_general" class="seccion">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="numero" class="control-label">Numero:</label>
						<div class="input-group">
							<input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}" maxlength="9" autofocus>
							<span class="input-group-btn">
								<button id="buscar_cliente" class="btn btn-success" type="button">
									<img src="{{asset('imagenes/buscar.png')}}" class="img-fluid crud">
								</button>
								<button id="cancelar_cliente" class="btn btn-outline-secondary" type="button" hidden>
									<img src="{{asset('imagenes/multiplicacion.png')}}" class="img-fluid crud">
								</button>
							</span>
						</div>
						<small class="invalid-feedback">{{ $errors->first('numero') }}</small>
					</div>		        		
				</div>
				<div class="col-md-4">
					<div class="form-group text-left" style="margin-top: 33px;">
						<button id="monitorear" class="btn btn-outline-secondary" type="button">
							<img src="{{asset('imagenes/menus/monitoreo.png')}}" class="img-fluid crud">
						</button>	        				
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
				<div class="col-md-4">
					<div class="form-group">
						<label for="tipo" class="control-label">Tipo:</label>
						<div class="input-group">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-outline-success active">
									<input type="radio" name="tipo" id="matriz" autocomplete="off" value="Matriz" checked>Matriz
								</label>
								<label class="btn btn-outline-info">
									<input type="radio" name="tipo" id="sucursal" autocomplete="off" value="Sucursal">Sucursal
								</label>
							</div>
						</div>
						<small class="invalid-feedback">{{ $errors->first('tipo') }}</small>
					</div>		        		
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="razon_social" class="control-label">Razon Social:</label>
						<input id="razon_social" type="text" class="form-control" name="razon_social" value="{{ old('razon_social') }}" maxlength="150" required>
						<small class="invalid-feedback">{{ $errors->first('razon_social') }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="planta" class="control-label">Planta:</label>
						<input id="planta" type="text" class="form-control" name="planta" value="{{ old('planta') }}" maxlength="150" required>
						<small class="invalid-feedback">{{ $errors->first('planta') }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="empresa" class="control-label">Empresa:</label>
						<input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" maxlength="150" required>
						<small class="invalid-feedback">{{ $errors->first('empresa') }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="giro" class="control-label">Giro:</label>
						<input id="giro" type="text" class="form-control" name="giro" value="{{ old('giro') }}" maxlength="100" required>
						<small class="invalid-feedback">{{ $errors->first('giro') }}</small>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="estado_cliente" class="control-label">Estado:</label>
						<select id="estado_cliente" name="estado_cliente" class="form-control" required>
		                @foreach($estados as $e)
		                	<option value="{{$e}}"> {{ $e }} </option>
		                @endforeach
						</select>
						<small class="invalid-feedback">{{ $errors->first('estado_cliente') }}</small>
					</div>
				</div>	        		
			</div>	        		        	
		</div>
		<div id="direccion" class="seccion">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="codigo_postal" class="control-label">Codigo Postal:</label>
						<div class="input-group">
							<input id="codigo_postal" type="text" class="form-control" name="codigo_postal" value="{{ old('codigo_postal') }}" minlength="5" maxlength="5" required>
							<span class="input-group-btn">
								<button id="buscar_codigo_postal" class="btn btn-success" type="button">
									<img src="{{asset('imagenes/buscar.png')}}" class="img-fluid crud">
								</button>
								<button id="cancelar_codigo_postal" class="btn btn-outline-secondary" type="button" hidden>
									<img src="{{asset('imagenes/multiplicacion.png')}}" class="img-fluid crud">
								</button>
							</span>
						</div>
						<small class="invalid-feedback">{{ $errors->first('codigo_postal') }}</small>
					</div>		        		
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="estado_direccion" class="control-label">Estado:</label>
						<input id="estado_direccion" type="text" class="form-control" name="estado_direccion" value="{{ old('estado_direccion') }}" maxlength="40" required readonly>
						<small class="invalid-feedback">{{ $errors->first('estado_direccion') }}</small>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="municipio" class="control-label">Municipio:</label>
						<select id="municipio" name="municipio" class="form-control" required>
							
						</select>
						<small class="invalid-feedback">{{ $errors->first('municipio') }}</small>
					</div>	        			
				</div>	        		
				<div class="col-md-3">
					<div class="form-group">
						<label for="asentamiento" class="control-labe654654l">Asentamiento:</label>
						<select id="asentamiento" name="asentamiento" class="form-control" required>

						</select>
						<small class="invalid-feedback">{{ $errors->first('asentamiento') }}</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="calle" class="control-label">Calle:</label>
						<input id="calle" type="text" class="form-control" name="calle" value="{{ old('calle') }}" maxlength="70" required>
						<small class="invalid-feedback">{{ $errors->first('calle') }}</small>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="numero_exterior" class="control-label">Numero exterior:</label>
						<input id="numero_exterior" type="text" class="form-control" name="numero_exterior" value="{{ old('numero_exterior') }}" maxlength="4" required>
						<small class="invalid-feedback">{{ $errors->first('numero_exterior') }}</small>
					</div>		        		
				</div>	        		
				<div class="col-md-4">
					<div class="form-group">
						<label for="numero_interior" class="control-label">Numero interior:</label>
						<input id="numero_interior" type="text" class="form-control" name="numero_interior" value="{{ old('numero_interior') }}" maxlength="4">
						<small class="invalid-feedback">{{ $errors->first('numero_interior') }}</small>
					</div>		        		
				</div>
			</div>
		</div>
		<div id="informacion_adiccional" class="seccion">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="rfc" class="control-label">RFC:</label>
						<input id="rfc" type="text" class="form-control" name="rfc" value="{{ old('rfc') }}" maxlength="13">
						<small class="invalid-feedback">{{ $errors->first('rfc') }}</small>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="proveedor" class="control-label">Proveedor:</label>
						<input id="proveedor" type="text" class="form-control" name="proveedor" value="{{ old('proveedor') }}" maxlength="20">
						<small class="invalid-feedback">{{ $errors->first('proveedor') }}</small>
					</div>		        		
				</div>	        		
				<div class="col-md-4">
					<div class="form-group">
						<label for="sae" class="control-label">SAE:</label>
						<input id="sae" type="text" class="form-control" name="sae" value="{{ old('sae') }}" maxlength="9">
						<small class="invalid-feedback">{{ $errors->first('sae') }}</small>
					</div>		        		
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<table class="table table-hover table-sm table-responsive">
						<thead>
							<tr>
								<th>Numero contacto</th>
								<th>Tipo</th>
								<th>
									<button id="agregar_numero_contacto" class="btn btn-outline-info" type="button">
										<img src="{{asset('imagenes/sumar.png')}}" class="img-fluid crud">
									</button>
								</th>
							</tr>
						</thead>
						<tbody id="numeros_contacto">

						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-hover table-sm table-responsive">
						<thead>
							<tr>
								<th>Correo electronico</th>
								<th>Tipo</th>
								<th>
									<button id="agregar_correo_electronico" class="btn btn-outline-info" type="button">
										<img src="{{asset('imagenes/sumar.png')}}" class="img-fluid crud">
									</button>
								</th>
							</tr>
						</thead>
						<tbody id="correos_electronicos">

						</tbody>
					</table>
				</div>	        		
			</div>
		</div>
	</form>
</div>
@endsection

@section('after_load_scripts')
<script type="text/javascript">
	var assetImagenes = "{{ asset('imagenes/') }}" + '/';
</script>
<script type="text/javascript" src="{{ asset('js/clientes.js') }}"></script>
@endsection