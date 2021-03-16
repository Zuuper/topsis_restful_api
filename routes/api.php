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
Route::middleware(['auth:sanctum','type.admin'])->group( function () {
    // endpoint nasabah yang hanya bisa di akses oleh admin
    Route::put('nasabah/{nasabah}/aktivasi_nasabah', [NasabahController::class,'aktivasiNasabah']);
    Route::apiResource('nasabah', NasabahController::class)->only(['index','store']);

    // endpoint warung yang hanya bisa di akses oleh admin 
    Route::put('warung/{warung}/aktivasi_warung', [WarungController::class,'aktivasiWarung']);

    // endpoint admin yang hanya bisa di akses oleh admin
    Route::put('admin/{admin}/update_password', [AdminController::class,'changePassword']);
    Route::put('admin/{admin}/update_username', [AdminController::class,'changeUsername']);
    Route::put('admin/{admin}/aktivasi_admin', [AdminController::class,'aktivasiAdmin']); 
    Route::apiResource('fintech', FintechController::class);
    Route::apiResource('membership', MembershipController::class);
    Route::delete('logout_admin/{admin}',[AuthController::class,'logoutAdmin']);
    Route::apiResource('admin', AdminController::class);
});
Route::middleware(['nasabah:sanctum','type.nasabah'])->group( function () {
    Route::put('nasabah/{nasabah}/update_password', [NasabahController::class,'changePassword']);
    Route::put('nasabah/{nasabah}/update_pin_transaksi',[NasabahController::class,'changePin']); 
    Route::apiResource('nasabah', NasabahController::class)->only(['show','update']);
    Route::delete('logout_nasabah/{nasabah}',[AuthController::class,'logoutNasabah']);

});
Route::middleware(['auth:sanctum','type.warung'])->group( function () {
    Route::put('warung/{warung}/update_password', [WarungController::class,'changePassword']);
    Route::put('produk/{produk}/aktivasi_produk', [ProdukController::class,'aktivasiProduk']);
    Route::apiResource('warung', WarungController::class)->only(['show','update']);
    Route::apiResource('produk', ProdukController::class);
    Route::delete('logout_warung/{warung}',[AuthController::class,'logoutWarung']);
    Route::apiResource('transfer_saldo', TopUpController::class)->only(['show','store']);
}); 

// endpoint yang bisa diakses oleh engine LPD
Route::apiResource('topup', TopUpController::class)->only(['show','store']);
Route::apiResource('transfer_saldo', TopUpController::class)->only(['update','index']);
Route::apiResource('topup', TopUpController::class)->only(['update','index']);

Route::apiResource('transferAntarNasabah', TransferAntarNasabahController::class)->only(['store']);
Route::apiResource('transaksi', TransaksiController::class)->only(['store']);






