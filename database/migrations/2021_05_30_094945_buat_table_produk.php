<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuatTableProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('kode_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk', 100);
            $table->string('merk', 50);
            $table->unsignedBigInteger('harga_beli');
            $table->unsignedBigInteger('diskon');
            $table->unsignedBigInteger('harga_jual');
            $table->unsignedBigInteger('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
