<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Tdonasi;
use App\Tdonasi_dtl;
use App\Mkas;
use App\Mcabang;
use App\Mproject;
use App\Mprogram;

class keuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tdonasi = DB::connection('sqlsrv')->table('tdonasi')
        ->join('mkas','tdonasi.kd_kas','=','mkas.kd_kas')
        ->join('mcabang','tdonasi.kd_cabang','=','mcabang.ID')
        ->select('tdonasi.*','mkas.nm_kas','mcabang.Nm')->orderBy('tdonasi.id','desc')->paginate(15);
        return view('keuangan.keuangan', compact('tdonasi'));
    }

    // menampilkan form untuk input dan foto bukti 
    public function getbukti(tdonasi $tdonasi)
    {
        $detail = DB::connection('sqlsrv')->table('tdonasi')
        ->join('tdonasi_dtl', 'tdonasi.no_kwitansi','tdonasi_dtl.no_kwitansi')
        ->join('mprogram', 'tdonasi_dtl.kd_program','mprogram.kd_program')
        ->join('mproject', 'tdonasi_dtl.kd_project','mproject.kd_project')
        ->where('tdonasi_dtl.no_kwitansi','=', $tdonasi->no_kwitansi)->get();
        return view('keuangan.kirimbukti', compact('tdonasi','detail'));
    }

    // update form untuk input dan foto bukti 
    public function inputbukti(Request $request )
    {
        return redirect()->route('keuangan');

    }

    // notif pembayaran
    public function notifpembayaran()
    {
        return view('keuangan.notifpembayaran');
    }

    // validasi pembayaran
    public function validasipembayaran()
    {
        return view('keuangan.validasipembayaran');
    }
    public function prosesvalidasi(Request $request)
    {   
        return redirect()->route('notifpembayaran');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(keuangan $keuangan)
    {
        //
    }
}
