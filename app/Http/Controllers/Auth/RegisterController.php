<?php

namespace App\Http\Controllers\Auth;

use App\agent;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'phone' => ['required', 'string', 'max:13', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:255', 'confirmed'],
        ],[
            'email.unique'=>'هذا البريد الألكنرونى مسجل بالفعل',
            'phone.unique'=> 'رقم الجوال مسجل بالفعل',

            'password.min'=>'الرقم السري يجب أن يكون أكثر من 8 أحرف',
            'password.max'=>'الرقم السري يجب أن لا يكون أكثر من 255 أحرف',
            'password.confirmed'=>' تأكيد الرقم السرى غير مطابق ',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return agent::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => ['phone'],
            'password' => Hash::make($data['password']),

        ]);
    }
}
