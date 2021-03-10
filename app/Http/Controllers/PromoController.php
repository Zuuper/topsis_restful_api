<?php

namespace App\Http\Controllers;

use app\Models\Promo;
use Illuminate\Http\Request;
use app\Http\Requests\Promo\CreatePromoRequest;


class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Promo::all();
        return response() ->json([
            'success' => true,
            'message' => 'Ini Index Promo',
            'data'    => $data
        ], 201);
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
    public function store(CreatePromoRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return respons()->json([
                'success' => false,
                'message' => 'Gagal menambahkan promo',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_promo = Promo::create($data);
            if($create_promo){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan promo',
                    'data'    => $data
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        if($promo){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Promo',
                'data'    => $promo
            ], 200);
        }
        else{
            return response()->json([
                'success' =>false,
                'message' => 'Gagal dalam menampilkan data promo',
            ], 409);
        }
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
        //
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
