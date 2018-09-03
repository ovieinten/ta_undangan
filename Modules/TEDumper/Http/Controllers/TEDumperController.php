<?php

namespace Modules\TEDumper\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use willvincent\Rateable\Rating;

class TEDumperController extends Controller
{
    public function index()
    {
//        dump(auth()->user()->level);
//        dd(auth()->user());

        if(auth()->user()->level == "operator") {
            return "1";
        }
        return view('tedumper::index');
    }

    public function test1(Request $request)
    {

//        return "PL";
        $this->validate($request, [
            'rate' => 'required|numeric'
        ]);

        $data = Product::find(2);

        return is_null($data->averageRating) ? 0 : $data->averageRating;

//        $rating = new Rating();
//
//
//        $rating->rating = $request->rate;
//
//        $rating->user_id = auth()->id();
//
//        $data->ratings()->save($rating);
//
//        return $data;
    }


}
