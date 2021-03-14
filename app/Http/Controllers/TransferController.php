<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Produk\CreateTransferRequest;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transfer::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Transfer',
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
    public function store(CreateTransferRequest $request)
    {
        $data = $request->validated();
        if(!data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan transfer. Ada Data yang tidak valid!',
            ], 404);
        }
        else{
            $data_nasabah = Nasabah::where('id_nasabah',$data['id_nasabah'])->first();
            $data_penerima = Nasabah::where('id_nasabah',$data['id_nasabah_penerima'])->first();
            if(Hash::check($data['pin_transaksi_nasabah'], $data_nasabah['pin_transaksi_nasabah'])){
                $create_transfer = Transfer::create($data);
                if($create_transfer){
                    $data_nasabah['saldo_nasabah'] = $data_nasabah['saldo_nasabah']-$data['jumlah_transfer'];
                    $data_penerima['saldo_nasabah'] = $data_penerima['saldo_nasabah']+$data['jumlah_transfer'];
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal melakukan transfer. Password Salah',
                ], 404);
            }

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        if($transfer){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Transfer',
                'data'    => $transfer
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data Transfer',
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
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}