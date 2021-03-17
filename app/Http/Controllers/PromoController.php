<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Warung;
use Illuminate\Http\Request;
use App\Http\Requests\Promo\CreatePromoRequest;
use App\Http\Requests\Promo\UpdatePromoRequest;
use App\Http\Requests\Promo\UpdateGambarPromoRequest;

use Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Promo::all();
        return response() ->json([
            'success' => true,
            'message' => 'Ini Index Promo',
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
    public function store(CreatePromoRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return respons()->json([
                'success' => false,
                'message' => 'Gagal menambahkan promo',
            ], 404);
        }
        else{
            //kalo mo ambil gambar ikutin 3 baris dibawah ini, OK!
            //nyari data warung berdasarkan id
            $warung = Warung::where('id_warung', $data['id_warung'])->first();

            //membuat lokasi folder penyimpanan gambar, kalo mo ngambil gambar, lokasi gambar di sini
            $lokasi_gambar = 'Promo'.$data['id_warung'];

            //mengambil gambar nya
            $gambar_promo = $request->file('gambar_promo');

            //menyimpan gambar
            $simpan_gambar = Storage::put($lokasi_gambar, $gambar_promo);

            //variabel untuk menyimpan nama gambar
            $nama_gambar = basename($simpan_gambar);

            $data['status'] = 'aktif';
            $data['gambar_promo'] = $nama_gambar;
            $create_promo = Promo::create($data);
            if($create_promo){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan promo',
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
    public function show(Promo $promo)
    {
        if($promo){
            $lokasi_gambar = 'Promo_Warung_'.$promo['id_warung'].'/'.$promo['gambar_promo'];
            $promo['gambar_promo'] = $lokasi_gambar;
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Promo',
                'data'    => $promo
            ], 200);
        }
        else{
            return response()->json([
                'success' =>false,
                'message' => 'Gagal dalam menampilkan data promo',
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
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoRequest $request, Promo $promo)
    {
        if($promo){
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
                    $result = $promo->update([
                        'tanggal_mulai'     => $data['tanggal_mulai'],
                        'tanggal_berakhir'  => $data['tanggal_berakhir'],
                        'diskon'            => $data['diskon'],
                        'keterangan'        => $data['keterangan']
                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil meng-update data Promo',
                            'data'      => $promo
                        ], 201);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password warung salah',
                    ], 401);
                }
            }
        }
    }

    public function updateGambar(UpdateGambarPromoRequest $request, Promo $promo)
    {
        if($promo){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Gambar tidak valid',
                ], 409);
            }
            else{
                $gambar_baru = $request->file('gambar_promo');
                    
                $lokasi_gambar = 'Promo';

                //menyimpan gambar
                $simpan_gambar = Storage::put($lokasi_gambar, $gambar_baru);

                $nama_gambar = basename($simpan_gambar);

                $result = Promo::update([
                    'gambar_promo' => $nama_gambar
                ]);
                if($result){
                    return response()->json([
                        'success'   => true,
                        'message'   => 'Berhasil meng-update Gambar Promo',
                        'data'      => $result
                    ], 201);
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
    public function destroy(Promo $promo)
    {
        if($promo['status']!='non aktif'){
            $promo->update([
                'status' => 'non aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan promo',
                'data'      => $promo
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan promo',
        ], 409);
    }

    public function aktivasiPromo(Promo $promo){
        if($promo['status']!='aktif'){
            $promo->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan promo',
                'data'    => $promo
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi promo',
        ], 409);
    }
}
