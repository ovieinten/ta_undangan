<?php

namespace Modules\FEProduct\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;
use Illuminate\Support\Facades\DB;
use Cart;

class FEProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $heroFill = [
            'name' => 'Produk'
        ];
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'products.slug as product_slug',
                'product_photos.url as product_url',

            ])
            ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
            //->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
            ->where('status', '=', 'publish')
            ->groupBy('product_id');

        $data = $data->paginate(6);
        return view('feproduct::index' , compact('data' , 'heroFill', 'row'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('feproduct::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    public function categories($pageName)
    {
        $static = [
            'undangan-murah' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Murah',
                'id' => '1',
            ],
            'undangan-mewah' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Mewah',
                'id' => '2',
            ],
            'undangan-soft-cover' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Soft Cover',
                'id' => '3',
            ],
            'undangan-hard-cover' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Hard Cover',
                'id' => '4',
            ],
            'undangan-promo' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Promo',
                'id' => '5',
            ],
            'undangan-unik' => [
                'view' => 'feproduct::categories',
                'heroName' => 'Undangan Unik',
                'id' => '6',
            ],
        ];

        $pushData = null;

        $tmpName = [];

        foreach ($static as $key => $val) {
            array_push($tmpName, $key);
        }

        foreach ($tmpName as $item) {
            if($item == 'user') {
                $pushData = User::where('active', '=', 1)->orderBy('level', 'asc')->get();
            }
        }

        if(in_array($pageName, $tmpName)) {
            $heroFill = [
                'name' => $static[$pageName]['heroName']
            ];
            $category_id = [
                'id' => $static[$pageName]['id']
            ];
            $data = DB::table('products')
                ->select([
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.price as product_price',
                    'products.desc as product_desc',
                    'products.slug as product_slug',
                    'product_photos.url as product_url',
                    'categories.name as category',

                ])
                ->leftJoin('product_photos', 'products.id', '=', 'product_photos.product_id')
                ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
                ->rightJoin('categories', 'products.category_id', '=', 'categories.id')
                ->where('category_id', '=', $category_id)
                ->where('status', '=', 'publish')
                ->groupBy('products.id');


            $data = $data->paginate(6);
            return view($static[$pageName]['view'], compact('heroFill', 'pushData', 'data'));
        } else {

            $data = Product::where('slug', '=', $pageName)->firstOrFail();

            $heroFill = [
                'name' => $data->title
            ];

            return redirect()->back();

        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($slug)
    {
        $data = Product::where('slug' , '=' , $slug)->with(['photos', 'category', 'discount'])->firstOrFail();

        if(Auth::check()) {
            $checkRating = DB::table('ratings')
                ->where('user_id', '=', auth()->id())
                ->where('rateable_id', '=', $data->id)
                ->where('rateable_type', '=', 'App\Models\Product')
                ->get();

//            return $checkRating;
        }

        return view('feproduct::single_post' , compact('data' , 'checkRating'));
    }

    public function edit()
    {
        return view('feproduct::edit');
    }

    public function cart($slug, $prod_id)
    {
        $product = Product::find($prod_id);
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'tax' => 0]);

        $cart = Cart::content();

        return redirect()->route('frontend.cart.index');
//        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
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

    public function reviewProduct(Request $request, $slug)
    {
//        return $request->all();

        $this->validate($request, [
            'rate' => 'required|numeric|min:1|max:5',
            'id' => 'nullable|numeric',
        ]);

        $data = Product::where('slug', '=', $slug)->first();
        $rating = new Rating();

//        return $data;


        $rating->rating = $request->rate;

        $rating->user_id = auth()->id();

        $data->ratings()->save($rating);

        return redirect()->route('frontend.product.show', ['slug' => $data->slug]);
    }
}
