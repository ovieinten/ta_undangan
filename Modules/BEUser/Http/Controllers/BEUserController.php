<?php

namespace Modules\BEUser\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use COOEM\Core\Classes\Uploader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BEUserController extends Controller
{
    public function index()
    {
        $data = [
            'route' => 'backend.user.getdata'
        ];
        return view('beuser::index',compact('data'));
    }

    public function getData(DataTables $dtb)
    {
        $data = User::select('*')
            ->with('role');

        return $dtb->eloquent($data)
            ->addColumn('action' , function ($row) {
                return '
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="transform: translate3d(-150px, -30px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="btn dropdown-item" href="' . route('backend.user.edit' , ['id' => $row->id]) . '"><i class="fa fa-fw fa-pencil mr-3"></i>Ubah</a>
                            <li onclick="deleteRow(' . $row->id . ')" class="btn dropdown-item" >
                                <i class="fa fa-fw fa-trash mr-3"></i>Hapus
                            </li>
                        </ul>
                    </div>
                </div>
                ';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function form()
    {
        $data['role'] = Role::all();
        $data['user'] = User::all();
        return view('beuser::form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, Uploader $uploader)
    {
        $rule = [
            'first_name' => 'required|' ,
            'email' => 'required' ,
            'password' => 'required' ,
            'level' => 'required|' ,
            'file' => 'required|mimes:jpeg,jpg,png,bmp|max:1024',
        ];

        $this->validate($request,  $rule);
        $avatar = "";
        if ($request->hasFile('file'))
        {
            $destinationPath = 'images/users/';
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
            $avatar = $name;
        }

        // DB::beginTransaction(); ndak tesimpan

        try {
            $userSaved = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'role_id' => $request->role,
                'avatar' => $avatar 
            ]);
        } catch (\Exception $exception) {
            // DB::rollback();
            return $exception;
        }

        // DB::commit();

        return redirect()->route('backend.user.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    // public function show()
    // {
    //     return view('beuser::show');
    // }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['role'] = Role::all();
        $data['user'] = User::where('id' , '=' , $id)->first();
        return view('beuser::form', compact('data'));
    }

    public function editUser($id)
    {
        $data['role'] = Role::all();
        $data['user'] = User::where('id' , '=' , $id)->first();
        return view('beuser::form_user_profile', compact('data'));
    }

    public function update(Request $request, $id, Uploader $uploader)
    {
        $rule = [
            'first_name' => 'required|' ,
            'email' => 'required' ,
            'password' => 'required' ,
        ];
        $this->validate($request , $rule);

        $dataUser = User::where('id' , '=' , $id)->firstOrFail();
        $avatar = $uploader->save($request , 'file' , 'users');

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'role_id' => $request->role,
        ];

        if ($avatar) {
            $data['avatar'] = $avatar;
        }

        try {
        $dataUser->update($data);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }

        return redirect()->route('backend.user.index');

    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
}
