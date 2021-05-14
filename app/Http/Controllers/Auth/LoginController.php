<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller {
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
     * Where to redirect users after lo gin.
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        $this->middleware('guest')->except('logout');
    }

    public function getUser($request) {
        return $request->user();
    }


    public function home() {
        return redirect('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        // determine login type (email | username)
        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$login_type => $request->input('email'), 'password' => $request->input('password')];

        // attempt authentication with the given credentials
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->back();
        }

        return back()->withErrors([
            'credentials' => 'Wrong username or password.',
        ])->withInput();
    }

}
