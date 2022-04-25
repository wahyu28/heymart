<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Kategori extends Model
{
    use HasFactory, Loggable;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public function produk()
    {
        return $this->hasMany('App\Produk', 'id_kategori');
    }
}
