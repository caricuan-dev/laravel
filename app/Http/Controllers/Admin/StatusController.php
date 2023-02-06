<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Status::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<a id="editBtn" class="btn btn-warning btn-xs" href="javascript:void(0)" role="button" data-toggle="tooltip" title="Ubah Data" data-id="'.$row->id.'"><i class="fas fa-pencil-alt"></i></a>';
                $btn = $btn.' <a id="deleteBtn" class="btn btn-danger btn-xs" href="javascript:void(0)" role="button" data-toggle="tooltip" title="Hapus Data" data-id="'.$row->id.'"><i class="fas fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);

        }

        // if ( $this->authorize('read role') ) {
            return view('layouts.admin.master.sistem.status.index');
        // } else {
        //     return redirect('/admin.dashboard');
        // }
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
            'status' => 'required',
            'key' => 'required',
            'val' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = new Status();
            $data->status_name = $request->status;
            $data->status_key = $request->key;
            $data->status_val = $request->val;
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
        $data = Status::find($id);
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
            'status' => 'required',
            'key' => 'required',
            'val' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = Status::find($id);
            $data->status_name = $request->status;
            $data->status_key = $request->key;
            $data->status_val = $request->val;
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
        Status::find($id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Data Telah DiHapus!']);
    }
}
