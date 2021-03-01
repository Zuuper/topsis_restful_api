<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Nasabah\CreateNasabahRequest;
use App\Http\Requests\Nasabah\UpdateBiodataNasabahRequest;
use App\Http\Requests\Nasabah\UpdatePasswordNasabahRequest;

use Carbon\Carbon;
class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tambah pagination
        $data = Nasabah::all();
        $testing = bcrypt('ini password');
        if(Hash::check('ini password',$testing)){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Nasabah',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Ini passwordnya beda',
            'data'    => $testing
        ], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNasabahRequest $request)
    {
        $data = $request->validated();
        if($data->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Nasabah',
            ], 404);
        }
        else{
            $data['password'] = bcrypt($data['password']);
            $data['tangal_aktif'] = now();
            $data['status'] = 'aktif';
            $data['pin_transaksi'] = bcrypt($data['pin_transaksi']);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function show(Nasabah $nasabah)
    {
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
    public function update(UpdateBiodataNasabahRequest $request, Nasabah $nasabah)
    {
        if($nasabah){
            $data = $request->validated();
            if($data->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                ], 409);
            }
            else{
                if(Hash::check($data['password'],$nasabah['password'])){
                    $result = $nasabah->update([
                        'id_fintech'    => $data['id_fintech'],
                        'id_membership' => $data['id_membership'],
                        'nama_nasabah'  => $data['nama_nasabah'],
                        'alamat'        => $data['alamat'],
                        'nik_nasabah'   => $data['nik_nasabah'],
                        'no_rekening'   => $data['no_rekening'],
                        'no_telpon'     => $data['no_telpon'],

                    ]);
                    if($result){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengganti Biodata Nasabah',
                            'data'    => $result
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
     * Update the pin atau password yang dimiliki nasabah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UpdatePasswordNasabahRequest $request, Nasabah $nasabah){
        if($nasabah){
            $data = $request->validated();
            if($data->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya',
                    'data'    => $data->errors()  
                ],409);
            }
            else{
                if(Hash::check($data['password_lama'],$nasabah['password'])){
                    $new_password = bcrypt($data['password_baru']);
                    $nasabah->update([
                        'password' => $new_password
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
            $data->$request->validated();
            if($data->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya',
                    'data'    => $data->errors()  
                ],409);               
            }
            else{
                if(Hash::check($data['password'],$nasabah['password'])){
                    if(Hash::check($data['pin_transaksi_lama'],$nasabah['pin_transaksi'])){
                        $data_update = bcrypt($data['pin_transaksi_baru']);
                        $nasabah->update([
                            'pin_transaksi' => $data_update
                        ]);
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengubah username'
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
        }
        else{
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
    public function changeUsername(UpdateUsernameNasabahRequest $request,Nasabah $nasabah){
        if($nasabah){
            $data = $request->validated();
            if($data->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya',
                    'data'    => $data->errors()  
                ],409);
            }
            else{
                if(Hash::check($data['password'],$nasabah['password'])){
                    $nasabah->update([
                        'username' => $data['username']
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah username'
                    ],201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Salah Verifikasi Password, cb ulang password lamamu'
                    ],403);
                }
            }
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
