<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class z_trf extends Model
{
    protected $connection = 'sqlsrv_user_lagi';
    protected $table = 'z_trf';
    protected $fillable = ['TglTRF','NetAmt','RecAmt' ,'ReconMGM' ,'ReconCMS '  ,'rekening_penerima'
    ,'norek_penerima'
    ,'rekening_sumber'
    ,'norek_sumber'];

    public function z_trfd()
    {
        return $this->hasMany('App\z_trfd','TglTRF','TglTRF');
    }
    public function stock_movement()
    {
        return $this->hasManyThrough(
            'App\stock_movement',
            'App\z_trfd',
            'TglTRF', //foreign key z_trfd yang terhubung sama local id z_trf 
            'reference', // foreign key stock movement yang terhubung sama local id z_trfd
            'TglTRF', //local key z_trf yang terhubung sama foreign key z_trfd
            'RefID' //local key z_trfd yang terhubung dengan stock movement
        );
    }
}
