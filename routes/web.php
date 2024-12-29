<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankPerusahaanController;
use App\Http\Controllers\BerandaMandorController;
use App\Http\Controllers\BerandaOperatorController;
use App\Http\Controllers\BerandaPengawasController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KartuPembayaranController;
use App\Http\Controllers\KwitansiPembayaranController;
use App\Http\Controllers\LaporanFormController;
use App\Http\Controllers\LaporanPembayaranController;
use App\Http\Controllers\LaporanRekapPembayaran;
use App\Http\Controllers\LaporanTagihanController;
use App\Http\Controllers\MandorController;
use App\Http\Controllers\MandorProjectController;
use App\Http\Controllers\PanduanPembayaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengawasMandorController;
use App\Http\Controllers\PengawasMandorInvoiceController;
use App\Http\Controllers\PengawasNotifikasiController;
use App\Http\Controllers\PengawasOperatorController;
use App\Http\Controllers\PengawasPembayaranController;
use App\Http\Controllers\PengawasProfilController;
use App\Http\Controllers\PengawasTagihanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|------------------------------------------------------------------------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('tes', function () {
//     echo $url = URL::temporarySignedRoute(
//         'login.url',
//         now()->addDays(10),
//         [
//             'pembayaran_id' => 1,
//             'user_id' => 1,
//             'url' => route('pembayaran.show', 1)
//         ]
//         );
// });

Route::get('login/login-url', [LoginController::class, 'loginUrl'])->name('login.url');
Route::post('/login', [LoginController::class, 'loginApi']);
Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function() {
    Route::get('beranda', [BerandaOperatorController::class, 'index'])->name('operator.beranda');
    Route::resource('bankperusahaan', BankPerusahaanController::class);
    Route::resource('user', UserController::class);
    Route::resource('pengawas', PengawasController::class);
    Route::resource('mandor', MandorController::class);
    Route::resource('pengawasmandor', PengawasMandorController::class);
    Route::resource('hutang', HutangController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('setting', SettingController::class);
    Route::get('delete-hutang-item/{id}', [HutangController::class, 'deleteItem'])->name('delete-hutang.item');
    Route::get('status/update', [StatusController::class, 'update'])->name('status.update');
    Route::get('laporanform/create', [LaporanFormController::class, 'create'])->name('laporanform.create');
    Route::get('laporantagihan', [LaporanTagihanController::class,'index'])->name('laporantagihan.index');
    Route::get('laporanpembayaran', [LaporanPembayaranController::class,'index'])->name('laporanpembayaran.index');
    Route::get('laporanrekappembayaran', [LaporanRekapPembayaran::class,'index'])->name('laporanrekappembayaran.index');
});

Route::get('login-pengawas', [LoginController::class, 'showLoginFormPengawas'])->name('login.pengawas');


Route::prefix('pengawas')->middleware(['auth', 'auth.pengawas'])->name('pengawas.')->group(function() {
    //Route Khusus Untuk Pengawas
    Route::get('beranda', [BerandaPengawasController::class, 'index'])->name('beranda');
    Route::resource('mandor', PengawasOperatorController::class);
    Route::resource('tagihan', PengawasTagihanController::class);
    Route::resource('pembayaran', PengawasPembayaranController::class);
    Route::resource('profil', PengawasProfilController::class);
    Route::resource('notifikasi', PengawasNotifikasiController::class);
    
});
Route::get('kwitansi-pembayaran/{id}', [KwitansiPembayaranController::class, 'show'])
->name('kwitansipembayaran.show')->middleware('auth');
Route::resource('invoice', InvoiceController::class)->middleware('auth');
Route::get('kartupembayaran', [KartuPembayaranController::class, 'index'])
->name('kartupembayaran.index')->middleware('auth');

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('Logout');




Route::get('/', function () {
    return view('landing_page');

    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('panduan-pembayaran/{id}', [PanduanPembayaranController::class, 'index'])->name('panduan.pembayaran');

