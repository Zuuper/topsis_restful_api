<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Nasabah;
use App\Models\Warung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Validator;
class AuthController extends Controller
{

    public function loginAdmin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        }else {
            $user = Admin::where('username_admin', $request->username)->first();
            if (!Hash::check($request->password, $user->password_admin, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('web',['role:admin'])->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 202,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'data' => $user
            ];
            return response()->json($respon, 201);
        }
    }
    
    public function loginNasabah(Request $request){
        $validate = Validator::make($request->all(), [
            'no_telpon' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 401);
        }else {
            $user = Nasabah::where('no_telpon_nasabah', $request->no_telpon)->first();
            if (!Hash::check($request->password, $user->password_nasabah, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('mobile',['role:nasabah'])->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 203,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'data' => $user
            ];
            return response()->json($respon, 201);
        }
    }
    public function loginWarung(Request $request){
        $validate = Validator::make($request->all(), [
            'no_telpon' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 401);
        }else {
            $user = Nasabah::where('no_telpon_nasabah', $request->no_telpon)->first();
            if (!Hash::check($request->password, $user->password_nasabah, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('mobile',['role:warung'])->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 203,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'data' => $user
            ];
            return response()->json($respon, 201);
        }
    }
    public function logoutAdmin(Admin $admin){
        $admin->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
    public function logoutNasabah(Nasabah $nasabah){
        $nasabah->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
    public function logoutWarung(Warung $warung){
        $warung->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
}
