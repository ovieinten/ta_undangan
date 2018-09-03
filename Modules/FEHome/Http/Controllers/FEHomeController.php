<?php

namespace Modules\FEHome\Http\Controllers;

use App\Models\ProductPhoto;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;

class FEHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Discount::all();
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'products.slug as product_slug',
                'product_photos.url as product_url',
                'categories.name as category_name',
                'discounts.percent as discount_percent'
            ])
            ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
            ->where('status', '=', 'publish')
            ->groupBy('product_id')->limit(6)
            ->get();
        // return $data;
        return view('fehome::index', compact('data','user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('fehome::create');
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
        return view('fehome::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('fehome::edit');
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
