<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Dompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Nasabah\CreateNasabahRequest;
use App\Http\Requests\Nasabah\UpdateBiodataNasabahRequest;
use App\Http\Requests\Nasabah\UpdatePasswordNasabahRequest;
use App\Http\Requests\Nasabah\UpdatePinNasabahRequest;
use App\Http\Requests\Nasabah\UpdateUsernameNasabahRequest;

use Carbon\Carbon;
class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // tambah pagination
        $data = Nasabah::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Nasabah',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Tidak ditemukan data Nasabah',
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNasabahRequest $request){
        $data = $request->validated();
        if($data){
            $data['password_nasabah'] = bcrypt($data['password_nasabah']);
            $data['tanggal_aktif_nasabah'] = now();
            $data['status_nasabah'] = 'aktif';
            $data['pin_transaksi_nasabah'] = bcrypt($data['pin_transaksi_nasabah']);
            $create_dompet = Dompet::create([
                                'saldo' =>  0,
                            ]);
            if($create_dompet){
                $data_dompet = Dompet::latest('created_at')->first();
                $data['id_dompet'] = $data_dompet['id_dompet'];
                $create_nasabah = Nasabah::create($data);
                if($create_nasabah){
                   return response()->json([
                   'success' => true,
                   'message' => 'Berhasil Registrasi Nasabah',
                   'data'    => $data 
                ], 201);
            }
                }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Nasabah',
            ], 404);
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function show(Nasabah $nasabah){
        if($nasabah){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Nasabah',
                'data'    => $nasabah
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Nasabah',
            ], 409);
        }
    }

    /**
     * Update the specified resource in storage.
     * kalau mau update harus ada verifikasi password user
     * disini cuma update biodata aja, klo username gabisa di update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBiodataNasabahRequest $request, Nasabah $nasabah){
        if($nasabah){
            $data = $request->validated();
            if($data){
                
                if(Hash::check($data['password_nasabah'],$nasabah['password_nasabah'])){
                    $result = $nasabah->update([
                        'id_fintech'            => $data['id_fintech'],
                        'id_membership'         => $data['id_membership'],
                        'nama_nasabah'          => $data['nama_nasabah'],
                        'alamat_nasabah'        => $data['alamat_nasabah'],
                        'nik_nasabah'           => $data['nik_nasabah'],
                        'no_telpon_nasabah'     => $data['no_telpon_nasabah'],

                    ]);
                    if($result){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengganti Biodata Nasabah',
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
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                ], 409);
            }
        }

    }
    /**
     * Update the pin atau password yang dimiliki nasabah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UpdatePasswordNasabahRequest $request, Nasabah $nasabah){
        if($nasabah){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_lama'],$nasabah['password_nasabah'])){
                    $new_password = bcrypt($data['password_baru']);
                    $nasabah->update([
                        'password_nasabah' => $new_password
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah Password'
                    ],201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Salah Verifikasi Password, cb ulang password lamamu'
                    ],403);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya', 
                ],409);
        }
        return response()->json([
            'success' => false,
            'message' => 'data tidak ditemukan'
        ],404);
        }
    } 

    /**
     * Update the pin Username dimiliki nasabah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function changePin(UpdatePinNasabahRequest $request,Nasabah $nasabah){
        if($nasabah){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_nasabah'],$nasabah['password_nasabah'])){
                    if(Hash::check($data['pin_transaksi_lama'],$nasabah['pin_transaksi_nasabah'])){
                        $data_update = bcrypt($data['pin_transaksi_baru']);
                        $nasabah->update([
                            'pin_transaksi_nasabah' => $data_update
                        ]);
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengubah Pin Transaksi'
                        ],201);
                    }
                    else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Salah Verifikasi Pin Transaksi, cb ulang pin transaksi lamamu'
                        ],403);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Salah Verifikasi Password, cb ulang password lamamu'
                    ],403);
                }             
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya',
                    'data'    => $data
                ],409);  
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ],404);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        if($nasabah['status']!='non-aktif'){
            $nasabah->update([
                'status' => 'non-aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Nasabah Menjadi Non Aktif',
                'data'    => $nasabah
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Non aktifkan Data Nasabah',
        ], 409);
    }
    public function aktivasiNasabah(Nasabah $nasabah){
        if($nasabah['status']!= 'aktif'){
            $nasabah->update([
                'status' => 'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Nasabah Menjadi Aktif',
                'data'    => $nasabah
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Data Nasabah',
        ], 409);
    }
}
