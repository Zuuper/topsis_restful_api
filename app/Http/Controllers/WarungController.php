<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Warung\CreateWarungRequest;
use App\Http\Requests\Warung\UpdateBiodataWarungRequest;
use App\Http\Requests\Warung\UpdatePasswordWarungRequest;

use Carbon\Carbon;
class WarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Warung::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Warung',
            'data'    => $data
        ], 201);
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
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Warung',
            ], 404);
        }
        else{
            $data['password_warung'] = bcrypt($data['password_warung']);
            $data['tanggal_aktif'] = now();
            $data['status'] = 'aktif';
                $create_tabungan = Tabungan::create([
                    'no_rekening' => now()->timestamp,
                    'id_fintech' => $data['id_fintech'],
                    'saldo'    => '0',
                ]);
                if($create_tabungan){
                    $data_tabungan = Tabungan::latest('created_at')->first();
                    $data['id_tabungan'] = $data_tabungan['id_tabungan'];
                    $create_warung = Warung::create($data);
                    if($create_warung){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Registrasi Warung',
                            'data'    => $data 
                        ], 201);
                    }
                
                }
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
        if($warung){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Warung',
                'data'     => $warung
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data warung',
            ], 409);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBiodataWarungRequest $request, Warung $warung)
    {
        if($warung){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Data tidak valid',
                ], 409);
            }
            else{
                if(Hash::check($data['password_warung'],$warung['password_warung'])){
                    $result = $warung->update([
                        'id_fintech'        => $data['id_fintech'],
                        'nama_pemilik'      => $data['nama_pemilik'],
                        'nik_pemilik'       => $data['nik_pemilik'],
                        'alamat_warung'     => $data['alamat_warung'],
                        'nama_warung'       => $data['nama_warung'],
<<<<<<< HEAD
                        'no_telpon_warung'  => $data['no_telpon_warung'],
=======
                        'no_rekening'       => $data['no_rekening'],
                        'no_telpon'         => $data['no_telpon'],
>>>>>>> 172c6aab868fd92ed25653e2290acfcb2b7dd71b

                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil Mengganti Biodata Warung',
                            'data'      => $result
                        ], 201);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password tidak sesuai',
                    ], 401);
                }
            }
        }

    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UpdatePasswordWarungRequest $request, Warung $warung)
    {
        if($warung){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Data tidak valid',
                ], 409);
            }
            else{
                if(Hash::check($data['password_lama'],$warung['password_warung'])){
                    $new_password = bcrypt($data['password_baru']);;
                    $warung->update([
                        'password_warung' => $new_password
                    ]);

                    return response()->json([
                        'success'   => true,
                        'message'   => 'Berhasil Mengganti Password Warung',
                    ], 201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password lama salah',
                    ], 403);
                }
            }
        return response()->json([
            'success' => false,
            'message' => 'data tidak ditemukan'
        ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warung $warung)
    {
        if($warung['status']!='non aktif'){
            $warung->update([
                'status' => 'non aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan warung',
                'data'      => $warung
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan warung',
        ], 409);
    }
    
    public function aktivasiWarung(Warung $warung){
        if($warung['status']!='aktif'){
            $warung->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan warung',
                'data'    => $warung
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi warung',
        ], 409);
    }
}
