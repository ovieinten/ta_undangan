<?php

namespace Modules\BELogin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Alert;

class BELoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/b/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function index()
    {   
        return view('belogin::index');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        if ($request->expectsJson()) {

            return response()->json($errors, 422);
        }
        Alert::error('email atau password tidak sesuai.', 'Login Gagal')->persistent('Close');
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

}
