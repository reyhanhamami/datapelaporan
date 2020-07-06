<?php

namespace App\Imports;

use App\z_trf;
use App\z_trfd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;

class transaksi_import implements FromCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection()
    {   
        return z_trf::all();
        // z_trf::insert([
        //     'TglTRF' => strtotime($row['trx']),
        //     'NetAmt' => $row['amount'],
        //     'RecAmt' => $row['total_settlement'],
        //     'ReconMGM' => 'Y',
        //     'ReconCMS'  => 'Y',
        //     'rekening_penerima' => $row['merchant'],
        //     'rekening_sumber' => $row['bank_na'],
        //     'paytype' => 'FIN',
        // ]);
        // return new z_trfd([
        //     'TglTRF' => date("Y-m-d", strtotime($row['trx'])),
        //     'TglTRX' => strtotime($row['trx']),
        //     'TglSettlement' => strtotime($row['settlement_date']),
        //     'Amt' => $row['total_settlement'],
        //     'ReconCMS' => 'Y',
        //     'paytype' =>  'FIN',
        // ]);
    }
}
