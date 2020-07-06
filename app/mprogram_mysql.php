<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mprogram_mysql extends Model
{
    protected $connection = 'mysql';
    protected $table = 'mprogram';
    protected $primarykey = 'kd_program';
}
