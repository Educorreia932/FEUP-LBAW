<?php

namespace App\Http\Controllers\Admin\Auth;

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
     * Where to redirect after login
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        return view('auth.admin_login');
    }


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


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|exists:admin',
            'password' => 'required|max:125'
        ]);

        // determine login type (email | username)
        $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];

        // attempt authentication with the given credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.home'));
        }

        return back()->withErrors([
            'credentials' => 'Wrong username or password.',
        ])->withInput();
    }

}
