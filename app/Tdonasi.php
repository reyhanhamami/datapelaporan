<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdonasi extends Model
{
    protected $connection = 'sqlsrv';
    public $table = 'tdonasi';
    protected $primaryKey = 'kd_pelanggan';
    protected $fillable = ['id','no_kwitansi','nm_wakif','kd_kas','kd_pelanggan','kd_agen','tgl',
    'total','sah','kd_tkm','uid','tgl_tambah','uid_edit','tgl_edit','ket','tgl_transaksi','kd_sales',
    'posting','sumber','fkd_akun','fjenis_aktivitas','fsub_jenis_aktivitas','fnm_pendaftar','kd_cabang','alur_kerja',
    'biaya_bank','konfirmasi','tgl_konfirmasi','catatan_konfirmasi','update_project'];

    public $timestamps = FALSE;

    public function tdonasi_dtl()
    {
        return $this->hasMany('App\Tdonasi_dtl','no_kwitansi','no_kwitansi');
    }

    public function mpelanggan()
    {
        return $this->belongsTo('App\Mpelanggan','kd_pelanggan','kd_pelanggan');
    }
}
