<?php

namespace DEISA\Http\Controllers\Auth;

use DEISA\User;
use DEISA\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \DEISA\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'primer_apellido' =>  $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'departamento' => $data['departamento'],
            'puesto' => $data['puesto']
        ]);
    }

    protected function obtenPuestos($departamento){
        return DB::select("CALL obten_puestos(?)", [$departamento]);
    }

    protected function obtenAutocompletadoEmailUsuarios($email){
        return User::where('departamento', Auth::user()->departamento)->where('email', 'LIKE', $email . '%')->orderBy('email')->pluck('email');
    }

    protected function buscar($email){
        return User::find($email);
    }

    protected function update(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::find($data['email'])->update($data);
    }

    protected function delete($email){
        $u = User::find($email);
        $u->estado = 'Inactivo';
        return $u->save();
    }

}
