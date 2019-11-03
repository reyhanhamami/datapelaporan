<?php

namespace App\Http\Controllers;

use App\order;
use App\customer;
use App\expedisi;
use App\barang_order;
use App\barang;
use Auth;
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
        foreach ($request->barang_order as $index => $barang) {
            $barang_order = new barang_order;
            $barang_order->id_reseller = Auth::user()->id;
            $barang_order->id_order = $data['id_order'];
            $barang_order->id_barang = $request->barang_order[$index];
            $barang_order->subtotal = $request->subtotal[$index];
            $barang_order->stock_berkurang = $request->beliberapa_order[$index];
            $barang_order->note_order = $request->note_order[$index];
            $barang_order->save();
        }
        
        $order = new order;
        $order->id_order = $data['id_order'];
        $order->tanggal_order = $data['tanggal_order'];
        $order->reseller_order = Auth::user()->id; 
        $order->pengirim_order = $request->pengirim_order;
        $order->telepon_order = $request->telepon_order;
        $order->ecommerce_order = $request->ecommerce_order;
        $order->expedisi_order = $request->expedisi_order;
        $order->ongkir_order = $request->ongkir_order;
        $order->total_order = $request->total;
        $order->customer_order = $request->customer_order;
        $order->resiotomatis_order = $request->resiotomatis_order;
        $order->save();

        return redirect()->route('status_order')->with('success','Pesanan customer berhasil dibuat');
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
