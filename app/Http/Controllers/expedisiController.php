<?php

namespace App\Http\Controllers;

use App\expedisi;
use Illuminate\Http\Request;

class expedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expedisi = Expedisi::orderBy('nama_expedisi','ASC')->get();
        return view('expedisi.expedisi', compact('expedisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exp = 'EX-';
        $no = Expedisi::max('kode_expedisi');
        $getno = (int) substr($no,4,3);
        $getno++;
        $sprint = sprintf("%03s",$getno);

        $kode = $exp.$sprint;

        return view('expedisi.addexpedisi',compact('kode'));
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
            'nama_expedisi' => 'required|unique:expedisi'
        ]);

        Expedisi::create($request->all());

        return redirect()->route('expedisi')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expedisi  $expedisi
     * @return \Illuminate\Http\Response
     */
    public function show(expedisi $expedisi)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expedisi  $expedisi
     * @return \Illuminate\Http\Response
     */
    public function edit(expedisi $expedisi)
    {
        
        return view('expedisi.editexpedisi', compact('expedisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expedisi  $expedisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expedisi $expedisi)
    {
        $request->validate([
            'nama_expedisi' => 'required|unique:expedisi'
        ]);

        Expedisi::where('id_expedisi',$expedisi->id_expedisi)
                ->update([
                    'nama_expedisi' => $request->nama_expedisi
                ]);
        return redirect()->route('expedisi')->with('update','Expedisi '.$expedisi->nama_expedisi.' berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expedisi  $expedisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(expedisi $expedisi)
    {
        Expedisi::destroy('id_expedisi', $expedisi->id_expedisi);

        return redirect()->back()->with('delete','Expedisi '.$expedisi->nama_expedisi.' berhasil dihapus');
    }
}
