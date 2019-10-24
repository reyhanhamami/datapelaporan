<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    // relasi one to many ke barang
    public function barang()
    {
        return $this->hasMany('App\barang', 'kategori_barang');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($kategori){
            $kategori->{$kategori->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }
}
