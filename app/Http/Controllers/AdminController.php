<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdatePasswordAdminRequest;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tambah pagination
        $data = Admin::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Admin',
                'data'    => $data
            ], 201);
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan data Admin',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data['password'] = bcrypt($data['password']);
            $data['status'] = 'aktif';
            $create_admin = Admin::create($data);
            if($create_admin){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Registrasi Admin',
                    'data'    => $data 
                ], 201);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Admin',
            ], 401);
        }
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        if($admin){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Admin',
                'data'    => $admin
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Admin',
            ], 409);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAdminRequest $request, Admin $admin)
    {
        if($admin){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_admin'],$admin['password_admin'])){
                    $admin->update($data);
                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah Data Admin'
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
     * Update Password admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UpdatePasswordAdminRequest $request, Admin $admin){
        if($admin){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_lama'],$admin['password'])){
                    $new_password = bcrypt($data['password_baru']);
                    $admin->update([
                        'password_admin' => $new_password
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
     * Update username admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function changeUsername(CreateAdminRequest $request, Admin $admin){
        if($admin){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password'],$admin['password'])){
                    $admin->update([
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
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi pada form gan, ada yang salah di formnya',
                    'data'    => $data
                ],409);
            }
        }
    }
    /**
     * Update status admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function aktivasiAdmin(Admin $admin){
        if($admin['status']!= 'aktif'){
            $admin->update([
                'status' => 'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Nasabah Menjadi Aktif',
                'data'    => $admin
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Data Nasabah',
        ], 409);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin){
        if($admin['status']!='non-aktif'){
            $admin->update([
                'status' => 'non-aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Nasabah Menjadi Non Aktif',
                'data'    => $admin
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Non aktifkan Data Nasabah',
        ], 409);
    }
}
