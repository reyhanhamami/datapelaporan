<?php

namespace App\Http\Controllers;

use App\order;
use App\customer;
use App\expedisi;
use App\barang_order;
use App\barang;
use App\ecommerce;
use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::get();
        $expedisi = Expedisi::get();
        $ecommerce = Ecommerce::get();
        $barang = Barang::get();
        return view('order.order', compact('customer','expedisi','ecommerce','barang'));
    }

    public function caritelepon(request $request)
    {
        $data = [];
           if ($request->has("q")) {
            $cari = $request->q;
            $data = DB::table("customer")->where("telepon_customer", "LIKE", "%$cari%")->get();
        }
        return response()->json($data);
    }

    public function caribarang(request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('barang')->where('nama_barang','like',"%$cari%")->get();
        }
        return response()->json($data);
    }

     public function getbarang()
    {
        $barang = [];
        $barang = Barang::where('barang.id_barang',$_GET['id'])->first();
       return $barang;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function fetch(Request $request)
    // {
    //     $select = $request->get('select');
    //     $value = $request->get('value');
    //     $dependent = $request->get('dependent');
    //     $data = DB::table('barang')->where($select, $value)->groupBy($dependent)->get();
        
    //     $output = '<input value="">'.ucFirst($dependent).'</input>';
    // }
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
        $barang = Barang::where('id_barang','=', $request->barang_order)->get();
        $barang->toArray();
        $data = $request->all();
        $data['id_order'] = date('dmY-His');
        $data['tanggal_order'] = date('D,d-M-Y');
        $barangorder = $request->barang_order;
        $beliberapa_order = $request->beliberapa_order;
        $note_order = $request->note_order;
        foreach ($barang as $bar) {
            $tes = $bar->harga_jual; 
            $beli = implode($beliberapa_order,",");
            $kurang = (int) $tes * (int) $beliberapa_order;
            $data['barang_order'] = implode($barangorder,",");
                    foreach($barangorder as $ba) {
                        $barang_order = new barang_order;
                        $barang_order->id_order = $data['id_order'];
                        $barang_order->id_barang = $ba;
                        $barang_order->subtotal = $kurang;
                        $barang_order->save();
                    }
        }
        $data['beliberapa_order'] = implode($beliberapa_order,",");
        $data['note_order'] = implode($note_order,",");
        // foreach($request->barang_order as $barang){
        //     foreach($request->beliberapa_order as $beli){
        //         foreach($request->note_order as $note) {
        //             foreach($barangs as $bar){
        //                 $subtotal = $bar->harga_jual * $beli ;
                        
        //                 $barang_order = new barang_order;
        //                 $barang_order->id_order = $data['id_order'];
        //                 $barang_order->id_barang = $barang;
        //                 $barang_order->subtotal = $subtotal;
        //                 $barang_order->save
        //             }           
        //         }
        //     } 
        // }
        // Order::create($data);
        // return redirect()->route('order')->with('success','List order berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
