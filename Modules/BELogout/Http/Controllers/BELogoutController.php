<?php

namespace Modules\BELogout\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BELogoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
