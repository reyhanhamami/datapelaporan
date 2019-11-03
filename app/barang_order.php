<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class barang_order extends Model
{
    protected $table = 'barang_order';
    protected $fillable = ['id_reseller','id_order','id_barang','subtotal','stock_berkurang','note_order'];
    protected $primaryKey = 'id_barang_order';

}
