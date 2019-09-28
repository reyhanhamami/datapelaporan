<?php

namespace App\Http\Controllers;

use App\ecommerce;
use Illuminate\Http\Request;

class ecommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecommerce = Ecommerce::orderBy('nama_ecommerce','asc')->get();
        return view('ecommerce.ecommerce', compact('ecommerce'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eco = "ECO-";
        $no = Ecommerce::max('kode_ecommerce');
        // fungi mengambil 2 huruf dari 4 huruf dibelakang
        $substr = (int) substr($no,4,2);
        $substr++;
        // membuat 0 
        $sprint = sprintf("%02s",$substr);
        $kode = $eco.$sprint;
        return view('ecommerce.addecommerce',compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ecommerce' => 'required|unique:ecommerce'
        ]);
        Ecommerce::create($request->all());
        return redirect()->route('ecommerce')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ecommerce  $ecommerce
     * @return \Illuminate\Http\Response
     */
    public function show(ecommerce $ecommerce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ecommerce  $ecommerce
     * @return \Illuminate\Http\Response
     */
    public function edit(ecommerce $ecommerce)
    {
        return view('ecommerce.getedit', compact('ecommerce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ecommerce  $ecommerce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ecommerce $ecommerce)
    {
        $request->validate([
            'nama_ecommerce' => 'required|unique:ecommerce',
        ]);

        Ecommerce::where('id_ecommerce',$ecommerce->id_ecommerce)
            ->update([
                'nama_ecommerce' => $request->nama_ecommerce
                ]);

        return redirect()->route('ecommerce')->with('update','Ecommerce '.$ecommerce->nama_ecommerce .' Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ecommerce  $ecommerce
     * @return \Illuminate\Http\Response
     */
    public function destroy(ecommerce $ecommerce)
    {
        $tes = Ecommerce::destroy('id_ecommerce', $ecommerce->id_ecommerce);
        return redirect()->back()->with('delete','Ecommerce '.$ecommerce->nama_ecommerce.' telah dihapus dari daftar');
    }
}
