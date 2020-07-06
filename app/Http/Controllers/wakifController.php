<?php

namespace App\Http\Controllers;

use App\wakif;
use Cache;
use App\soa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use PDF;
use Illuminate\Support\Facades\Storage;

class wakifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('wakif.wakif');

    }
    public function jsonwakif(Request $request)
    {
        if ($request->ajax()) {
            $wakif = wakif::select(['CustomerNo','customername','address','phone','MobilePhone','customeremail','city']);
            
            return Datatables::of($wakif)
            ->addColumn('button',function(wakif $wakif){
                $button = '<a href="../donasi/wakif/history/'.$wakif->CustomerNo.'" class="btn btn-info text-dark my-1"><i class="fas fa-history"></i> History </a>';
                return $button;
            })
            ->rawColumns(['button'])
            ->make(true);
        }
    }

    public function historywakif(Request $request, $customerno)
    {
        // $nama = wakif::whereCustomerno($customerno)->pluck('customername')->first();
        // $tahunawal = soa::whereKd_pelanggan($customerno)->orderBy('tgl','asc')->pluck('tgl')->first();
        // $data = DB::connection('mysql')->table('customer')->where('customerno',$customerno)
        // ->join('soa','customer.customerno','soa.kd_pelanggan')
        // ->select(['customer.customerno','customer.customername','customer.address','customer.phone','customer.MobilePhone','customer.customeremail','customer.city','soa.*'])
        // ->get();
        $data = wakif::with('soa')->where('CustomerNo',$customerno)->get();
        // dd($data);
        return view('wakif.history', compact('data'));
    }

    public function urlpdf(Request $request, $customerno, $tgl)
    {
        // $data = wakif::with([
        //     'soa' => function($q) {
        //         $q->join('mprogram', 'mprogram.kd_program','soa.kd_program')
        //         ->join('mproject', 'mproject.kd_project','soa.kd_project')->select('soa.*','mproject.nm_project','mprogram.nm_program');

        //     }
        //     ])->where('CustomerNo',$customerno)
        //     ->orWhere('Parent_CustomerNo', $customerno)
        // ->get();
        $cusno = wakif::where('customerno',$customerno)->pluck('CustomerNo')->first();
        $cusname = wakif::where('customerno',$customerno)->pluck('CustomerName')->first();
        $address = wakif::where('customerno',$customerno)->pluck('address')->first();
        $getPdo = DB::connection('mysql')->getPdo();
        $sql = '
            SELECT  t0.Parent_CustomerName
       , t1.tgl
       , t1.kd_program
       , t1.kd_project
       , t3.nm_project
       , t1.jmh
       , t0.CustomerName
       , t0.CustomerNo
       , t0.Address
            FROM `customer` t0
            inner join soa t1 on t1.kd_pelanggan=t0.CustomerNo
            LEFT join mprogram t2 on t2.kd_program=t1.kd_program
            LEFT join mproject t3 on t3.kd_project=t1.kd_project
            where (t0.CustomerNo='.$customerno.' or t0.Parent_CustomerNo='.$customerno.')
        ';
        $data = $getPdo->prepare($sql);
        $data->execute();
        
        // return view('wakif.urlpdf',compact('data','cusno','cusname','address'));
        // $data = wakif::with('soa')->where('customerno',$customerno)->get();
        // $pdf = PDF::loadview('wakif.urlpdf', $data);
        // return $pdf->stream('tes.pdf');
        $path = 'images/soa/';
        // dd($path);
        $pdf = PDF::loadView('wakif.urlpdf', compact('data','cusno','cusname','address'))->save($path.'soa_'.$customerno.'_'.$tgl.'.pdf');
        // Storage::put('public/pdf/soa_' .$customerno. '.pdf', $pdf->output());
        // return $pdf->download('soa_' .$customerno. '.pdf');
    }

    public function tes()
    {
        return view('wakif.tes');
    }
 
   
}
