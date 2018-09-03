<?php

namespace Modules\BERating\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BERatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index()
    {
        $data = Rating::all();
        return view('berating::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('berating::create');
    }


    public function posts()
    {
        $posts = Rating::all();
        return view('berating::posts', compact('posts'));
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
    public function show($id)
    {
        $post = Product::find($id);
        return view('berating::postsShow',compact('post'));
    }

    public function postPost(Request $request)

    {

        request()->validate(['rate' => 'required']);

        $post = Rating::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $post->ratings()->save($rating);
        return redirect()->route("posts");
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('berating::edit');
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
