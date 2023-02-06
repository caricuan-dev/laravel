<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Menu::join('statuses', 'menus.status', 'statuses.status_key')
                ->join('permissions', 'menus.permission', 'permissions.id')
                ->select('menus.id', 'menus.display', 'menus.header', 'menus.menu_title', 'menus.parent_id', 'menus.sort_order', 'menus.icon', 'menus.slug', 'permissions.name AS permission', 'permissions.id AS perm_id', 'statuses.status_name')
                ->where('statuses.status_val', '=', 'aktif')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = '<a id="deleteBtn" class="btn btn-danger btn-xs" href="javascript:void(0)" role="button" data-toggle="tooltip" title="Hapus Data" data-id="' . $row->id . '" data-perm="' . $row->perm_id . '"><i class="fas fa-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $menu_admin = Menu::where('display', '=', 'Admin')
            ->where('header', '=', 'Yes')
            ->get();
        $menu_user = Menu::where('display', '=', 'User')
            ->where('header', '=', 'Yes')
            ->get();
        $menu_public = Menu::where('display', '=', 'Public')
            ->where('header', '=', 'Yes')
            ->get();
        return view('layouts.admin.master.navigasi.index', compact('menu_admin', 'menu_user', 'menu_public'));
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
            'menu' => 'required',
            'icon' => 'required',
            'slug' => 'required',
            'perm' => 'required',
            'statusid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data_perm = new Permission();
            $data_perm->name = $request->perm;
            $data_perm->guard_name = strtolower($request->lokasi);
            $query_data_perm = $data_perm->save();
            $new_id_perm = $data_perm->id;

            if (!$query_data_perm) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong when create permission']);
            } else {
                $data = new Menu();
                $data->display = $request->lokasi;
                $data->header = $request->header;
                $data->menu_title = $request->menu;
                $data->parent_id = $request->menu_induk;
                $data->icon = $request->icon;
                $data->sort_order = $request->sort;
                $data->slug = $request->slug;
                $data->permission = $new_id_perm;
                $data->status = $request->statusid;
                $query = $data->save();

                if (!$query) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong create menu']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Data Telah Tersimpan!']);
                }
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
        $data = Menu::join('permissions', 'menus.permission', 'permissions.id')
            ->select('menus.*', 'permissions.name as perm_name', 'permissions.id as perm_id')
            ->where('menus.id', '=', $id)
            ->first();
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
            'menu' => 'required',
            'icon' => 'required',
            'slug' => 'required',
            'perm' => 'required',
            'statusid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data_perm = Permission::find($request->perm_id);
            $data_perm->name = $request->perm;
            $data_perm->guard_name = strtolower($request->lokasi);
            $query = $data_perm->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong when update permission']);
            } else {
                $data = Menu::find($id);
                $data->display = $request->lokasi;
                $data->header = $request->header;
                $data->menu_title = $request->menu;
                $data->parent_id = $request->menu_induk;
                $data->icon = $request->icon;
                $data->sort_order = $request->sort;
                $data->slug = $request->slug;
                $data->permission = $request->perm_id;
                $data->status = $request->statusid;
                $query = $data->save();

                if (!$query) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong when update menu']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Data Telah Tersimpan!']);
                }
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
        $data = Menu::find($id);
        $query = Permission::where('id','=',$data->permission)->delete();
        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong when update menu']);
        } else {
            Menu::find($id)->delete();
            return response()->json(['code' => 1, 'msg' => 'Data Telah DiHapus!']);
        }
        
    }
}
