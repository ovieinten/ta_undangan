<?php

namespace Modules\BEProduct\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Shape;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use COOEM\Core\Classes\Uploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BEProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'route' => 'backend.product.getdata'
        ];
        return view('beproduct::index' , compact('data'));
    }

    public function form()
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        return view('beproduct::form' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('beproduct::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function store(Request $request , Uploader $uploader)
    {
        $rule = [
            'category' => 'exists:categories,id' ,
            'color' => 'exists:colors,id' ,
            'size' => 'exists:sizes,id' ,
            'shape' => 'exists:shapes,id' ,
            'name' => 'required ' ,
            'desc' => 'required' ,
            'price' => 'required' ,
            'status' => 'required|in:publish,draft' ,
            'note' => 'nullable' ,
        ];

        $this->validate($request,  $rule);

        //SIMPAN KE TABEL PRODUCT
//        dump($request->all());
        DB::beginTransaction();

        $slug = null;
        $slugSearch = Product::where('slug' , '=' , str_slug($request->name))->first();

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
                'status'        => $request->status ,
                'note'          => $request->note ,
                'user_id'       => Auth::id(),
        ]);


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

        DB::commit();

        return redirect()->route('backend.product.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('beproduct::show');
    }

    public function getSlug($id)
    {
        $data = Product::select('id' , 'slug')->where('id' , '=' , $id)->first();
        $slug = url('products/' . $data->slug);
        return response()->json([
                'data' => [
                    'slug' => $slug
                ]
            ]
        );
    }

    public function getData(DataTables $dtb)
    {
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'categories.name as category_name',
                'colors.name as color_name',
                'sizes.name as size_name',
                'shapes.name as shape_name',
                'products.note as product_note',
                'products.status as product_status',
                'products.slug as product_slug',
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('shapes', 'products.shape_id', '=', 'shapes.id')
            ->leftJoin('sizes', 'products.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'products.color_id', '=', 'colors.id');

//        return $data;

        return $dtb->collection($data->get())

            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'publish' => 'primary' ,
                    'draft' => 'warning' ,
                    'trash' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->product_status] . '">' . $row->product_status . '</span>
                ';
            })
            ->addColumn('col_rating', function($row){
                $product = Product::find($row->product_id);
                $ratingVal = is_null($product->averageRating) ? 0 : $product->averageRating;
                // return '
                //     <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="'.intval($ratingVal).'" data-size="xs" disabled="">
                // ';

                return intval($ratingVal);
            })
            ->addColumn('action' , function ($row) {
                $temp = $row->product_status == "trash" ?
                    '<li>
                        <a onclick="deleteRow(' . $row->product_id . ')" class="btn dropdown-item" >
                        <i class="fa fa-fw fa-trash mr-3"></i>Hapus Produk</a>
                    </li>'
                    :
                    '<li>
                        <a onclick="trashRow(' . $row->product_id . ')" class="btn dropdown-item" >
                        <i class="fa fa-fw fa-trash mr-3"></i>Move to trash</a>
                     </li>';

                return '
                <div class="input-group-btn" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class=""></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <li>
                            <a class="btn dropdown-item" href="' . route('backend.product.edit' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a></li>
                            <li>
                            <a class="btn dropdown-item" href="' . route('backend.product.view' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a></li>
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
                    'action',
                    'col_rating'
                ]
            )
            ->make('true');
    }

    public function getDataPublished(DataTables $dtb)
    {
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'categories.name as category_name',
                'colors.name as color_name',
                'sizes.name as size_name',
                'shapes.name as shape_name',
                'products.note as product_note',
                'products.status as product_status',
                'products.slug as product_slug',
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('shapes', 'products.shape_id', '=', 'shapes.id')
            ->leftJoin('sizes', 'products.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'products.color_id', '=', 'colors.id')
            ->where('products.status', '=', 'publish');

        return $dtb->collection($data->get())
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'publish' => 'primary' ,
                    'draft' => 'warning' ,
                    'trash' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->product_status] . '">' . $row->product_status . '</span>
                ';
            })
            ->addColumn('col_rating', function($row){
                $product = Product::find($row->product_id);
                $ratingVal = is_null($product->averageRating) ? 0 : $product->averageRating;
                // return '
                //     <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="'.intval($ratingVal).'" data-size="xs" disabled="">
                // ';

                return intval($ratingVal);
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(0px, -34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.product.edit' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            <button onclick="trashRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Move to trash
                            </button>
                            <button onclick="draftRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Move to Draft
                            </button>
                            <a class="btn dropdown-item" href="' . route('backend.product.view' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a>

                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'col_rating' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataDrafted(DataTables $dtb)
    {
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'categories.name as category_name',
                'colors.name as color_name',
                'sizes.name as size_name',
                'shapes.name as shape_name',
                'products.note as product_note',
                'products.status as product_status',
                'products.slug as product_slug',
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('shapes', 'products.shape_id', '=', 'shapes.id')
            ->leftJoin('sizes', 'products.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'products.color_id', '=', 'colors.id')
            ->where('products.status', '=', 'draft');

        return $dtb->collection($data->get())
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'publish' => 'primary' ,
                    'draft' => 'warning' ,
                    'trash' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->product_status] . '">' . $row->product_status . '</span>
                ';
            })
            ->addColumn('col_rating', function($row){
                $product = Product::find($row->product_id);
                $ratingVal = is_null($product->averageRating) ? 0 : $product->averageRating;
                // return '
                //     <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="'.intval($ratingVal).'" data-size="xs" disabled="">
                // ';

                return intval($ratingVal);
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-150px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.product.edit' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Edit</a>
                            <button onclick="publishRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-eye mr-3"></i>Publish
                            </button>
                            <a class="btn dropdown-item" href="' . route('backend.product.view' , ['slug' => $row->product_slug]) . '"><i class="fa fa-fw fa-eye mr-3"></i>Lihat Data</a>
                            <button onclick="trashRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Move to trash
                            </button>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'col_rating' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function getDataTrashed(DataTables $dtb)
    {
        $data = DB::table('products')
            ->select([
                'products.id as product_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.desc as product_desc',
                'categories.name as category_name',
                'colors.name as color_name',
                'sizes.name as size_name',
                'shapes.name as shape_name',
                'products.note as product_note',
                'products.status as product_status',
                'products.slug as product_slug',
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('shapes', 'products.shape_id', '=', 'shapes.id')
            ->leftJoin('sizes', 'products.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'products.color_id', '=', 'colors.id')
            ->where('products.status', '=', 'trash');

        return $dtb->collection($data->get())
            ->addColumn('status_col' , function ($row) {
                $mapStatus = [
                    'publish' => 'primary' ,
                    'draft' => 'warning' ,
                    'trash' => 'danger' ,
                ];
                return '
                    <span class="badge badge-' . $mapStatus[$row->product_status] . '">' . $row->product_status . '</span>
                ';
            })
            ->addColumn('col_rating', function($row){
                $product = Product::find($row->product_id);
                $ratingVal = is_null($product->averageRating) ? 0 : $product->averageRating;
                // return '
                //     <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="'.intval($ratingVal).'" data-size="xs" disabled="">
                // ';

                return intval($ratingVal);
            })
            ->addColumn('action' , function ($row) {
                return '
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-square btn-sm btn-outline-danger" id="btnGroupVerticalDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-caret-down "></span></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <button onclick="restoreRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-eye mr-3"></i>Restore product
                            </button>
                            <button onclick="deleteRow(' . $row->product_id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Delete product
                            </button>
                        </div>
                    </div>
                </div>
                ';
            })
            ->rawColumns([
                    'status_col' ,
                    'col_rating' ,
                    'action'
                ]
            )
            ->make('true');
    }

    public function publishing($id)
    {
        $data = Product::findOrFail($id);

        if ($data->status == 'draft') {
            $data->update([
                'created_at' => Carbon::now() ,
                'status' => 'publish'
            ]);
        }

        return response()->json($data);
    }

    public function published()
    {
        $data = [
            'route' => 'backend.product.getdataPublished'
        ];

        return view('beproduct::index' , compact('data'));
    }

    public function draft($id)
    {
        $data = Product::findOrFail($id);

        $data->update([
           'status' => 'draft'
        ]);

        return response()->json($data);
    }

    public function drafted()
    {
        $data = [
            'route' => 'backend.product.getdataDrafted'
        ];

        return view('beproduct::index' , compact('data'));
    }

    public function trash($id)
    {
        $data = Product::findOrFail($id);

        $data->update([
            'status' => 'trash'
        ]);

        return response()->json($data);
    }

    public function trashed()
    {
        $data = [
            'route' => 'backend.product.getdataTrashed'
        ];

        return view('beproduct::index' , compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['product'] = Product::where('slug' , '=' , $slug)->with('photos')->firstOrFail();

        //return $data;
        return view('beproduct::form' , compact('data'));
    }

    public function viewProduct($slug)
    {
        $data['category'] = Category::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['shape'] = Shape::all();
        $data['product'] = Product::where('slug' , '=' , $slug)->with('photos')->first();

        return view('beproduct::view_detail' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($slug , Request $request , Uploader $uploader)
    {
        $rule = [
            'category' => 'exists:categories,id' ,
            'color' => 'exists:colors,id' ,
            'size' => 'exists:sizes,id' ,
            'shape' => 'exists:shapes,id' ,
            'name' => 'required ' ,
            'desc' => 'required' ,
            'price' => 'required' ,
            'status' => 'required|in:publish,draft' ,
            'note' => 'nullable' ,
        ];
        $this->validate($request , $rule);

        $dataProduct = Product::where('slug' , '=' , $slug)->firstOrFail();

        $slug = null;
        $photos = $uploader->save($request , 'photos' , 'products');

        DB::beginTransaction();


        $slugSearch = Product::where('slug' , '=' , str_slug($request->name))->first();

        if ($slugSearch) {
            $slug = str_slug($request->name) . '-' . strtolower(str_random(4));
        } else {
            $slug = str_slug($request->name);
        }

        $data = [
            'category_id'   => $request->category ,
            'color_id'      => $request->color ,
            'size_id'       => $request->size ,
            'shape_id'      => $request->shape ,
            'name'          => $request->name ,
            'price'         => $request->price ,
            'desc'          => $request->desc ,
            'slug'          => $slug ,
            'status'        => $request->status ,
            'note'          => $request->note ,
            'user_id'       => Auth::id(),
        ];

        if ($photos) {
            $data['photos'] = $photos;
        }

        try {
            $dataProduct->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        DB::commit();
        return redirect()->route('backend.product.index');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */

    public function restore($id)
    {
        $data = Product::findOrFail($id);

        $data->update([
            'status' => 'publish'
        ]);

        return response()->json($data);
    }

    public function delete($id)
    {
        $data = Product::findOrFail($id);
        $data->forceDelete();
        return response()->json($data);
    }

    public function destroy()
    {
    }
}
