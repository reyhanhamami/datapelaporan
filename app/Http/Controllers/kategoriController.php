<?php

namespace App\Http\Controllers;

use App\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.kategori.addkategori');
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
            'nama_kategori' => 'required|unique:kategori'
        ]);

        Kategori::create($request->all());
        return redirect()->route('barang')->with('successkategori','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(kategori $kategori)
    {
        return view('barang.kategori.editkategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kategori $kategori)
    {
        $data = $request->except(['_method','_token']);
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori::where('id_kategori',$kategori->id_kategori)->update($data);
        return redirect()->route('barang')->with('updatekategori','kategori '.$kategori->nama_kategori.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(kategori $kategori)
    {
        Kategori::destroy('id_kategori', $kategori->id_kategori);

        return redirect()->back()->with('deletekategori', 'kategori '.$kategori->nama_kategori.' berhasil dihapus');
    }
}
