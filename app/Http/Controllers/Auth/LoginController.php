<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function login(Request $request)
    {
        //Error messages
        $messages = [
            'email.email' => "الأيميل غير صحيح",
            'email.exists' => "الحساب غير مسجل ,يرجى التأكد من الأيميل",
            'password.min' => "الرقم السرى يجب ان يكون 6 أحرف على الأقل"
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt([ 'email' => $request->email, 'password' => $request->password ], $request->remember)) {
                // if successful -> redirect forward
                return redirect()->to('/');
            }
            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'password' => 'كلمة مرور خاطئة',
            ]);
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
