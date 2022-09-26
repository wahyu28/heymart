<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory, Loggable;

    protected $table = 'pembelian_detail';
    protected $primaryKey = 'id_pembelian_detail';
}
