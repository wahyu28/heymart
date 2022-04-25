<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Supplier extends Model
{
    use HasFactory, Loggable;
    
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    public function pembelian()
    {
        return $this->hasMany('App\Pembelian', 'id_supplier');
    }
}
