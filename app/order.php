<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    // one to many
    public function customer()
    {
        return $this->belongsTo('App\customer','customer_order');
    }
    // one to many expedisi 
    public function expedisi()
    {
        return $this->belongsTo('App\expedisi','expedisi_order');
    }
    // many to many barang
    public function barang()
    {
        return $this->belongsToMany('App\barang','barang_order','id_order','id_barang');
    }
  
    protected $table = 'order';
    protected $fillable = ['id_order','tanggal_order','reseller_order','pengirim_order','telepon_order','ecommerce_order',
    'barang_order','note_order','beliberapa_order','expedisi_order','ongkir_order','total_order','customer_order',
    'resiotomatis_order','drop_order'];
    protected $primaryKey = 'id_order';
    
}
