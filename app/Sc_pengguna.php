<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableContract;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Sc_pengguna extends Authenticatable
{
    use Notifiable;
    protected $table = 'sc_pengguna';
    protected $connection = 'sqlsrv';
    protected $primaryKey = 'nm_login';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = ['nm_login','nip','kd_group','kd_link','aktif',
    'pwd','tgl_tambah','uid','uid_edit','tgl_edit'];

    protected $hidden = [
        'pwd', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return bcrypt($this->pwd);
    }

}
