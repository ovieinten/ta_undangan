<?php

namespace Modules\BEDashboard\Http\Controllers;

use App\Models\Product;
use App\Models\Creation;
use App\Models\Order;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Alert;

class BEDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['product'] = Product::all()->count();
        $data['creation'] = Creation::all()->count();
        $data['order'] = Order::all()->count();
        $data['sale'] = Sale::all()->count();

        $user = auth()->user();
        if ($user->role_id != 1){
            \Illuminate\Support\Facades\Auth::logout();
            Alert::error('email atau password tidak sesuai.', 'Login Gagal')->persistent('Close');
            return redirect()->route('login');
        }
        return view('bedashboard::index' , compact('user','data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bedashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bedashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('bedashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
