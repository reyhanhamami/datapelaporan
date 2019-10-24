<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';
    protected $fillable = ['id_order','tanggal_order','reseller_order','pengirim_order','telepon_order','ecommerce_order',
    'barang_order','note_order','beliberapa_order','expedisi_order','ongkir_order','total_order','customer_order',
    'resiotomatis_order','drop_order'];
    protected $primaryKey = 'id_order';
}
