<?php

namespace Modules\BEOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use COOEM\Core\Classes\Uploader;
use Illuminate\Support\Facades\Auth;
use Modules\BEOrder\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BEOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'route' => 'backend.order.getdata'
        ];
        return view('beorder::index' , compact('data'));
    }

    public function form()
    {
        $data['product'] = Product::all();
        $data['user'] = User::all();
        return view('beorder::form' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('beorder::create');
    }


    /**
    * getdataproduk
    */

    public function getDataProduk($id)
    {
        $findprodak = Product::find($id);
        if (!empty(@$findprodak)) {
            $findprodak->discount;
            $response = ['status'=>true,'message'=>'success', 'data'=> @$findprodak];
        }else{
            $response = ['status'=>false,'message'=>'No Result', 'data'=> @$findprodak];
        }


        return response()->json($response, 200);
    }



    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function store(Request $request , Uploader $uploader)
    {

        DB::beginTransaction();

        $slug = null;
        $slugSearch = Order::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }
        $collection = collect([1, 2, 3, 4, 5]);

        $shuffled = 'PAY-' . $collection->shuffle();

        // $shuffled = 'PAY-' . $numberMaker->getTimestamp();
        // $order_number = $shuffled;
        $request->request->add([
            'order_number' =>  $shuffled
        ]);
        $order = Order::create([
            'product_id'     => $request->product ,
            'user_id'        => Auth::id(),
            'number'         => $request->number ,
            'post_code'      => $request->post_code ,
            'address'        => $request->address ,
            'village'        => $request->village ,
            'district'       => $request->district ,
            'regence'        => $request->regence ,
            'province'       => $request->province ,
            'post_code'      => $request->post_code ,
            'price_total'    => $request->price_total ,
            'discont_total'  => $request->discount_total ,
            'grand_total'    => $request->grand_total ,
            'qty'            => $request->qty ,
            'date'           => $request->date ,
            'desc'           => $request->desc ,
            // 'order_number'   => $shuffled,
            'slug'           => $slug ,
        ]);

        DB::commit();

        if(auth()->user()->role_id == 3) {
            return redirect()->route('frontend.home.index');
        } else {
            return redirect()->route('backend.order.index');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('beorder::show');
    }

    public function getSlug($id)
    {
        $data = Order::select('id' , 'slug')->where('id' , '=' , $id)->first();
        $slug = url('orders/' . $data->slug);
        return response()->json([
                'data' => [
                    'slug' => $slug
                ]
            ]
        );
    }

    public function getData(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product' , 'user']);

        return $dtb->eloquent($data)

            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                $temp = $row->status == "cancel" ?
                    '<li>
                        <a onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                        <i class="fa fa-fw fa-trash mr-3"></i>Hapus Pemesanan</a>
                    </li>'
                    :
                    '<li>
                        <a onclick="trashRow(' . $row->id . ')" class="btn dropdown-item" >
                        <i class="fa fa-fw fa-trash mr-3"></i>Move to Cancel</a>
                     </li>';

                return '
                <div class="input-group-btn" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class=""></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <li>
                                <a class="btn dropdown-item" href="' . route('backend.order.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            </li>
                            '.
                    $temp
                    .'
                        </div>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataConfirmed(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product' , 'user'])
            ->where('status' , '=' , 'payment confirmed')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.order.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            <button onclick="packageRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-inbox mr-3"></i>Move to Package
                            </button>
                            <button onclick="trashRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Move to Cancel
                            </button>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataPackage(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product' , 'user'])
            ->where('status' , '=' , 'packaging')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.order.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            <button onclick="shippedoutRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-send-o mr-3"></i>Move to ShippedOut
                            </button>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataShippedOut(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product' , 'user'])
            ->where('status' , '=' , 'shipped out')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <button onclick="deliveredRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-check-square-o mr-3"></i>Move to Delivered
                            </button>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataDelivered(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product' , 'user'])
            ->where('status' , '=' , 'order delivered')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.order.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataTrashed(DataTables $dtb)
    {
        $data = Order::select('*')
            ->with(['product','user'])
            ->where('status' , '=' , 'cancel')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'payment confirmed' => 'info' ,
                    'order delivered' => 'success' ,
                    'shipped out' => 'primary' ,
                    'packaging' => 'warning' ,
                    'cancel' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <button onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Delete order
                            </button>
                        </div>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function confirm($id)
    {
        $data = Order::findOrFail($id);

        $data->update([
            'status' => 'payment confirmed'
        ]);

        return response()->json($data);
    }

    public function confirmed()
    {
        $data = [
            'route' => 'backend.order.getdataConfirmed'
        ];

        return view('beorder::index' , compact('data'));
    }

    public function packaging($id)
    {
        $data = Order::findOrFail($id);

        $data->update([
            'status' => 'packaging'
        ]);

        return response()->json($data);
    }

    public function packed()
    {
        $data = [
            'route' => 'backend.order.getdataPacked'
        ];

        return view('beorder::index' , compact('data'));
    }

    public function shippingOut($id)
    {
        $data = Order::findOrFail($id);

        $data->update([
            'status' => 'shipped out'
        ]);

        return response()->json($data);
    }

    public function shippedOut()
    {
        $data = [
            'route' => 'backend.order.getdataShippedOut'
        ];

        return view('beorder::index' , compact('data'));
    }

    public function deliver($id)
    {
        $data = Order::findOrFail($id);

        $data->update([
            'status' => 'order delivered'
        ]);
    }

    public function delivered()
    {
        $data = [
            'route' => 'backend.order.getdataDelivered'
        ];

        return view('beorder::index' , compact('data'));
    }

    public function trash($id)
    {
        $data = Order::findOrFail($id);

        $data->update([
            'status' => 'cancel'
        ]);

        return response()->json($data);
    }

    public function trashed()
    {
        $data = [
            'route' => 'backend.order.getdataTrashed'
        ];

        return view('beorder::index' , compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($slug)
    {
        $data['product'] = Product::all();
        $data['user'] = User::all();
        $data['order'] = Order::where('slug' , '=' , $slug)->first();

        return view('beorder::form' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($slug , Request $request , Uploader $uploader)
    {
        $dataorder = order::where('slug' , '=' , $slug)->firstOrFail();

        $slug = null;
        $photos = $uploader->save($request , 'photos' , 'orders');

        DB::beginTransaction();


        $slugSearch = order::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }
        $numberMaker = new \DateTime();

        $shuffled = 'PAY-' . $numberMaker->getTimestamp();
        // $order_number = $shuffled;
        // $request->request->add([
        //     'order_number' =>  $shuffled
        // ]);
        $data = [
            'product_id'     => $request->product ,
            'user_id'        => Auth::id(),
            'number'         => $request->number ,
            'post_code'      => $request->post_code ,
            'address'        => $request->address ,
            'village'        => $request->village ,
            'district'       => $request->district ,
            'regence'        => $request->regence ,
            'province'       => $request->province ,
            'post_code'      => $request->post_code ,
            'price_total'    => $request->price_total ,
            'discont_total'  => $request->discount_total ,
            'grand_total'    => $request->grand_total ,
            'qty'            => $request->qty ,
            'date'           => $request->date ,
            'desc'           => $request->desc ,
            'order_number'   => $shuffled,
            'slug'           => $slug ,
        ];

        try {
            $dataorder->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return redirect()->route('backend.order.index');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */

    public function delete($id)
    {
        $data = Order::findOrFail($id);
        $data->forceDelete();
        return response()->json($data);
    }

    public function destroy()
    {
    }
}
