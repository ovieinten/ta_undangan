<?php

namespace Modules\FECart\Http\Controllers;

use App\Models\Product;
use \Cart as Cart;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//use Cart;

class FECartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $heroFill = [
            'name' => 'Keranjang Belanja'
        ];

            $cart = Cart::content();
        return view('fecart::index', compact('heroFill','cart'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('fecart::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });
        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    public function emptyCart()
    {
        Cart::destroy();
        return redirect('f/cart')->withSuccessMessage('Your cart has been cleared!');
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($slug)
    {
        $data = Product::where('slug', $slug)->firstOrFail();
        return view('fecart::show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('fecart::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
        }
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        Cart::remove($id);
        return redirect('cart')->withSuccessMessage('Item has been removed!');
    }

    public function destroy()
    {
    }
}
