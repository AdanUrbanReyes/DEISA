<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DEISA\Area;
use DEISA\Enums\Alerta;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.areas');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'nombre' => 'required|string|max:50' . (($data['accion'] == 'guardar') ? '|unique:area' : ''),
            'departamento' => 'required|string|max:30',
            'supervisor' => 'required|string|email|max:191'
        ]);
    }

    protected function obtenAutocompletadoNombreArea($nombre){
        return Area::where('departamento', Auth::user()->departamento)->where('nombre', 'LIKE', $nombre . '%')->orderBy('nombre')->pluck('nombre');
    }

    protected function crear(Request $request)
    {
        $this->validator($request->all())->validate();
        if( Area::create($request->all()) ){
            $e = Alerta::Exito;
            $e['mensaje'] = 'Area creada correctamente :D';
        }else{
            $e = Alerta::Peligro;
        }
        return redirect()->route('areas')->with('estatus', $e);
    }

    protected function buscar($nombre){
        //return Area::find($nombre);
        return Area::where('departamento', Auth::user()->departamento)->where('nombre', $nombre)->first();
    }

    protected function actualizar(Request $request, $nombre)
    {
        if( Area::find($nombre)->update($request->all()) ){
            $e = Alerta::Exito;
            $e['mensaje'] = 'Area actualizada correctamente :D';
        }else{
            $e = Alerta::Peligro;
        }
        return redirect()->route('areas')->with('estatus', $e );
    }
}
