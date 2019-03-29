<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as IlluminateRequest ;

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

    //sobreescribimos este metodo username para devolver y utenticar el username y no el email en la DB
    public function username()
    {
        return 'username';
    }

    //aqui en esta funcion preguntamos si el request posee el valor de redirec_to 
    //creamos la variable redirect_to cuando redirigimos la pag hacia login 
    public function showLoginForm(IlluminateRequest $request)
    {
        if ($request->has('redirect_to')) {
            session()->put('redirect_to',$request->input('redirect_to'));
        }
        return view('auth.login');
    }

    // ahora en esta funcion preguntamos si existe la variable redirecto
    //vamos a redirigir al usuario a dicha variable,con pull logramos eso y luego la eliminamos
    //la variable si no ingresa al if mandamos al usuario al valor que posee la variable redirecTo
    public function redirectTo()
    {
        if (session()->has('redirect_to')) {
            return session()->pull('redirect_to');
        }
        return $this->redirectTo;
    }
}
