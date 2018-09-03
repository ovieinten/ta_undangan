<?php

namespace Modules\BEComment\Http\Controllers;

use App\Models\Comment;
use App\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class BECommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Comment::all();
        return view('becomment::index', compact('data'));
    }

    public function select()
    {
        $data = Comment::all();
        return view('becomment::partials.select', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('becomment::create');
    }

    public function getData(DataTables $dtb)
    {
        $data = Comment::select('*');
        return $dtb->eloquent($data)
            ->addColumn('action' , function ($row) {
                return '
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-250px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <li onclick="editForm(' . $row->id . ')" class="btn dropdown-item">
                                <i class="fa fa-fw fa-pencil mr-3"></i>Ubah
                            </li>
                            <li onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item">
                                <i class="fa fa-fw fa-times mr-3"></i>Hapus
                            </li>
                            <li onclick="viewForm(' . $row->id . ')" class="btn dropdown-item">
                                <i class="fa fa-fw fa-info mr-3"></i>Lihat Detail
                            </li>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->make('true');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $data = [
            'parent_id' => $request['parent_id'] ? : 0,
            'name' => $request['name'],
            'slug' => str_slug($name),
        ];
        return comment::create($data);
    }

    /**
     * Show the specified resource.
     * @return Response
     */

    public function detail($id)
    {
        $arc = Comment::findOrFail($id);
        return $arc;
    }

    public function show()
    {
        return view('becomment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('becomment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $arc = Comment::findOrFail($id);
        $name = $request->name;
        $data = [
            'parent_id' => $request['parent_id'] ,
            'name' => $request['name'] ,
            'slug' => str_slug($name) ,
        ];
        $arc->update($data);
        return response()->json($arc);
    }

    public function delete($id)
    {
        $arc = Comment::findOrFail($id);
        $arc->forceDelete();
        return response()->json($arc);
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
