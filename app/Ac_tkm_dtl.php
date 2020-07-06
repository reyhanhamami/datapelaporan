<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ac_tkm_dtl extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'ac_tkm_dtl';
    protected $primaryKey = 'no_urut';
    protected $fillable = ['kd_tkm','kd_akun','no_urut','debet','kredit','kd_project','kd_program'];

    public $incrementing = false;
    public $timestamps = false;
}
