<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use App\Tdonasi;
use App\wakif;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // // get customer count
        // $wakif = DB::connection('mysql')->table('customer')->count();

        // // get total count berdasarkan tahun skrng 
        // $tahun = date('Y');
        // $tdonasi = DB::connection('sqlsrv')->table('tdonasi')
        // ->whereBetween('tgl_transaksi', array($tahun.'-01-01', date('Y-m-d')))->pluck('total');
        // $jmh = 0;
        // foreach ($tdonasi as $donasi) {
        //     $jmh += $donasi;
        // }
           
        return view('home');
    }
}
