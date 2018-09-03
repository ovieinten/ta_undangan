<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
//            dd(Auth::user()->role_id);
//            dd(Auth::user()->role_id == 1);
            if(Auth::user()->role_id == 1){
                return redirect('/b/dashboard');
            } else {
                return redirect('/');
            }
//            if(auth()->user()->role_id == 1) {
//                return redirect('/b/dashboard');
//            } else {
//                return redirect('/');
//            }
        }

        return $next($request);
    }
}
