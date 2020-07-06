<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reseller extends Model
{
    protected $connection = 'mysql';
    protected $table = "users";
    protected $fillable = ['name','email','telepon','password','foto','nama_akun','level'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
