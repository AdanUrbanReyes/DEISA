<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DEISA\Cliente;
use DEISA\Direccion;
use DEISA\Enums\Alerta;

class ClientesController extends Controller
{

	private $estados;
	private $e;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$this->estados = Cliente::select('estado')->groupBy('estado')->pluck('estado');
    	return view('menu.clientes')->with('estados', $this->estados);
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
    		'numero' => (($data['accion'] != 'guardar') ? 'digits_between:1,9|required' : ''),
    		'razon_social' => 'required|string|max:150',
    		'planta' => 'required|string|max:150',
    		'empresa' => 'required|string|max:150',
    		'giro' => 'required|string|max:100',
    		'rfc' => 'nullable|string|max:13',
    		'sae' => 'nullable|digits_between:1,9',
    		'proveedor' => 'nullable|string|max:20',
    		'tipo' => 'required|string|max:13|exists:cliente,tipo',
    		'estado_cliente' => 'required|string|max:13|exists:cliente,estado',

    		'codigo_postal' => 'required|digits:5|exists:codigo_postal,codigo_postal',
    		'estado_direccion' => 'required|string|max:40',
    		'municipio' => 'required|string|max:60',
    		'asentamiento' => 'required|string|max:70',
    		'calle' => 'required|string|max:70',
    		'numero_exterior' => 'required|digits_between:1,3',
    		'numero_interior' => 'nullable|digits_between:1,3',
    	]);
    }

    protected function crear(Request $request)
    {
    	$c = $request->all();
    	$this->validator($c)->validate();
    	DB::transaction(function ($cliente) use ($c) {
    		try{
    			//$d = Direccion::create($cliente);
    			//$cliente['numero'] = null;
    			//$cliente['direccion'] = $d->id;
    			//$cliente['estado'] = $cliente['estado_cliente'];
    			//Cliente::create($cliente);
				$this->e = Alerta::Exito;
				$this->e['mensaje'] = $cliente;
    			//$this->e['mensaje'] = $d . '|' . $cliente;
    		}catch(\Exception $exp){
				$this->e = Alerta::Informacion;
				$this->e['mensaje'] = $exp;
    		}
    	});
    	return $this->e['mensaje'];
    	return redirect()->route('clientes')->with('estatus', $this->e)->with('estados', $this->estados);
    }

    protected function buscar($numero){
    	return Cliente::find($numero);
    }

    protected function actualizar(Request $request, $numero)
    {
    	if( Area::find($nombre)->update($request->all()) ){
    		$e = Alerta::Exito;
    		$e['mensaje'] = 'Area actualizada correctamente :D';
    	}else{
    		$e = Alerta::Peligro;
    	}
    	return redirect()->route('areas')->with('estatus', $e );
    }


    protected function eliminar($numero){
    	$data = $request->all();
    	return Puesto_accesa_menu::where('departamento', $data['departamento'])->where('puesto', $data['puesto'])->where('menu', $data['menu'])->delete();
    }

}
