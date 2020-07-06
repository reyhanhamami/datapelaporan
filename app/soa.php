<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class soa extends Model
{
    protected $connection = 'mysql';
    protected $table = 'soa';
    protected $primaryKey = 'id';

    public function wakif()
    {
        return $this->belongsTo('App\wakif','CustomerNo');
    }
}
