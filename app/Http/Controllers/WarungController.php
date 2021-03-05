<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use Illuminate\Http\Request;
use App\Http\Requests\Warung\CreateWarungRequest;

class WarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWarungRequest $request)
    {
        $data = $request->validated();
        if($data->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Warung',
            ], 404);
        }
        else{
            $data['password'] = bcrypt($data['password']);
            $data['tanggal_aktif'] = now();
            $data['status'] = 'aktif';
            $create_warung = Warung::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Buat Warung',
                'data'    => $create_warung 
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Warung $warung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warung $warung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warung $warung)
    {
        //
    }
}
