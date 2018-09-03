<?php

namespace Modules\FELogin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class FELoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $heroFill = [
            'name' => 'Login'
        ];

        return view('felogin::index', compact('heroFill'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
//
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
//
        if ($this->attemptLogin($request)) {
//            return $request->all();
            return $this->sendLoginResponse($request);
        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
//
        return $this->sendFailedLoginResponse($request);
    }
}