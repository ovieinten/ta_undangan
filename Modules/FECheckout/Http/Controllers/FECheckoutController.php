<?php

namespace Modules\FECheckout\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use COOEM\Core\Classes\Uploader;
use Illuminate\Support\Facades\Auth;
use Modules\BEOrder\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class FECheckoutController extends Controller
{
    public function index()
    {
        $heroFill = [
            'name' => 'Checkout'
        ];
        $data['product'] = Product::all();
        $data['user'] = User::all();

        return view('fecheckout::index', compact('heroFill', 'data'));
    }

    public function getDataProduk($id)
    {
        $findprodak = Product::find($id);
        if (!empty(@$findprodak)) {
            $findprodak->discount;
            $response = ['status'=>true,'message'=>'success', 'data'=> @$findprodak];
        }else{
            $response = ['status'=>false,'message'=>'No Result', 'data'=> @$findprodak];
        }


        return response()->json($response, 200);
    }
    
    public function create()
    {
        return view('fecheckout::create');
    }

    public function store(Request $request , Uploader $uploader)
    {

        DB::beginTransaction();

        $slug = null;
        $slugSearch = Order::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }
        $numberMaker = new \DateTime();

        $shuffled = 'PAY-' . $numberMaker->getTimestamp();
        // $order_number = $shuffled;
        $request->request->add([
            'order_number' =>  $shuffled
        ]);
        $order = Order::create([
            'product_id'     => $request->product ,
            'user_id'        => Auth::id(),
            'number'         => $request->number ,
            'post_code'      => $request->post_code ,
            'address'        => $request->address ,
            'village'        => $request->village ,
            'district'       => $request->district ,
            'regence'        => $request->regence ,
            'province'       => $request->province ,
            'post_code'      => $request->post_code ,
            'price_total'    => $request->price_total ,
            'discont_total'  => $request->discount_total ,
            'grand_total'    => $request->grand_total ,
            'qty'            => $request->qty ,
            'date'           => $request->date ,
            'desc'           => $request->desc ,
            // 'order_number'   => $shuffled,
            'slug'           => $slug ,
        ]);

        DB::commit();

        return redirect()->route('frontend.payment');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('fecheckout::payment');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('fecheckout::edit');
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
