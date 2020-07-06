<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mkas extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'mkas';
    protected $primaryKey = 'kd_kas';

    public $timestamps = FALSE;
}
