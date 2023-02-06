<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SistemInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SistemInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistem = SistemInfo::find('1');
        return view ('layouts.admin.master.sistem.info.index', [
            'title' => 'Informasi Sistem',
            'nama' => $sistem->nama,
            'badan' => $sistem->badan,
            'alamat' => $sistem->alamat,
            'kelurahan_desa' => $sistem->kelurahan_desa,
            'kecamatan' => $sistem->kecamatan,
            'kabupaten_kota' => $sistem->kabupaten_kota,
            'provinsi' => $sistem->provinsi,
            'kodepos' => $sistem->kodepos,
            'hp' => $sistem->hp,
            'email' => $sistem->email,
            'logo' =>$sistem->logo
        ]);
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
        //
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
        //
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
            'logo' => 'image|file|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = SistemInfo::find('1');
            if($request->file('logo')) {
                $path =  Storage::putFileAs('images', $request->file('logo'), $request->file('logo')->getClientOriginalName() );
                $data->logo = $path;
            }
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
        //
    }
}
