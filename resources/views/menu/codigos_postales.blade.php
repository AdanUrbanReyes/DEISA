@extends('principal')

@section('titulo')
    {{ config('app.name', 'DEISA') . ':' }}
@endsection

@section('csss')

@endsection

@section('contenido')
	<div class="centrado_vertical">
	    <form id="usuarios" class="container menu{{ $errors->has('email') || $errors->has('password') ? ' was-validated' : '' }}" method="POST" action="{{ route('areas') }}" novalidate>
	        {{ csrf_field() }}
	        <input id="_method" type="hidden" name="_method" value="POST">
	        <div class="row">
	        	
	        </div>
	    </form>
	</div>
@endsection

@section('after_load_scripts')

@endsection