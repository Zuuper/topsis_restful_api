<?php

namespace App\Http\Controllers;

use App\Models\TransferSaldoKeRekening;
use App\Models\DetailTransferSaldoKeRekening;
use App\Models\Warung;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class TransferKeRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tambah pagination
        $data = DetailTransferKeRekening::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index detail top up',
            'data'    => $data
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_warung' => 'required',
            'jumlah_transfer' => 'required|numeric'
        ]);
        if(!$validate->fails()){
            $saldo = Dompet::where('id_dompet',$detail['id_dompet'])->first();
            $saldo_awal = $saldo['saldo'];
            if($saldo_awal <= $validate['jumlah_transfer']){
                $transfer = TransferSaldoKeRekening::create([
                    'id_warung' => $validate['id_warung'],
                    'tgl_transaksi' => now()
                ]);
                if($transfer){
                    $data = $validate();
                    $data['id_transfer_ke_rekening'] = $transfer['id_transfer_ke_rekening'];
                    $warung = Warung::where('id_warung',$data['id_warung'])->first();
                    $create_detail = DetailTransferSaldoKeRekening::create([
                        'id_fintech' => $data['id_warung'],
                        'id_transfer_ke_rekening' => $data['id_transfer_ke_warung'],
                        'id_dompet' => $warung['id_warung'],
                        'jumlah_transaksi' => $data['jumlah_transfer'],
                        'no_rekening' => $warung['no_rekening_warung'],
                        'status' => 'pending'
                    ]);
                    if($create_detail){
                        $status = false;
                        for($i = 0; $i >=10;$i++){
                            sleep(1);
                            $detail = DetailTransferSaldoKeRekening::where('id_transfer_ke_rekening',$create_detail['id_transfer_ke_rekening'])->first();
                            if($detail['status'] === 'sukses'){
                                $result = Dompet::where('id_dompet',$detail['id_dompet'])->update([
                                    'saldo' => $saldo_awal - $data['jumlah_transaksi']
                                ]);
                                $status = true;
                                break;
                            }
                        }
                        return response()->json([
                            'success' => $status,
                            'data' => $create_detail
                        ],201);
                    }
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal melakukan create data detail Transfer Saldo Ke Rekening',
                        'data' => $data
                    ], 409);
                }
            }
            return response()->json([
                'success' => false,
                'message' => 'Jumlah Transfer melebihi sisa saldo yang tersedia'
            ], 400);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Masalah dalam input data transfer',
                'data' => $validate->error_log()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferSaldoKeRekening  $transferSaldoKeRekening
     * @return \Illuminate\Http\Response
     */
    public function show(TransferSaldoKeRekening $transferSaldoKeRekening)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransferSaldoKeRekening  $transferSaldoKeRekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($id){
            $data = Validator::make($request->all(), [
                'status' => 'required|in:sukses,gagal',
            ]);
            if (!$data) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Validator error',
                    'content' => null,
                ];
                return response()->json($respon, 400);
            }else {
                $result = DetailTransferSaldoKeRekening::where('id_detail_transfer_saldo_ke_rekening',$id)->update([
                    'status' => $data['status']]);
                if($result ){
                    return response()->json([
                        'success' => true,
                        'data' => $result 
                    ],201);
                }
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update data Transfer',
                    'data' => $detail_top_up
                ], 400);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan data detail Top Up',
            'data' => $detail_top_up->error_log()
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferSaldoKeRekening  $transferSaldoKeRekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferSaldoKeRekening $transferSaldoKeRekening)
    {
        //
    }
}
