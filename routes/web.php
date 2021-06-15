<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'cekuser:1'])->group(function () {
    Route::get('kategori/data', [KategoriController::class, 'listData'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    
    Route::get('produk/data', [ProdukController::class, 'listData'])->name('produk.data');
    Route::post('produk/hapus', [ProdukController::class, 'deleteSelected']);
    Route::post('produk/cetak', [ProdukController::class, 'printBarcode']);
    Route::resource('produk', ProdukController::class);

    Route::get('supplier/data', [SupplierController::class, 'listData'])->name('supplier.data');
    Route::resource('supplier', SupplierController::class);
});

Route::get('tanggal', function() {
    echo tanggal_indonesia(date('Y-m-d'));
});

Route::get('uang', function() {
    echo "Rp. ". format_uang(12500000);
});

Route::get('terbilang', function() {
    echo ucwords(terbilang(512342200));
});
