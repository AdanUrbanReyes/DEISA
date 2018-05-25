<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DEISA\Departamento;
use DEISA\Puesto_accesa_menu;


class AccesosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.accesos', [ 'departamentos' => Departamento::all(['nombre']) ]);
    }

	protected function obtenPuestos($departamento){
        return DB::select("CALL obten_puestos(?)", [$departamento]);
    }

    protected function obtenerMenusConAcceso($departamento, $puesto){
        return DB::select("CALL obten_menus_con_acceso(?, ?)", [ $departamento, $puesto ]);   
    }


    protected function obtenerMenusSinAcceso($departamento, $puesto){
        return DB::select("CALL obten_menus_sin_acceso(?, ?)", [ $departamento, $puesto ]);
    }

    public function agregar(Request $request){
        return Puesto_accesa_menu::create($request->all());
    }

    public function quitar(Request $request){
        $data = $request->all();
        return Puesto_accesa_menu::where('departamento', $data['departamento'])->where('puesto', $data['puesto'])->where('menu', $data['menu'])->delete();

    }


}
