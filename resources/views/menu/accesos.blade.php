@extends('principal')
	
@section('metadatos')
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('titulo')
    {{ config('app.name', 'DEISA') . ':Accesos' }}
@endsection

@section('csss')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/accesos.css') }}">
@endsection

@section('contenido')
	<div class="centrado_vertical">
		<div class="container menu">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<div class="form-group row">
						<label for="deptarmento" class="col-3 col-form-label text-right">Departamento:</label>
						<div class="col-9">
	                        <select id="deptarmento" name="departamento" class="form-control" onfocus="departamento_focus(this);" onblur="departamento_onblur(this)" required>
	                        	@foreach($departamentos as $d)
	                        		<option value="{{ $d->nombre }}" >{{ $d->nombre }}</option>
	                        	@endforeach
	                        </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
                    <div class="form-group row">
                        <label for="puesto" class="col-3 col-form-label text-right">Puesto:</label>
                        <div class="col-9">
	                        <select id="puesto" name="puesto" class="form-control" required>
	                        </select>                        	
                        </div>
                    </div>
				</div>
				<div class="col-md-1">
	                <button id="buscar" class="btn btn-success" type="button">
	                    <img src="{{asset('imagenes/buscar.png')}}" class="img-fluid crud">
	                </button>
	                <button id="cancelar" class="btn btn-outline-secondary" type="button" hidden>
	                    <img src="{{asset('imagenes/multiplicacion.png')}}" class="img-fluid crud">
	                </button>		                
				</div>
			</div>
			<div class="row" style="margin-top: 31px;">
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<h2 class="text-center" style="color:#59111E;">Menus sin acceso</h2>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<h2 class="text-center" style="color:#034525;">Menus con acceso</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<div id="menus_sin_acceso" class="list-group">
					</div>
				</div>
				<div class="col-md-1 centrado_vertical" style="min-height: 100%;">
					<div class="row">
		                <button id="agregar" class="btn btn-outline-success administracion" type="button" hidden>
		                    <img src="{{asset('imagenes/agregar.png')}}" class="img-fluid">
		                </button>
		                <button id="quitar" class="btn btn-outline-danger administracion" type="button" hidden>
		                    <img src="{{asset('imagenes/quitar.png')}}" class="img-fluid">
		                </button>
	                </div>
				</div>
				<div class="col-md-5">
					<div id="menus_con_acceso" class="list-group">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('after_load_scripts')
	<script type="text/javascript">
		var assetImagenesMenus = "{{ asset('imagenes/menus/') }}" + '/';
	</script>
	<script type="text/javascript" src="{{ asset('js/accesos.js') }}"></script>
@endsection