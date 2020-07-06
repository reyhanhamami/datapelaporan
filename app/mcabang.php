<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mcabang extends Model
{
    public $table = "mcabang";
    protected $connection = 'sqlsrv';
    protected $primaryKey = 'ID';

    public $timestamps = false;
}
