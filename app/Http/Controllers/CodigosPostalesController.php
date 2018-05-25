<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use DEISA\Codigo_postal;
use Illuminate\Support\Facades\DB;

class CodigosPostalesController extends Controller
{
    protected function obtenCodigoPostal($codigoPostal){
    	return DB::select("CALL obten_codigo_postal(?)", [ $codigoPostal ]);
    }

    protected function obtenAsentamientos($codigoPostal, $estado, $municipio){
    	return Codigo_postal::where(['codigo_postal' => $codigoPostal, 'estado' => $estado, 'municipio' => $municipio])->orderBy('asentamiento')->pluck('asentamiento');
    }    
}
