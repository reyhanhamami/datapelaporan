<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ac_tjurnal extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'ac_tjurnal';
    protected $fillable = ['kd_jurnal','tgl','deskripsi','st_posting','tgl_tambah','tgl_edit','uid','uid_edit',
    'tipe_jurnal','sumber'];
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
