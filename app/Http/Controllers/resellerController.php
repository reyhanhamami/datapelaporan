<?php

namespace App\Http\Controllers;

use App\reseller;
use Illuminate\Http\Request;

class resellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reseller.reseller');
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
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function edit(reseller $reseller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reseller $reseller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(reseller $reseller)
    {
        //
    }
}
