<?php

namespace CRMApp\Http\Controllers\Auth;

use CRMApp\User;
use CRMApp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/respuesta';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Generar Codigo
     * @param  array  $longitud
     * @return $key
     */
    function generarCodigo($longitud){
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0; $i < $longitud; $i++) $key .= $pattern{mt_rand(0, $max)};
        return $key;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \CRMApp\User
     */
    protected function create(array $data)
    {
        $code = $this->generarCodigo(10);
        $email = $data['email'];
        $dates = array('name'=> $data['name'], 'code' => $code);
        $this->Email($dates, $email);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'code' => $code,
            //'password' => Hash::make($data['password']),
        ]);
    }


    /**
     * Mensaje de confirmacion.
     *
     */
    function Email($dates, $email)
    {
        Mail::send('emails.plantilla', $dates, function($message) use ($email){
            $message->subject('Bienvenido');
            $message->to($email);
            $message->from('no-reply@bantek.com.pe', 'Bantek');
        });
    }
}
