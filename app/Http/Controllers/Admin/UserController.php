<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('statuses', 'users.status', 'statuses.status_key')
                ->join('roles', 'users.role', 'roles.id')
                ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.no_hp', 'roles.name AS role', 'statuses.status_name AS status')
                ->where('statuses.status_val', '=', 'aktif')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = '<a id="editBtn" class="btn btn-warning btn-xs" href="javascript:void(0)" role="button" data-toggle="tooltip" title="Ubah Data" data-id="' . $row->id . '"><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a id="deleteBtn" class="btn btn-danger btn-xs" href="javascript:void(0)" role="button" data-toggle="tooltip" title="Hapus Data" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $data_role = Role::where('guard_name', '=', 'user')->get();
        $data_status = Status::where('status_val', '=', 'aktif')->get();
        $menu = Menu::join('permissions','menus.permission','permissions.id')
                ->select('menus.id','permissions.id','permissions.name as permissions_name','permissions.guard_name')
                ->where('menus.slug','=','admin-list')
                ->firstorfail();

        if ($this->authorize(''.$menu->permissions_name.'')) {
            return view('layouts.admin.master.user.list.index', compact('data_role', 'data_status'));
        } else {
            return redirect('/admin.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_hp' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = new User();
            $data->name = $request->nama;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->no_hp = $request->no_hp;
            $data->role = $request->role;
            $roles = Role::findById($request->role);
            $data->assignRole($roles->name);
            $data->status = $request->status;
            $query = $data->save();

            

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Data Telah Tersimpan!']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return response()->json(['details' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_hp' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = new User();
            $data->name = $request->nama;
            $data->email = $request->email;
            if ($request->password) {
                $data->password = Hash::make($request->password);
            }
            $data->no_hp = $request->no_hp;
            $data->role = $request->role;
            $roles = Role::findById($request->role);
            $data->syncRoles($roles->name);
            $data->status = $request->status;
            $query = $data->save();

            

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Data Telah Tersimpan!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $roles = Role::findById($data->role);
        $data->removeRole($roles->name);
        $data->delete();
        return response()->json(['code' => 1, 'msg' => 'Data Telah DiHapus!']);
    }
}
