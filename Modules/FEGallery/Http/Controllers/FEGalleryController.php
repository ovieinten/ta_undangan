<?php

namespace Modules\FEGallery\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FEGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Category::all();
        $data = Product::all();
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'product_photos.url as product_url',
                'categories.name as category_name',
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
            ->where('products.status', '=', 'publish');
        $row = 0;
        $heroFill = [
            'name' => 'Gallery'
        ];
        $data = $data->paginate(12);
        //return $data;
        return view('fegallery::index', compact('data', 'heroFill', 'row'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('fegallery::create');
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
        return view('fegallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('fegallery::edit');
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
