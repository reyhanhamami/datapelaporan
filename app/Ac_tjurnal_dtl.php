<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ac_tjurnal_dtl extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'ac_tjurnal_dtl';
    protected $fillable = ['kd_jurnal','kd_akun','no_urut','debet','kredit','kd_project','kd_program',
    'kd_dept','memo','kd_program_sumber_dana','kd_project_sumber_dana','sumber','id_dtl','kd'];
    protected $primaryKey = 'kd';

    public $timestamps = false;

    public $errors;
}
