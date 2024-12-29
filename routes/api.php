<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaOperatorController;
use App\Http\Controllers\PengawasMandorController;
use App\Http\Controllers\PengawasPembayaranController;
use App\Http\Controllers\PengawasProfilController;
use App\Http\Controllers\PengawasTagihanController;
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

Route::post('login', [LoginController::class, 'loginApi']);

Route::prefix('pengawasmandor')->middleware(['auth:sanctum', 'auth.pengawas'])->group(function () {
    Route::get('beranda', [BerandaOperatorController::class, 'indexApi']);
    Route::resource('mandor', PengawasMandorController::class);
    Route::resource('tagihan', PengawasTagihanController::class);
    Route::resource('pembayaran', PengawasPembayaranController::class);
    Route::resource('profil', PengawasProfilController::class);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
