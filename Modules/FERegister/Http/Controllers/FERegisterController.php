<?php

namespace Modules\FERegister\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use COOEM\Core\Classes\Uploader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FERegisterController extends Controller
{
    public function index()
    {
        $heroFill = [
            'name' => 'Register'
        ];
        return view('feregister::index', compact('heroFill'));
    }

    public function indexDesigner()
    {
        $heroFill = [
            'name' => 'Register'
        ];
        return view('feregister::index_designer', compact('heroFill'));
    }

    public function store(Request $request)
    {
        $avatar = "";
        if ($request->hasFile('file'))
        {
            $destinationPath = 'images/users/';
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
            $avatar = $name;
        }

        try {
            $userSaved = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role,
            ]);
        } catch (\Exception $exception) {
            // DB::rollback();
            return $exception;
        }

        // DB::commit();

        return redirect()->route('frontend.home.index');
    }

    public function create()
    {
        return view('feregister::create');
    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('feregister::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('feregister::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
