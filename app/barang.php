<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['nama_barang','foto_barang','stock_barang','kategori_barang','harga_jual'];
    // relasi many to one ke kategori
    public function kategori()
    {
        return $this->belongsTo('App\kategori');
    }
    // relasi many to many ke order 
    public function order()
    {
         return $this->belongsToMany(Order::class, 'barang_order','id_barang','id_order');
    }
    protected static function boot()
    {
        parent::boot();

        Static::creating(function($barang){
            $barang->{$barang->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    
}
