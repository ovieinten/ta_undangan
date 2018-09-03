<?php

namespace Modules\BEPayment\Http\Controllers;

use App\User;
use App\Models\Order;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use COOEM\Core\Classes\Uploader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BEPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'route' => 'backend.payment.getdata'
        ];
        return view('bepayment::index',compact('data'));
    }

    public function getData(DataTables $dtb)
    {
        // $data = Payment::select('*');
        $data = Payment::select('*')
            ->with(['user','order']);


        // return $data->get();

        return $dtb->collection($data->get())
            ->addColumn('image_col' , function ($row) {
                return $row->image ? '
                    <img src="' . url($row->image) . '" alt="image" height="60" width="60">
                ' :      '
                    <img src="" alt="image" height="60">
                ';
            })
            ->addColumn('col_confirm_user_name', function($row){
                $user = User::find($row->confirm_user_id);
                return $user->first_name.' '.$user->last_name;
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-150px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.payment.edit' , ['id' => $row->id]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Ubah</a>
                            <li onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus
                            </li>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'image_col' ,
                    'action'
                ]
            )
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function form()
    {
        $data['user'] = User::all();
        $data['order'] = Order::all();
        return view('bepayment::form' , compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, Uploader $uploader)
    {
        $rule = [
            'user' => 'exists:users,id' ,
            'order' => 'exists:orders,id' ,
            'desc' => 'required' ,
            'file' => 'required|mimes:jpeg,jpg,png,bmp|max:1024',
        ];

        $numberMaker = new \DateTime();

        $shuffled = 'PAY-' . $numberMaker->getTimestamp();
        // $order_number = $shuffled;
        $request->request->add([
            'order_number' =>  $shuffled
        ]);

        $this->validate($request,  $rule);

        $image = "";
        if ($request->hasFile('file'))
        {
            $destinationPath = 'images\payments';
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
            $image = $destinationPath.'/'.$name;
        }


        DB::beginTransaction();
        try {
            $paymentSaved = Payment::create([
                'user_id' => $request->user,
                'confirm_user_id' => auth()->id(),
                'order_id' => $request->order,
                'desc' => $request->desc,
                'image' => $image
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return redirect()->route('backend.payment.index');
    }

    public function edit($id)
    {
        $data['user'] = User::all();
        $data['order'] = Order::all();
        $data['payment'] = Payment::where('id' , '=' , $id)->first();
        return view('bepayment::form', compact('data'));
    }

    public function update($id, Request $request, Uploader $uploader)
    {
        $rule = [
            'user' => 'exists:users,id' ,
            'order' => 'exists:orders,id' ,
            'desc' => 'required' ,
        ];

        $this->validate($request,  $rule);

        $datapayment = Payment::where('id' , '=' , $id)->firstOrFail();

        $photos = $uploader->save($request , 'file' , 'payments');


        DB::beginTransaction();

        $data = [
                'user_id' => $request->user,
                'confirm_user_id' => auth()->id(),
                'order_id' => $request->order,
                'desc' => $request->desc,
        ];

        if ($photos) {
            $data['image'] = $photos;
        }

        try {
        $datapayment->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return redirect()->route('backend.payment.index');

    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
}
