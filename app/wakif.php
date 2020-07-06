<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wakif extends Model
{
    protected $connection = 'mysql';
    protected $table = 'customer';
    protected $fillable = [
        'CustomerNo',
        'customername',
        'address',
        'city',
        'postalcode',
        'ProvinceID',
        'Hp2',
        'MobilePhone',
        'customeremail',
        'Is_Active',
        'TelemarketingID',
        'nip_sales_va',
        'Description',
        'StatusID',
        'IsNotSend',
        'datecreated',
        'datemodified',
        'createdby'
    ];
    // protected $primaryKey = 'customerid';

    public $timestamps = false;
    public function soa()
    {
        return $this->hasMany('App\soa', 'kd_pelanggan', 'CustomerNo');
    }

    public function soa_program()
    {
        return $this->hasManyThrough(
            'App\mprogram_mysql',
            'App\soa',
            'kd_pelanggan', //foreign key soa yang terhubung sama local id wakif 
            'kd_program', // foreign key mprogram yang terhubung sama local id soa
            'CustomerNo', //local key wakif yang terhubung sama foreign key soa 
            'kd_program' //local key soa yang terhubung dengan mprogram 
        );
    }

    public function soa_project()
    {
        return $this->hasManyThrough(
            'App\mproject_mysql',
            'App\soa',
            'kd_pelanggan',    // forign key soa yang terhubung sama local id wakif
            'kd_project',    // forign key mproject yang terhubung sama local id soa
            'CustomerNo',    // local key wakif yang terhubung sama local id soa
            'kd_project'    // local key soa yang terhubung sama local id mproject
        );
    }
}
