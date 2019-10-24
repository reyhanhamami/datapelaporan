<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang_order extends Model
{
    protected $table = 'barang_order';
    protected $fillable = ['id_order','id_barang','subtotal'];
    protected $primaryKey = 'id_barang_order';
}
