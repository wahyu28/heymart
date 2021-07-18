<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class Produk extends Model
{
    use HasFactory;
    use Loggable; 

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
