<?php

namespace App\Http\Controllers;

use App\Models\fintech;
use Illuminate\Http\Request;
use App\Http\Requests\Fintech\CreateFintechRequest;
class FintechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Fintech',
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFintechRequest $request)
    {
        $create_fintech = Fintech::create($request->validated());

        if($create_fintech){
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Buat Fintech',
                'data'    => $create_fintech 
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Dalam Menyimpan',
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fintech  $fintech
     * @return \Illuminate\Http\Response
     */
    public function show(fintech $fintech)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Fintech',
            'data'    => $fintech
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fintech  $fintech
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFintechRequest $request, fintech $fintech)
    {
        if($fintech){
            $fintech->update($request->validated());
            if($fintech){
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses Update Data Fintech',
                    'data'    => $fintech
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Gagal Update Data Fintech',
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fintech  $fintech
     * @return \Illuminate\Http\Response
     */
    public function destroy(fintech $fintech)
    {
        if($fintech){
            $fintech->update([
                'status' => 'non_aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Fintech Menjadi Non Aktif',
                'data'    => $fintech
            ], 200);
        }
    }
}

