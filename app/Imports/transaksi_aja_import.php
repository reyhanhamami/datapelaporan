<?php

namespace App\Imports;

use App\z_trf;
use App\z_trfd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;

class transaksi_aja_import implements FromCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection()
    {
        return z_trf::all();
    }
    public function headingRow(): int 
    {
        return 6;
    }
}
