<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Produk\CreateProdukRequest;
use App\Http\Requests\Produk\UpdateProdukRequest;

use Carbon\Carbon;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Produk',
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
    public function store(CreateProdukRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return respons()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Produk',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_produk = Produk::create($data);
            if($create_produk){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan produk',
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
    public function show(Produk $produk)
    {
        if($produk){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Produk',
                'data'    => $produk
            ], 200);
        }
        else{
            return response()->json([
                'success' =>false,
                'message' => 'Gagal dalam menampilkan data produk',
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
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        if($produk){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Data tidak valid',
                ], 409);
            }
            else{
                $data_warung = Warung::where('id_warung',$data['id_warung'])->first();
                if(Hash::check($data['password_warung'],$data_warung['password_warung'])){
                    $result = $produk->update([
                        'nama_produk'        => $data['nama_produk'],
                        'keterangan_produk'  => $data['keterangan_produk'],
                        'harga_produk'       => $data['harga_produk'],
                        'stok_produk'        => $data['stok_produk'],
                        'gambar_produk'      => $data['gambar_produk'],
                        'kategori'           => $data['kategori'],

                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil meng-update Produk',
                            'data'      => $result
                        ], 201);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password salah',
                    ], 401);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if($produk['status']!='non aktif'){
            $produk->update([
                'status' => 'non aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan produk',
                'data'      => $produk
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan produk',
        ], 409);
    }

    public function aktivasiProduk(Produk $produk){
        if($produk['status']!='aktif'){
            $produk->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan produk',
                'data'    => $produk
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi produk',
        ], 409);
    }
}
