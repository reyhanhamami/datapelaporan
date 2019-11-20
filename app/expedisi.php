<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class expedisi extends Model
{
    protected $table = 'expedisi';
    protected $fillable = ['kode_expedisi','nama_expedisi'];
    protected $primaryKey = 'id_expedisi';

    // one to many order 
    public function order()
    {
        return $this->hasMany('App\order','id_expedisi');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($expedisi) {
            $expedisi->{$expedisi->getKeyName()} = (string) Str::uuid();
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
