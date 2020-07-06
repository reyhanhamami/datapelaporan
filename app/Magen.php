<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magen extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'magen';
    protected $primaryKey = 'kd_agen';

    public $timestamps = FALSE;
}
