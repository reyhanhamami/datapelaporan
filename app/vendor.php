<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    protected $table = 'vendor';
    protected $primaryKey = 'id_vendor';
    protected $fillable = ['nama_vendor','telepon_vendor','alamat_vendor','nama_barang','jumlah_barang','harga_jual','harga_beli','from'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($vendor){
            $vendor->{$vendor->getKeyName()} = (string) Str::uuid();
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
