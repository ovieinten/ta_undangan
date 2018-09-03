<?php

namespace Modules\BEDiscount\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BEDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Discount::all();
        $data['product'] = Product::all();
        return view('bediscount::index', compact('data'));
    }

    public function select()
    {
        $data = Discount::all();
        return view('bediscount::partials.select', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bediscount::create');
    }

    public function getData(DataTables $dtb)
    {
        $data = Discount::select('*')
            ->with('product');
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
        $rule = [
            'product_id' => 'exists:products,id' ,
            'percent'    => 'required ' ,
            'date_start' => 'required' ,
            'date_end'   => 'required' ,
        ];

        $this->validate($request,  $rule);

        DB::beginTransaction();

        try {
            $discountSaved = Discount::create([
                'product_id'    => $request->product_id ,
                'percent'       => $request->percent ,
                'date_start'    => $request->date_start ,
                'date_end'      => $request->date_end ,
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();

        return redirect()->route('backend.discount.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */

    public function detail($id)
    {
        $arc = Discount::findOrFail($id);
        return $arc;
    }

    public function show()
    {
        return view('bediscount::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('bediscount::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'product_id' => 'exists:products,id' ,
            'percent'    => 'required ' ,
            'date_start' => 'required' ,
            'date_end'   => 'required' ,
        ];

        $this->validate($request,  $rule);

        $arc = Discount::findOrFail($id);

        DB::beginTransaction();

        $data = [
                'product_id'    => $request->product_id ,
                'percent'       => $request->percent ,
                'date_start'    => $request->date_start ,
                'date_end'      => $request->date_end ,
        ];

        try {
            $arc->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return response()->json($arc);
    }

    public function delete($id)
    {
        $arc = Discount::findOrFail($id);
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
