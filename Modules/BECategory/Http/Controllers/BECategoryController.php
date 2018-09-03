<?php

namespace Modules\BECategory\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class BECategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Category::all();
        return view('becategory::index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function getData(DataTables $dtb)
    {
        $data = Category::select('*');
        return $dtb->eloquent($data)
            ->addColumn('action' , function ($row) {
//                $idedit = Crypt::encryptString($row->bookcategory_id);
                return '
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
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
            'name' => $request['name'] ,
            'desc' => $request['desc'] ,
            'slug' => str_slug($name) ,
        ];
        return Category::create($data);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('becategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function detail($id)
    {
        $arc = Category::findOrFail($id);
        return $arc;
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request , $id)
    {
        $arc = Category::findOrFail($id);
        $name = $request->name;
        $data = [
            'name' => $request['name'] ,
            'desc' => $request['desc'] ,
            'slug' => str_slug($name) ,
        ];
        $arc->update($data);
        return response()->json($arc);
    }

    public function delete($id)
    {
        /* data user */
        $arc = Category::findOrFail($id);
        $arc->forceDelete();
        return response()->json($arc);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
//        Category::destroy($id);
    }
}
