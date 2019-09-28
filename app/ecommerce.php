<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ecommerce extends Model
{
    protected $table = 'ecommerce';
    protected $primaryKey = 'id_ecommerce';
    protected $fillable = ['kode_ecommerce','nama_ecommerce'];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($ecommerce) {
            $ecommerce->{$ecommerce->getKeyName()} = (string) Str::uuid();
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
