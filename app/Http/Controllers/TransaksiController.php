<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Nasabah;
use App\Models\Warung;
use App\Models\Dompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Transaksi\CreateTransaksiRequest;

use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini index Transaksi',
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
    public function store(CreateTransaksiRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan transaksi. Ada data yang tidak valid!'
            ], 400);
        }
        else{
            $data_nasabah = Nasabah::where('id_nasabah',$data['id_nasabah'])->first();
            $data_warung  = Warung::where('id_warung',$data['id_warung'])->first();

            $dompet_nasabah = Dompet::where('id_dompet', $data_nasabah['id_dompet'])->first();
            $dompet_warung = Dompet::where('id_dompet', $data_warung['id_dompet'])->first();

            if(Hash::check($data['pin_transaksi_nasabah'], $data_nasabah['pin_transaksi_nasabah'])){
                if($dompet_nasabah['saldo']<=$data['jumlah_transaksi']){
                    return response()->json([
                        'success' => false,
                        'message' => 'Transaksi Gagal. Saldo tidak cukup!'
                    ], 400);
                }
                else{
                    $create_transaksi = Transaksi::create([
                        'tgl_transaksi' => now()
                    ]);
                    if($create_transaksi){
                        $create_detail = DetailTransaksi::create([
                            'id_transaksi' => $create_transaksi['id_transaksi'],
                            'id_nasabah' => $data['id_nasabah'],
                            'id_warung' => $data['id_warung'],
                            'jumlah_transaksi' => $data['jumlah_transaksi'],
                            'catatan' => $data['catatan']
                        ]);
                        if($create_detail){
                            $dompet_nasabah['saldo'] = $dompet_nasabah['saldo']-$data['jumlah_transaksi'];
                            $dompet_warung['saldo']  = $dompet_warung['saldo']+$data['jumlah_transaksi'];

                            $result_nasabah = $dompet_nasabah->update([
                                'saldo'  => $dompet_nasabah['saldo']
                            ]);

                            $result_warung = $dompet_warung->update([
                                'saldo'  => $dompet_warung['saldo']
                            ]);

                            return response()->json([
                                'success' => true,
                                'message' => 'Transaksi Berhasil!',
                                'data'    => $create_detail
                            ], 201);
                        }
                    }
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal melakukan transaksi. Pin transaksi Salah',
                ], 400);
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
