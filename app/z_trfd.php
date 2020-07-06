<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class z_trfd extends Model
{
    protected $connection = 'sqlsrv_user_lagi';
    protected $table = 'z_trfd';
    protected $primaryKey = 'kode';
    protected $fillable = ['to_mgm','TglTRF','TglTRX','TglSettlement','Amt','ReconCMS','paytype'];

    public $timestamps = false;

    public function z_trf() {
        return $this->hasOne('App\z_trf','TglTRF','TglTRF');
    }
}
