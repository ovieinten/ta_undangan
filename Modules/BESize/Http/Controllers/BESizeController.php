<?php

namespace Modules\BESize\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class BESizeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Size::all();
        return view('besize::index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('besize::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function getData(DataTables $dtb)
    {
        $data = Size::select('*');
        return $dtb->eloquent($data)
            ->addColumn('action' , function ($row) {
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

    public function store(Request $request)
    {
        $name = $request->name;
        $data = [
            'name' => $request['name'],
            'slug' => str_slug($name),
        ];
        return Size::create($data);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('besize::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function detail($id)
    {
        $arc = Size::findOrFail($id);
        return $arc;
    }

    public function edit()
    {
        // return view('besize::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $arc = Size::findOrFail($id);
        $name = $request->name;
        $data = [
            'name' => $request['name'] ,
            'slug' => str_slug($name) ,
        ];
        $arc->update($data);
        return response()->json($arc);
    }

    public function delete($id)
    {
        $arc = Size::findOrFail($id);
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
