<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\barang;
use App\customer;
use App\Expedisi;
use App\User;
use App\barang_order;
use PDF;
use Illuminate\Support\Facades\DB;
class statusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::get();
        return view('status_order.status', compact('order'));
    }
    
    // untuk proses tampilin detail dan form upload foto
    public function proses(order $order)
    {
       
        $expedisi = Expedisi::get();
        $pengirim = User::get();
        $barang = Barang::get();
        $joinbarang = DB::table('barang_order')->join('barang','barang.id_barang','=','barang_order.id_barang')->get();
        $barangorder = Barang_order::get();
        return view('status_order.proses', compact('order','expedisi','pengirim','barangorder','barang','joinbarang'));
    }

    // untuk menampilkan form input resi 
    public function editinputresi(order $order)
    {
        return view('status_order.inputresi', compact('order'));
    }

    // proses update input resi 
    public function prosesinputresi(Request $request, order $order)
    {
        $request->validate([
            'resiotomatis_order' => 'required'
        ]);

        Order::where('id_order',$order->id_order)
                ->update([
                    'resiotomatis_order' => $request->resiotomatis_order
                ]);
        return redirect('/status_order/proses/'.$order->id_order);
    }

    // menampilkan order untuk print 
    public function cetakorder(order $order)
    {
        $expedisi = Expedisi::get();
        $pengirim = User::get();
        $joinbarang = DB::table('barang_order')->join('barang','barang.id_barang','=','barang_order.id_barang')->get();

        // preview pdf and print  
        $pdf = PDF::loadView('status_order.cetakorder', compact('order','expedisi','pengirim','joinbarang'));
        return $pdf->stream("filename.pdf", array("Attachment" => false));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
