<?php

namespace App\Http\Controllers;

use App\Models\TransferAntarNasabah;
use App\Models\Nasabah;
use App\Models\Dompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferAntarNasabah\CreateTransferAntarNasabahRequest;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class TransferAntarNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransferAntarNasabah::all();
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
    public function store(CreateTransferAntarNasabahRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan transfer. Ada Data yang tidak valid!',
            ], 400);
        }
        else{
            $data_nasabah_pengirim = Nasabah::where('id_nasabah',$data['id_nasabah_pengirim'])->first(); //ngambil data nasabah pengirim
            $data_nasabah_penerima = Nasabah::where('id_nasabah',$data['id_nasabah_penerima'])->first();

            $dompet_nasabah_pengirim = Dompet::where('id_dompet',$data_nasabah_pengirim['id_dompet'])->first(); //ngambil data saldo pengirim
            $dompet_nasabah_penerima = Dompet::where('id_dompet',$data_nasabah_penerima['id_dompet'])->first();

            if(Hash::check($data['pin_transaksi_nasabah'], $data_nasabah_pengirim['pin_transaksi_nasabah'])){
                if($dompet_nasabah_pengirim['saldo']<=$data['jumlah_transfer']){
                    return response()->json([
                        'success' => false,
                        'message' => 'Transfer Gagal. Saldo tidak cukup!'
                    ], 400);
                }
                else{
                    $create_transfer = TransferAntarNasabah::create([
                        'id_nasabah_pengirim' => $data['id_nasabah_pengirim'],
                        'id_nasabah_penerima' => $data['id_nasabah_penerima'],
                        'jumlah_transfer'     => $data['jumlah_transfer'],
                        'catatan'             => $data['catatan']
                    ]);
                    if($create_transfer){
                        $dompet_nasabah_pengirim['saldo'] = $dompet_nasabah_pengirim['saldo']-$data['jumlah_transfer'];
                        $dompet_nasabah_penerima['saldo'] = $dompet_nasabah_penerima['saldo']+$data['jumlah_transfer'];
    
                        $result_pengirim = $dompet_nasabah_pengirim->update([
                            'saldo'     => $dompet_nasabah_pengirim['saldo']
                        ]);
    
                        $result_penerima = $dompet_nasabah_penerima->update([
                            'saldo'     => $dompet_nasabah_penerima['saldo']
                        ]);

                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Transfer Saldo',
                            'data'    => $create_transfer
                        ], 201);
                    } 
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal melakukan transfer. Pin transaksi Salah',
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