<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\Nasabah;
use App\Models\DetailTopUp;
use Illuminate\Http\Request;
use App\Http\Requests\TopUp\CreateTopUpRequest;
use App\Http\Requests\TopUp\UpdateStatusTopUpRequest;
use Carbon\Carbon;
use Validator;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tambah pagination
        $data = DetailTopUp::all();
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
    public function store(CreateTopUpRequest $request)
    {
        $data = $request->validated();
        if($data){
            $topup = TopUp::create([
                'id_nasabah' => $data['id_nasabah'],
                'tgl_transaksi' => now()
            ]);
            if($topup){
                $data['id_topup'] = $topup['id_topup'];
                $nasabah = Nasabah::where('id_nasabah', $data['id_nasabah'])->first();
                $create_detail = DetailTopUp::create([
                    'id_topup' => $data['id_topup'],
                    'id_fintech' => $nasabah['id_fintech'],
                    'id_dompet' => $nasabah['id_dompet'],
                    'no_rekening' =>$nasabah['no_rekening_nasabah'],
                    'jumlah_transaksi' => $data['jumlah_topup'],
                    'status' => 'pending'
                ]);
                
                if($create_detail){
                    $status = false;
                    sleep(2);
                    for($i = 0; $i >=10;$i++){
                        sleep(2);
                        $detail = DetailTopUp::where('id_detail_topup',$create_detail['id_detail_topup'])->first();
                        if($detail['status'] === 'sukses'){
                            $saldo = Dompet::where('id_dompet',$detail['id_dompet'])->update([
                                'saldo' => $data['jumlah_transaksi']
                            ]);
                            $status = true;
                            break;
                        }
                        ob_flush();
                        flush();
                    }
                    return response()->json([
                        'success' => $status,
                        'status' => $create_detail
                    ],201);
                }
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal melakukan create data detail Top Up ',
                    'data' => $data
                ], 409);

            }
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan create data Top Up ',
            ], 402);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal verifikasi data Top Up ',
        ], 401);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTopUp $detail_top_up)
    {
        return $detail_top_up;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusTopUpRequest $request,$id)
    {
        if($id){
            $data = $request->validated();
            if (!$data) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Validator error',
                    'content' => null,
                ];
                return response()->json($respon, 200);
            }else {
                $result = DetailTopUp::where('id_detail_topup',$id)->update([
                    'status' => $data['status']]);
                if($result ){
                    return response()->json([
                        'success' => true,
                        'data' => $result 
                    ],201);
                }
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update data Top Up ',
                    'data' => $detail_top_up
                ], 400);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan data detail Top Up ',
            'data' => $detail_top_up->error_log()
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
