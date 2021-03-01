<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Requests\Membership\CreateMembershipRequest;
use App\Http\Resources\ProjectResource;
class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tambah pagination
        $data = Membership::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Membership',
            'data'    => $data
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMembershipRequest $request)
    {
        $create_membership = Membership::create($request->validated());
        if($create_membership){
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Buat Fintech',
                'data'    => $create_membership 
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menyimpan',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        if($membership){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Membership',
                'data'    => $membership
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data',
            ], 409);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMembershipRequest $request, Membership $membership)
    {
        if($membership){
            $membership->update($request->validated());
            if($membership){
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses Update Data Membership',
                    'data'    => $request
                ], 201);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Update Data Membership',
                ], 409);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        if($membership){
            $membership->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus data Membership',
                'data'    => $membership
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Menghapus Data Membership',
        ], 409);
    }
}
