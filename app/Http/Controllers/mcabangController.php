<?php

namespace App\Http\Controllers;

use App\mcabang;
use Illuminate\Http\Request;

class mcabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = mcabang::get();
        dd($cabang);
        return view('keuangan.keuangan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\mcabang  $mcabang
     * @return \Illuminate\Http\Response
     */
    public function show(mcabang $mcabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mcabang  $mcabang
     * @return \Illuminate\Http\Response
     */
    public function edit(mcabang $mcabang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mcabang  $mcabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mcabang $mcabang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mcabang  $mcabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(mcabang $mcabang)
    {
        //
    }
}
