<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = DB::select("CALL obten_menus_con_acceso(?, ?)", [Auth::user()->departamento, Auth::user()->puesto]);
        return view('home', ['menus' => $menus]);
    }
}
