<?php

namespace Auxys\Http\Controllers\Auth;

use Auxys\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     public function login(Request $request)
    {

        //dd($request);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended($this->redirectPath());
        }


        else{
            // $rules = [
            //     'username' => 'required',
            //     'password' => 'required',
            // ];

            // $messages = [
            //     'username.required' => 'El Nombre de usuario es requerido',
            //     'password.required' => 'La Contraseña es requerida',
            // ];

            // $validator = Validator::make($request->all(), $rules, $messages);

            return redirect('login');
            // ->withErrors($validator)
            // ->withInput()
         } 
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
