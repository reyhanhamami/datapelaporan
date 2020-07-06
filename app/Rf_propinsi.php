<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rf_propinsi extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'rf_propinsi';
    protected $primaryKey = 'kd_propinsi';

    public $timestamps = FALSE;
}
