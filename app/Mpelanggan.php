<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpelanggan extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'mpelanggan';
    protected $primaryKey = 'kd_pelanggan';
    protected $fillable = ['id','kd_pelanggan','nm_lengkap','alamat','kota','pos','propinsi','telp','hp',
    'email','no_vac','aktif','nip_telemarketing','nip_sales_va','keterangan','status','tidak_dikirim','tgl_tambah',
    'tgl_edit','uid','uid_edit','kd_salesman','update_tele','KirimTelp','KirimWA','KirimEmail','temp'];

    public $timestamps = FALSE;
    public function tdonasi()
    {
        return $this->belongsTo('App\Tdonasi','kd_pelanggan','kd_pelanggan');
    }
}
