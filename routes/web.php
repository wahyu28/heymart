<?php

use App\Models\Supplier;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengeluaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'web', 'auth'], function() {
    Route::get('user/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::patch('user/{id}/change', [UserController::class, 'changeProfil'])->name('user.change_profil');
});

Route::middleware(['web', 'cekuser:1', 'auth'])->group(function () {
    Route::get('kategori/data', [KategoriController::class, 'listData'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    
    Route::get('produk/data', [ProdukController::class, 'listData'])->name('produk.data');
    Route::post('produk/hapus', [ProdukController::class, 'deleteSelected']);
    Route::post('produk/cetak', [ProdukController::class, 'printBarcode']);
    Route::resource('produk', ProdukController::class);

    Route::get('supplier/data', [SupplierController::class, 'listData'])->name('supplier.data');
    Route::resource('supplier', SupplierController::class)->except(['create', 'show']);

    Route::get('member/data', [MemberController::class, 'listData'])->name('member.data');
    Route::post('member/cetak', [MemberController::class, 'printCard']);
    Route::resource('member', MemberController::class);

    Route::get('pengeluaran/data', [PengeluaranController::class, 'listData'])->name('pengeluaran.data');
    Route::resource('pengeluaran', PengeluaranController::class);

    Route::get('pembelian/data', [PembelianController::class, 'listData'])->name('pengeluaran.data');
    Route::get('pembelian/{id}/tambah', [PembelianController::class, 'create']);
    Route::get('pembelian/{id}/lihat', [PembelianController::class, 'show']);
    Route::resource('pembelian', PembelianController::class);

    Route::get('user/data', [UserController::class, 'listData'])->name('user.data');
    Route::get('/notifikasi', [UserController::class, 'notifikasiHeader'])->name('notifikasi');
    Route::get('user/reset-password', [UserController::class, 'resetUserPassword'])->middleware('password.confirm')->name('user.reset');
    Route::resource('user', UserController::class);
});

Route::get('whatsapp', function() {
    $url = "https://wa.me/6281617264337?text=I'm%20interested%20in%20your%20car%20for%20sale";

    // session()->flash('url', $url);
    return Redirect::to("/supplier")->with('url', $url);
});

Route::get('/webcam', function() {
    return view('webcam');
});
