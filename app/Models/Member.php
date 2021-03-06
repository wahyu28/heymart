<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class Member extends Model
{
    use HasFactory, Loggable;

    protected $table = 'member';
    protected $primaryKey = 'id_member';

    public function penjualan()
    {
        return $this->hasMany('App\Penjualan', 'id_supplier');
    }
}
