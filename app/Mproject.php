<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mproject extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'mproject';
    protected $primaryKey = 'kd_project';

    public $incrementing = false;
    public $timestamps = FALSE;
}
