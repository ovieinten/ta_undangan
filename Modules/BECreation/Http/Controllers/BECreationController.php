<?php

namespace Modules\BECreation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Creation;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Shape;
use App\Models\CreationPhoto;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use COOEM\Core\Classes\Uploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BECreationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'route' => 'backend.creation.getdata'
        ];
        return view('becreation::index' , compact('data'));
    }

    public function form()
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        return view('becreation::form' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('becreation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function store(Request $request , Uploader $uploader)
    {
        $rule = [
            'color' => 'exists:colors,id' ,
            'size' => 'exists:sizes,id' ,
            'shape' => 'exists:shapes,id' ,
            'name' => 'required ' ,
            'desc' => 'required' ,
            'price' => 'required' ,
            'status' => 'required|in:sent,draft' ,
        ];

        $this->validate($request,  $rule);

        //SIMPAN KE TABEL creation
//        dump($request->all());
        DB::beginTransaction();

        $slug = null;
        $slugSearch = Creation::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }
        $creation = Creation::create([
            'color_id'      => $request->color ,
            'size_id'       => $request->size ,
            'shape_id'      => $request->shape ,
            'name'          => $request->name ,
            'price'         => $request->price ,
            'desc'          => $request->desc ,
            'slug'          => $slug ,
            'status'        => $request->status ,
            'user_id'       => Auth::id(),
        ]);


        foreach ($request->file('photos') as $media) {
            if (!empty($media)) {
                $destinationPath = 'images/creations/';
                $name = $media->getClientOriginalName();
                $media->move($destinationPath, $name);
            }

            CreationPhoto::create([
                'creation_id' => $creation->id,
                'url' => url($destinationPath . $name),
                'name' => $name
            ]);
        }

        DB::commit();

        return redirect()->route('backend.creation.index');
    }

    public function storeAcc(Request $request, $slug)
    {

        DB::beginTransaction();

        dump($slug);

        $slugSearch = Product::where('slug' , '=' , $slug)->first();
//        dump($slugSearch);




        $data = Creation::where('slug' , '=' , $slug)->firstOrFail();

//        return ["data" => $data];
//
//        return $slug;
        $data->update([
            'status' => 'accepted'
        ]);

        $status = 'publish';

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }

        $product = Product::create([
            'category_id'   => $request->category ,
            'color_id'      => $request->color ,
            'size_id'       => $request->size ,
            'shape_id'      => $request->shape ,
            'name'          => $request->name ,
            'price'         => $request->price ,
            'desc'          => $request->desc ,
            'slug'          => $slug ,
            'status'        => $status ,
            'note'          => $request->note ,
            'user_id'       => Auth::id(),
        ]);


        if(is_array($request->photos)) {
            foreach ($request->file('photos') as $media) {
                if (!empty($media)) {
                    $destinationPath = 'images/products/';
                    $name = $media->getClientOriginalName();
                    $media->move($destinationPath, $name);
                }

                ProductPhoto::create([
                    'product_id' => $product->id,
                    'url' => $destinationPath.$name,
                    'name' => $name
                ]);
            }
        }

        DB::commit();

        return redirect()->route('backend.creation.index');
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('becreation::show');
    }

    public function getSlug($id)
    {
        $data = Creation::select('id' , 'slug')->where('id' , '=' , $id)->first();
        $slug = url('creations/' . $data->slug);
        return response()->json([
                'data' => [
                    'slug' => $slug
                ]
            ]
        );
    }

    public function getData(DataTables $dtb)
    {
        $data = Creation::select('*')
            ->with(['color','size','shape']);

//        return $data->get();

        return $dtb->eloquent($data)

            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'sent' => 'warning' ,
                    'accepted' => 'primary' ,
                    '' => ''
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('confirm' , function ($row) {
                $temp = $row->status == "sent" ?
                '<span class="badge badge-info" style="width: 100px; background:red;">
                    <a href="' . route('backend.creation.formAcc' , ['slug' => $row->slug]) . '" class="btn btn-alt-success my-btn-action" >
                        <i class="fa fa-fw fa-info mr-5" style="margin-left: -10px; color:white;"> Konfirmasi</i>
                    </a>
                 </span>'
                    :
                '<span class="badge badge-info" style="width: 100px;">
                        <i class="fa fa-fw fa-check mr-5" style="margin-left: -10px;"> Accepted</i>
                 </span>';
                return $temp;
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="input-group-btn" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class=""></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <li>
                            <a class="btn dropdown-item" href="' . route('backend.creation.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            </li>
                            <li>
                            <a class="btn dropdown-item" href="' . route('backend.creation.view' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a>
                            </li>
                            <li>
                                <a onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus Karya</a>
                            </li>
                        </ul>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'confirm' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataSent(DataTables $dtb)
    {
        $data = Creation::select('*')
            ->with(['color','size','shape'])
            ->where('status' , '=' , 'sent')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'sent' => 'warning' ,
                    'accepted' => 'primary' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('confirm' , function ($row) {
                $temp = $row->status == "sent" ?
                    '<span class="badge badge-info" style="width: 100px; background:red;">
                    <a href="' . route('backend.creation.formAcc' , ['slug' => $row->slug]) . '" class="btn btn-alt-success my-btn-action" >
                        <i class="fa fa-fw fa-info mr-5" style="margin-left: -10px; color:white;"> Konfirmasi</i>
                    </a>
                 </span>'
                    :
                    '<span class="badge badge-info" style="width: 100px;">
                        <i class="fa fa-fw fa-check mr-5" style="margin-left: -10px;"> Accepted</i>
                 </span>';
                return $temp;
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.creation.edit' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            <button onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus Karya
                            </button>
                            <a class="btn dropdown-item" href="' . route('backend.creation.view' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'confirm' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataAccepted(DataTables $dtb)
    {
        $data = Creation::select('*')
            ->with(['color','size','shape'])
            ->where('status' , '=' , 'accepted')
            ->orderBy('created_at' , 'DESC');

        return $dtb->eloquent($data)
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'sent' => 'warning' ,
                    'accepted' => 'primary' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->status] . '">' . $row->status . '</span>
                ';
            })
            ->addColumn('confirm' , function ($row) {
                $temp = $row->status == "trash" ?
                    '<span class="badge badge-info" style="width: 100px; background:red;">
                    <a ' . route('backend.creation.formAcc' , ['slug' => $row->slug]) . ' class="btn btn-alt-success my-btn-action" >
                        <i class="fa fa-fw fa-info mr-5" style="margin-left: -10px; color:white;"> Konfirmasi</i>
                    </a>
                 </span>'
                    :
                    '<span class="badge badge-info" style="width: 100px;">
                        <i class="fa fa-fw fa-check mr-5" style="margin-left: -10px;"> Accepted</i>
                 </span>';
                return $temp;
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-150px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.creation.view' , ['slug' => $row->slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a>
                            <button onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus Karya
                            </button>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'confirm' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function sending($id)
    {
        $data = Creation::findOrFail($id);

        if ($data->status == 'draft') {
            $data->update([
                'created_at' => Carbon::now() ,
                'status' => 'sent'
            ]);
        }

        return response()->json($data);
    }

    public function sent()
    {
        $data = [
            'route' => 'backend.creation.getdataSent'
        ];

        return view('becreation::index' , compact('data'));
    }

    public function accept($id)
    {
        $data = Creation::findOrFail($id);

        $data->update([
            'status' => 'accepted'
        ]);

        return response()->json($data);
    }

    public function accepted()
    {
        $data = [
            'route' => 'backend.creation.getdataAccepted'
        ];

        return view('becreation::index' , compact('data'));
    }

    public function formAcc($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['creation'] = Creation::where('slug' , '=' , $slug)->with('photo_creation')->first();;

        return view('becreation::form_acc' , compact('data'));
    }

    public function edit($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['creation'] = Creation::where('slug' , '=' , $slug)->with('photo_creation')->first();

        return view('becreation::form' , compact('data'));
    }

    public function viewCreation($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['creation'] = Creation::where('slug' , '=' , $slug)->with('photo_creation')->first();

        return view('becreation::view_detail' , compact('data'));
    }

    public function confirm($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['creation'] = Creation::where('slug' , '=' , $slug)->first();

        return view('becreation::_modal' , compact('data'));
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($slug , Request $request , Uploader $uploader)
    {
        $rule = [
            'color' => 'exists:colors,id' ,
            'size' => 'exists:sizes,id' ,
            'shape' => 'exists:shapes,id' ,
            'name' => 'required ' ,
            'desc' => 'required' ,
            'price' => 'required' ,
            'status' => 'required|in:sent,draft,accepted' ,
        ];
        $this->validate($request , $rule);

        $datacreation = Creation::where('slug' , '=' , $slug)->firstOrFail();

        $slug = null;
        $photos = $uploader->save($request , 'photos' , 'creations');

        DB::beginTransaction();


        $slugSearch = Creation::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }

        $data = [
            'color_id'      => $request->color ,
            'size_id'       => $request->size ,
            'shape_id'      => $request->shape ,
            'name'          => $request->name ,
            'price'         => $request->price ,
            'desc'          => $request->desc ,
            'slug'          => $slug ,
            'status'        => $request->status ,
            'user_id'       => Auth::id(),
        ];

        if ($photos) {
            $data['photo_creation'] = $photos;
        }

        try {
            $datacreation->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return redirect()->route('backend.creation.index');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */

    public function restore($id)
    {
        $data = Creation::findOrFail($id);

        $data->update([
            'status' => 'sent'
        ]);

        return response()->json($data);
    }

    public function delete($id)
    {
        $data = Creation::findOrFail($id);
        $data->forceDelete();
        return response()->json($data);
    }

    public function destroy()
    {
    }
}
