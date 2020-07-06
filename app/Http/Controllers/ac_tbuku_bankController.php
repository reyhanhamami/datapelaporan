<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ac_tbuku_bankController extends Controller
{
    public function index(){
        return view('verifikasi.verifikasitransfer');
    }
}
