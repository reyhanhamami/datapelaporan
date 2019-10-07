<?php

namespace App\Http\Controllers;

use App\barang;
use App\kategori;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(barang $barang)
    {
        $join = DB::table('barang')->join('kategori','kategori_barang','=','id_kategori')->select('kategori.*','barang.*')->paginate(20);
        // dd($join);
        // seleksi kategori id 
        $kategori = Kategori::get();
        $stuff = Barang::get();
        // dd($join);
        return view('barang.barang',compact('kategori','barang','stuff','join'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('barang.addbarang',compact('kategori'));
    }

    public function cari(request $request)
    {
        $cari = $request->cari;
        // sql cari 
        $join = DB::table('barang')->where('nama_barang','like','%'.$cari.'%')->join('kategori','kategori_barang','=','id_kategori')->select('kategori.*','barang.*')->paginate(20);

        return view('barang.barang',compact('join'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'nama_barang' => 'required|unique:barang',
            'kategori_barang' => 'required',
            'foto_barang' => 'image|mimes:jpg,png,jpeg',
            'harga_jual' => 'required',
            'stock_barang' => 'required'
        ]);
        
        if($request->foto_barang){
            // ambil request foto dan taruh di variable
            $foto = $request->file('foto_barang');
    
            // ambil extensionnya saja 
            $ext = $foto->getClientOriginalExtension();
            // kasih nama
            $input['imagename'] = date('Y-m-d,His').".$ext";
            // lokasi rumah 
            $lokasi = public_path('images/barang');
    
            if(!file_exists($lokasi))
            {
                mkdir($lokasi);
            }
            // pindahin ke folder yang dibuat sebelumnya
            $foto->move($lokasi,$input['imagename']);
    
            // ambil nama foto untuk disimpan di database
            $data['foto_barang'] = $input['imagename'];

        }

        // simpan ke database
        Barang::create($data);
        return redirect()->route('barang')->with('success','stock barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        $kategori = Kategori::get();
        return view('barang.editbarang',compact('kategori','barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        $data = $request->except(['_method','_token']);
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'foto_barang' => 'image|mimes:jpg,png,jpeg',
            'harga_jual' => 'required',
            'stock_barang' => 'required'
        ]);
        // ganti foto jika ada request baru
        if ($request->hasFile('foto_barang')) {
            // lokasi foto 
            $path = public_path('images/barang/'.$barang->foto_barang);
            # delete foto lama
            if (File::exists($path)) {
                File::delete($path);
            };
            // lokasi foto
            $lokasi = public_path('images/barang');
            // ambil requestan foto pathnya 
            $foto = $request->file('foto_barang');
            // ambil extensionnya 
            $ext = $foto->getClientOriginalExtension();
            // ganti nama
            $input['imagename'] = date('Y-m-d,His').".$ext";
            // pindahin foto ke folder yang sudah ditentukan
            $foto->move($lokasi, $input['imagename']);
            // ambil nama file image dan pindahankan ke dalem request
            $data['foto_barang'] = $input['imagename'];
        }
        Barang::where('id_barang', $barang->id_barang)->update($data);
        return redirect()->route('barang')->with('update','barang '.$barang->nama_barang.' berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        $lokasi = public_path('images/barang/'.$barang->foto_barang);
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        };
        Barang::destroy('id_barang',$barang->id_barang);
        return redirect()->back()->with('delete','Barang '.$barang->nama_barang.' berhasil dihapus');
    }
}
