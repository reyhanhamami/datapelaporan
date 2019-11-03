<?php

namespace App\Exports;

use App\customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class CustomerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // DB::table('customer')->select("kode_customer","nama_customer","telepon_customer","alamat_customer","kelurahan_customer","kecamatan_customer","kota_customer","provinsi_customer","kodepos_customer")->get()
        return Customer::all();
    }
    
}
