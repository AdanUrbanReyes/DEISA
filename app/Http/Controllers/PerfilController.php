<?php

namespace DEISA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DEISA\Enums\Alerta;
use DEISA\User;

class PerfilController extends Controller
{


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:191' . (($data['accion'] == 'guardar') ? '|unique:users' : ''),
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:30',
            'primer_apellido' => 'required|string|max:30',
            'segundo_apellido' => 'required|string|max:30',
            'departamento' => 'required|string|max:30',
            'puesto' => 'required|string|max:10'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.perfil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        $u = $request->all();
        $this->validator($u)->validate();
        if (isset( ($request->all())['archivo'] )){
            Storage::putFileAs('avatars', $request->file('archivo'), explode('@', ($request->all())['email'])[0], 'public');
        }        
        $u['password'] = bcrypt($u['password']);
        if( User::find($email)->update($u) ){
            $e = Alerta::Exito;
            $e['mensaje'] = 'Perfil actualizado correctamente :D';
        }else{
            $e = Alerta::Peligro;
        }
        return redirect()->route('perfil')->with('estatus', $e);
    }

}
