<?php

namespace App\Http\Controllers;

use App\vendor;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::paginate(20);
        return view('vendor.vendor', compact("vendor"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.addvendor');
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
            'nama_vendor' => 'required',
            'telepon_vendor' => 'required|numeric',
            'alamat_vendor' => 'required',
            "nama_barang" => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_jual' => 'required',
            'harga_beli' => 'required'
        ]); 
        $data['from'] = 'vendor';
        Vendor::create($data);
        return redirect()->route('vendor')->with('success','Data berhasil ditambahkan');
    }
    public function cari(request $request)
    {
        $cari = $request->cari;
        $vendor = Vendor::where('nama_vendor','like','%'.$cari.'%')->paginate(20);

        return view('vendor.vendor', compact('vendor'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(vendor $vendor)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(vendor $vendor)
    {
        return view('vendor.editvendor', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vendor $vendor)
    {
        $data = $request->except(['_token','_method']);
        $request->validate([
            'nama_vendor' => 'required',
            'telepon_vendor' => 'required|numeric',
            'alamat_vendor' => 'required',
            "nama_barang" => 'required',
            'jumlah_barang' => 'required|numeric',
            'harga_jual' => 'required',
            'harga_beli' => 'required'
        ]); 

        if($request->filled('from')){
            // jika ada request dari from maka
            $data['from'] = 'vendor';
        }
        else 
        {
            // jika data tidak diinput maka abaikan 
            $data = array_except($data, ['from']);
        }

        Vendor::where('id_vendor',$vendor->id_vendor)
            ->update($data);
        return redirect()->route('vendor')->with('update','vendor '.$vendor->nama_vendor. ' berhasil dirubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(vendor $vendor)
    {
        Vendor::destroy('id_vendor', $vendor->id_vendor);
        return redirect()->back()->with('delete','Vendor '.$vendor->nama_vendor. ' berhasil dihapus');
    }
}
