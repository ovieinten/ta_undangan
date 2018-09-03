<?php

namespace Modules\BESale\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BESaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'route' => 'backend.sale.getdata'
        ];
        return view('besale::index',compact('data'));
    }

    public function form()
    {
        $data['order'] = Order::all();
        $data['payment'] = Payment::all();
        return view('besale::form', compact('data'));
    }

    public function create()
    {
        return view('besale::create');
    }

    public function getData(DataTables $dtb)
    {
        $data = Sale::select('*')
            ->with(['order', 'payment']);
        return $dtb->eloquent($data)
            ->addColumn('action' , function ($row) {
                return '
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-250px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.sale.edit' , ['id' => $row->id]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Ubah</a>
                            <li onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus
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
            'order' => 'exists:orders,id' ,
            'payment' => 'exists:payments,id' ,
            'paid_total' => 'required' ,
        ];

        $this->validate($request,  $rule);

        DB::beginTransaction(); 

        try {
            $userSaved = Sale::create([
                'order_id' => $request->order,
                'payment_id' => $request->payment,
                'paid_total' => $request->paid_total,
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();

        return redirect()->route('backend.sale.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */

    public function detail($id)
    {
        $arc = Sale::findOrFail($id);
        return $arc;
    }

    public function show()
    {
        return view('besale::show');
    }

    public function dataReport(Request $request)
    {

        return view('besale::form_report',compact('data'));
    }

    public function report(Request $request)
    {   
        $data = new \stdClass();

            $data->report = DB::table('sales');
            $data->report = $data->report->select('*');
            $data->report->leftJoin('orders', 'orders.id', '=', 'sales.order_id');

            if($request->has('filter_tahun_select')){
            $data->report->whereRaw('year(sales.created_at) = '.$request->filter_tahun_select);
        }
        if($request->has('filter_bulan_select')){
            $data->report->whereRaw('month(sales.created_at) = '.$request->filter_bulan_select);
        } 

        $data->tahun = $request->filter_tahun_select;   
        $data->bulan = $request->filter_bulan_select; 

        $data->bulanMap = [
                '1' => 'Januari',
                '2' => 'Februari',
                '3' => 'Maret',
                '4' => 'April',
                '5' => 'Mei',
                '6' => 'Juni',
                '7' => 'Juli',
                '8' => 'Agustus',
                '9' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        ];

        return view('besale::report',compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['order'] = Order::all();
        $data['payment'] = Payment::all();
        $data['sale'] = Sale::where('id' , '=' , $id)->first();
        return view('besale::form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'order' => 'exists:orders,id' ,
            'payment' => 'exists:payments,id' ,
            'paid_total' => 'required' ,
        ];

        $this->validate($request,  $rule);

        DB::beginTransaction();

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
        $arc = Sale::findOrFail($id);
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
