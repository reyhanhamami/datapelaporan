<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class customer extends Model
{
    protected $table = 'customer';
    protected $fillable = ['nama_customer','kode_customer','telepon_customer','alamat_customer','provinsi_customer','kelurahan_customer','kecamatan_customer','kota_customer','kodepos_customer'];
    protected $primaryKey = 'id_customer';

    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    protected static function boot(){
        parent::boot();

        static::creating(function($customer) {
            $customer->{$customer->getKeyName()} = (string) Str::uuid();
        });
    }

}


