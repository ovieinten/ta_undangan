<?php

namespace Modules\FEPage\Http\Controllers;

use App\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class FEPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('fepage::index');
    }

    public function show($pageName)
    {
        $static = [
            'about' => [
                'view' => 'fepage::about',
                'heroName' => 'Tentang Kami',
            ],
            'contact' => [
                'view' => 'fepage::contact',
                'heroName' => 'Kontak Kami'
            ],
            'how-to-order' => [
                'view' => 'fepage::howtoOrder',
                'heroName' => 'Cara Pesan',
            ],
            'faq' => [
                'view' => 'fepage::faq',
                'heroName' => 'FAQ'
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

            return view($static[$pageName]['view'], compact('heroFill', 'pushData'));
        } else {

            $data = Page::where('slug', '=', $pageName)->firstOrFail();

            $heroFill = [
                'name' => $data->title
            ];

            return redirect()->back();

        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('fepage::create');
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('fepage::edit');
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
