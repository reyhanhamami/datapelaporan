<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class z_bank_sumber extends Model
{
    protected $connection = 'sqlsrv_user_lagi';
    protected $table = 'z_bank_sumber';
    protected $fillable = ['nama','norek'];
}
