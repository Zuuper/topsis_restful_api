<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login_admin',[AuthController::class,'loginAdmin']);
Route::post('login_nasabah',[AuthController::class,'loginNasabah']);
Route::post('login_warung',[AuthController::class,'loginWarung']);
Route::middleware('auth:sanctum')->group( function () {
    Route::put('nasabah/{nasabah}/update_password', [NasabahController::class,'changePassword']);
    Route::put('nasabah/{nasabah}/update_pin_transaksi',[NasabahController::class,'changePin']);
    Route::put('nasabah/{nasabah}/aktivasi_nasabah', [NasabahController::class,'aktivasiNasabah']);
    
    //route warung
    Route::put('warung/{warung}/update_password', [WarungController::class,'changePassword']);
    Route::put('warung/{warung}/aktivasi_warung', [WarungController::class,'aktivasiWarung']);
    
    
        //route produk
    Route::put('produk/{produk}/aktivasi_produk', [ProdukController::class,'aktivasiProduk']);

        //route promo
    Route::put('promo/{promo}/aktivasi_promo', [PromoController::class,'aktivasiPromo']);
    Route::put('promo/{promo}/update_gambar_promo', [PromoController::class,'updateGambar']);
    
        //route admin
    Route::put('admin/{admin}/update_password', [AdminController::class,'changePassword']);
    Route::put('admin/{admin}/update_username', [AdminController::class,'changeUsername']);
    Route::put('admin/{admin}/aktivasi_admin', [AdminController::class,'aktivasiAdmin']);
    
    // auth
    Route::delete('logout_admin/{admin}',[AuthController::class,'logoutAdmin']);

    Route::apiResource('nasabah', NasabahController::class)->middleware('auth:sanctum');
    Route::apiResource('fintech', FintechController::class);
    Route::apiResource('membership', MembershipController::class);
    Route::apiResource('warung', WarungController::class);
    Route::apiResource('produk', ProdukController::class);
    Route::apiResource('admin', AdminController::class);
    Route::apiResource('promo', PromoController::class);
});
    //route nasabah






