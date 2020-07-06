<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock_movement extends Model
{
    protected $connection = 'sqlsrv_user_lagi';
    protected $table = 'inventory_stock_movement';
}
