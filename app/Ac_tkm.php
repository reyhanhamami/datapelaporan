<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ac_tkm extends Model
{
    public $table = 'ac_tkm';
    protected $connection = 'sqlsrv';
    protected $primaryKey = NULL ;
    protected $fillable = ['kd_tkm','tgl','dr','deskripsi','kd_jurnal','tgl_tambah','tgl_edit','uid','uid_edit'];

    public $incrementing = false;
    public $timestamps = FALSE;
}
