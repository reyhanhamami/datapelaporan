<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mprogram extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'mprogram';
    protected $primaryKey = 'kd_program';

    public $incrementing = false;
    public $timestamps = FALSE;
}
