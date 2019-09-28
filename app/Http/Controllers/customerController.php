<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('nama_customer','ASC')->paginate(10);
        return view('customer.customer', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cus = 'CUS-';
        $getmax = Customer::max('kode_customer');
        $no = (int) substr($getmax,4,10);
        $no++;
        // fungsi agar default 00000 tetap ikut
        $sprint = sprintf("%010s",$no);
        $kode = $cus.$sprint;   
        return view('customer.addcustomer',compact('kode'));
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
            'kode_customer' => 'required',
            'nama_customer' => 'required',
            'telepon_customer' => 'required|unique:customer',
            'alamat_customer' => 'required',
            'kelurahan_customer' => 'required',
            'kecamatan_customer' => 'required',
            'kota_customer' => 'required',
            'kodepos_customer' => 'numeric'
        ]);

        Customer::create($request->all());
        return redirect()->route('customer')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        return view('customer.editcustomer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        $request->validate([
            'nama_customer' => 'required',
            'telepon_customer' => 'required',
            'alamat_customer' => 'required',
            'kelurahan_customer' => 'required',
            'kecamatan_customer' => 'required',
            'kota_customer' => 'required',
            'kodepos_customer' => 'numeric'
        ]);

        Customer::where('id_customer',$customer->id_customer)
                    ->update([
                        'nama_customer' => $request->nama_customer,
                        'telepon_customer' => $request->telepon_customer,
                        'alamat_customer' => $request->alamat_customer,
                        'kelurahan_customer' => $request->kelurahan_customer,
                        'kecamatan_customer' => $request->kecamatan_customer,
                        'kota_customer' => $request->kota_customer,
                        'kodepos_customer' => $request->kodepos_customer
                    ]);
        return redirect()->route('customer')->with('update','customer ' .$customer->nama_customer. ' berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        $kode = 'CUS-001';
        Customer::where('kode_customer', '!=', $kode)->delete('id_customer',$customer->id_customer);
                

        return redirect()->back()->with('delete','Customer '.$customer->nama_customer.' berhasil dihapus');
    }
}
