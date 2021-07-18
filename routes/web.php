<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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

    Route::get('user/data', [UserController::class, 'listData'])->name('user.data');
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => 'web', 'auth'], function() {
    Route::get('user/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::patch('user/{id}/change', [UserController::class, 'changeProfil']);
});

// Route::get('tanggal', function() {
//     echo tanggal_indonesia(date('Y-m-d'));
// });

// Route::get('uang', function() {
//     echo "Rp. ". format_uang(12500000);
// });

// Route::get('terbilang', function() {
//     echo ucwords(terbilang(512342200));
// });
