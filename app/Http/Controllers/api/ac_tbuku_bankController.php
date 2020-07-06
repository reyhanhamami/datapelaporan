<?php

namespace App\Http\Controllers\api;

use App\Ac_tbuku_bank;
use App\Mkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
class ac_tbuku_bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $join = DB::connection('sqlsrv')->table('ac_tbuku_bank')
        ->join('mkas','ac_tbuku_bank.kd_kas','mkas.kd_kas')
        ->join('rf_bank','ac_tbuku_bank.bank_id','rf_bank.id')
        ->select(['mkas.nm_kas','rf_bank.bank','ac_tbuku_bank.*']);
        // return DataTables::queryBuilder($join)->toJson();
        // return response()->json($join);
        return Datatables::of($join)->make(true);
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
     * @param  \App\Ac_tbuku_bank  $ac_tbuku_bank
     * @return \Illuminate\Http\Response
     */
    public function show(Ac_tbuku_bank $ac_tbuku_bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ac_tbuku_bank  $ac_tbuku_bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Ac_tbuku_bank $ac_tbuku_bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ac_tbuku_bank  $ac_tbuku_bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ac_tbuku_bank $ac_tbuku_bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ac_tbuku_bank  $ac_tbuku_bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ac_tbuku_bank $ac_tbuku_bank)
    {
        //
    }
}
