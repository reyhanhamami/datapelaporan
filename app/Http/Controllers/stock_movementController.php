<?php

namespace App\Http\Controllers;

use App\stock_movement;
use App\z_trfd;
use App\z_trf;
use App\z_bank_sumber;
use App\Mkas;
use App\Magen;
use App\mcabang;
use App\Mlokasi;
use App\Mprogram;
use App\Mproject;
use App\Mpelanggan;
use App\Rf_propinsi;
use App\Ac_tkm;
use App\Ac_tkm_dtl;
use App\Tdonasi;
use App\Tdonasi_dtl;
use App\Ac_tjurnal;
use App\Ac_tjurnal_dtl;
use App\Imports\transaksi_import;
use Maatwebsite\Excel\HeadingRowImport;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Excel;

class stock_movementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // get json for data table 
    public function searchnokwitansi($no_kwitansi)
    {
        $data = DB::connection('sqlsrv')->table('tdonasi')
        ->where('no_kwitansi','like','%'.$no_kwitansi.'%')
        ->select('tdonasi.alur_kerja','tdonasi.no_kwitansi','nm_wakif')
        ->get();

        if (count($data) > 0) {
            return response($data);
        }
        else {
            $res['status'] = 'false';
            $res['message'] = 'data tidak ditemukan';
            
            return response($res);
        }
    }
    public function json_transaksipertanggal()
    {
        $detail = DB::connection('sqlsrv_user_lagi')->table('z_trf')
        ->join('z_trfd','z_trf.id','z_trfd.id_z_trf')
        ->leftJoin('inventory_stock_movement','z_trfd.Refid','inventory_stock_movement.reference')
        ->leftJoin('crm_contact','inventory_stock_movement.contact','crm_contact.id')
        ->select('z_trf.id','z_trf.TglTRF','z_trf.RecAmt','z_trfd.*','inventory_stock_movement.code','inventory_stock_movement.contact','inventory_stock_movement.payment_type','agen','crm_contact.name','crm_contact.mobile')
        ->where('z_trfd.id_z_trf','=',$tgl);

        return DataTables::of($detail)->make(true);
    }
    public function verifotomatis($no_kwitansi, $id_tr)
    {
        $cabang = substr($no_kwitansi,4,3);
        $cabang = (int) $cabang;
        $array = array(
            'alur_kerja' => 'SAH',
            'sah' => 1,
            'kd_cabang' => 1,
            'uid_edit' => Auth::user()->nm_login,
            'tgl_edit' => date('Y-m-d H:i:s'),
            'kd_agen' => 712,
            'ket' => $id_tr
        );
        $to_mgm = array(
            'to_mgm' => 'Y',
        );
        $sub = substr($no_kwitansi,4);
        $replace = str_replace('_', '.', $sub);
        $tdonasi = stock_movement::where('code','=',$replace)->pluck('reference')->first();
        $z_trfd = z_trfd::where('RefID','=',$tdonasi)->update($to_mgm);
        $update = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->update($array);
        // dd($array);
    }
    public function jsonz_trf()
    {
        return DataTables::of(z_trf::query())->make(true);
    }
    public function getapi()
    {
        $apiedc = stock_movement::get();
        dd($apiedc);
        // return response()->toJson($apiedc);
    }

    // controller biasa
    public function index()
    {
        $stock_movement = DB::connection('sqlsrv_user_lagi')->table('inventory_stock_movement')
        ->join('crm_contact','inventory_stock_movement.contact','crm_contact.id')
        ->get();

        $z_trf = z_trf::get();

        return view('edc.dataedc', compact('stock_movement','z_trf'));
    }

    // crud bukti transaksi 
    public function inputtransfer()
    {
        $kas = Mkas::get();
        $z_bank_sumber = z_bank_sumber::get();
        return view('edc.inputbuktitransfer',compact('kas','z_bank_sumber'));
    }

    public function buktitransfer()
    {
        $z_trf = z_trf::get();
        return view('edc.buktitransfer',compact('z_trf'));
    }
    public function geteditbuktitransfer($id)
    {
        $z_trf = z_trf::findOrFail($id);
        return response()->json($z_trf);
    }
    public function postbuktitransfer(Request $request)
    {
        dd($request);
    }
    public function savebuktitransfer(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'rekening_penerima' => 'required',
            'norek_penerima' => 'nullable|sometimes',
            'rekening_sumber' => 'required',
            'norek_sumber' => 'required',
            'TglTRF' => 'required',
            'RecAmt' => 'required'
        ]);

        $data['NetAmt'] = $request->RecAmt;
        $data['ReconMGM'] = 'Y';
        $data['ReconCMS'] = 'Y';
        
        z_trf::create($data);

        return redirect()->route('buktitransfer')->with('success','Data Berhasil Ditambahkan');
    }
    public function deletebuktitransfer(z_trf $z_trf)
    {
        $oke = z_trf::where('id', $z_trf->id)->delete();

        return redirect()->route('buktitransfer')->with('delete','Transaksi Tanggal '.$z_trf->TglTRF.' Berhasil dihapus');
    }

    public function zsimpan(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'nama' => 'required',
            'norek' => 'required'
        ]);
        
        z_bank_sumber::create($data);

        return redirect()->route('inputtransfer');
    }

    public function carinama(Request $request)
    {
        $data = [];
        if ($request->has("q")) {
            $cari = $request->q;
            $data = z_bank_sumber::where('nama','like','%'.$cari.'%')->get();
        }
        return response()->json($data);
    }

    public function getvaluenama()
    {
        $data = [];
        $data = z_bank_sumber::where('nama',$_GET['id'])->first();

        return $data;
    }
    public function jsonbuktitransfer()
    {
        $z_trf = z_trf::get();

        return DataTables::of($z_trf)
        ->addIndexColumn()
        ->editColumn('TglTRF', '{{date("Y-m-d", strtotime("$TglTRF"))}}')
        ->editColumn('RecAmt', 'Rp.{{number_format("$RecAmt")}}')
        ->addColumn('button' , function(z_trf $z_trf){
            $button = '<a href="../donasi/cekperverifikasi/'.$z_trf->id.'/'.date("d",strtotime($z_trf->TglTRF)).'/'.(int) $z_trf->RecAmt.'/'.$z_trf->rekening_sumber.'/'.date("Y-m-d",strtotime($z_trf->TglTRF)).'" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-clipboard-check"> Verifikasi</i></a>';
            $button .= '<button type="button" name="edit" id="'.$z_trf->id.'" class="edit btn btn-outline-warning ml-2 text-light" rel="tooltip"><i class="material-icons text-light">edit </i>Edit </button>';
            return $button;
        })  
        ->RawColumns(['button'])
        ->make(true);
    }
    public function transaksipertanggal($tgl)
    {
        $detail = DB::connection('sqlsrv_user_lagi')->table('z_trf')
        ->join('z_trfd','z_trf.id','z_trfd.id_z_trf')
        ->leftJoin('inventory_stock_movement','z_trfd.Refid','inventory_stock_movement.reference')
        ->leftJoin('crm_contact','inventory_stock_movement.contact','crm_contact.id')
        ->select('z_trf.id','z_trf.TglTRF','z_trf.RecAmt','z_trfd.*','inventory_stock_movement.code','inventory_stock_movement.contact','inventory_stock_movement.payment_type','agen','crm_contact.name','crm_contact.mobile')
        ->where('z_trfd.id_z_trf','=',$tgl)
        ->get();
        // dd($detail);
       return view('edc.transaksipertanggal',compact('detail'));
    }

    public function editpengesahandonasi($pengesahan)
    {
        
        // tdonasi 
        $tdonasi = DB::connection('sqlsrv')->table('tdonasi')
        ->join('mpelanggan','tdonasi.kd_pelanggan','mpelanggan.kd_pelanggan')
        ->where('no_kwitansi','=', $pengesahan)
        ->first();
        // tdonasi detail 
        $tdonasi_dtl = DB::connection('sqlsrv')
        ->table('tdonasi_dtl')
        ->where('no_kwitansi','=',$pengesahan)->get();
        // cabang
        $mcabang = mcabang::select('ID','Nm')->get();
        // mkas 
        $mkas = Mkas::select('kd_kas','nm_kas')->get();
        // magen 
        $magen = Magen::select('kd_agen','nm_agen')->get();
        // program 
        $mprogram = Mprogram::select('kd_program','nm_program')->get();
        // project 
        $mproject = Mproject::select('kd_project','nm_project')->get();
        // propinsi
        $rf_propinsi = Rf_propinsi::select('kd_propinsi','nm_propinsi')->get();
        return view('edc.editpengesahandonasi',compact('mcabang','mkas','magen','mprogram','mproject','rf_propinsi','tdonasi','tdonasi_dtl'));
    }
    public function updatepengesahan(Request $request, $no_kwitansi)
    {
        // buat deskripsi  
        $kd_kas_kode =  $request->kas;
        $kasihnol = str_pad($kd_kas_kode, 2, "0", STR_PAD_LEFT);
        $ambil_nm_kas = DB::connection('sqlsrv')->table('mkas')->where('kd_kas','=',$kasihnol)->pluck('nm_kas');
        $deskripsi = "Donasi#".date('Ymd', strtotime($request->tgl_setor))."#Rek.".substr($ambil_nm_kas[0],0,22);
         // kode_akun_kredit
        $kd_akun_kredit = DB::connection('sqlsrv')->table('mprogram')->where('kd_program','=',$request->mprogram)->pluck('kd_akun_program')->first();
        // tanggal transaksi dan setor dikasih jam detik menit 
        $time = date("H:i:s");
        $tgl_transaksi_time = date('Y-m-d'." ".$time, strtotime($request->tgl_transaksi));
        $tgl_setor_time = date('Y-m-d'." ".$time, strtotime($request->tgl_setor));
        $datetime = date("Y-m-d H:i:s");
        // get tdonasi 
        $tdonasi = Tdonasi::where('no_kwitansi','=',$no_kwitansi)->firstorfail();
        // except 
        $data = $request->except(['_method','_token']);
        // validasi
        // looping mprogram update 
        $looptdonasidtl = $request->tdonasi_dtl;
        if ($kd_akun_kredit == NULL) {
            $kd_akun_kredit = " ";
        }
        // untuk update ac tkm detail jika tdonasi detail berubah 
        if (is_array($looptdonasidtl) || is_object($looptdonasidtl)) {
            foreach ($looptdonasidtl as $loop ) {
            Ac_tkm_dtl::where('kd_tkm','=', $tdonasi->kd_tkm)->where('no_urut', '=', $loop['id'])->update([
                'kd_akun' => $kd_akun_kredit,
                'debet' =>   0,
                'kredit' => $loop['jmh'],
                'kd_project' => $loop['kd_project'] , 
                'kd_program' => $loop['kd_program'], 
                ]);
            }
        }
        // untuk update tjurnal detail jika tdonasi detail berubah 
        if (is_array($looptdonasidtl) || is_object($looptdonasidtl)) {
            foreach ($looptdonasidtl as $loops) {
            Ac_tjurnal_dtl::where('kd_jurnal','=', $tdonasi->kd_tkm)->where('no_urut','=', $loops['id'])->update([
                'kd_akun' => $kd_akun_kredit ,
                'debet' => 0,
                'kredit' => $loops['jmh'] ,
                'kd_project' => $loops['kd_project'] ,
                'kd_program' => $loops['kd_program'],
                ]);
            }
        }
       
        // update pelanggan/wakif/customer
        $updatewakif = mpelanggan::where('kd_pelanggan','=', $request->kd_pelanggan)->update([
        'nm_lengkap' => $request->nm_lengkap,
        'alamat' => $request->alamat,
        'kota' => $request->kota,
        'pos' => $request->pos,
        'propinsi' => $request->propinsi ,
        'telp' => $request->telp,
        'hp' => $request->hp, 
        'email' => $request->email ,
        'tgl_edit' => $datetime ,
        'uid' => Auth::user()->name,
        'keterangan' => $request->keterangan
        ]);
        
        // insert ke table ac_tkm_dtl kredit 
        $n = Ac_tkm_dtl::where('kd_tkm','=', $tdonasi->kd_tkm)->orderBy('no_urut','DESC')->pluck('no_urut')->first();
        if (is_array($request->mprogram) != NULL || is_object($request->mprogram) != NULL){
             //update ke table ac_tkm 
                $ac_tkm = Ac_tkm::where('kd_tkm','=',$tdonasi->kd_tkm)->update([
                'tgl_edit' => $datetime,
                'uid' => Auth::user()->nm_login,
                'deskripsi' => $deskripsi,
                'uid_edit' => Auth::user()->nm_login,
                ]);
            // Update ke table ac_tkm_dtl debit 
            $ac_tkm_dtl_debit = Ac_tkm_dtl::where('kd_tkm','=', $tdonasi->kd_tkm)->where('no_urut', '=', 0)->update([
                'debet' => $request->total,
            ]);
            // insert jika ada penambahan program ke ac tkm kredit 
            foreach ($request->mprogram as $index => $prog) {
                $ac_tkm_dtl = new Ac_tkm_dtl ;
                $ac_tkm_dtl->kd_tkm = $tdonasi->kd_tkm;
                $ac_tkm_dtl->kd_akun = $kd_akun_kredit;
                $ac_tkm_dtl->no_urut = ++$n;
                $ac_tkm_dtl->debet =   0;
                $ac_tkm_dtl->kredit = $request->jmh[$index];
                $ac_tkm_dtl->kd_project = $request->mproject[$index] ; 
                $ac_tkm_dtl->kd_program = $request->mprogram[$index]; 
                $ac_tkm_dtl->save();
            }
        }
        else
        {
            // Update ke table ac_tkm_dtl debit 
            $ac_tkm_dtl_debit = Ac_tkm_dtl::where('kd_tkm','=', $tdonasi->kd_tkm)->where('no_urut', '=', 0)->update([
                'debet' => $request->total,
            ]);
            //update ke table ac_tkm 
            $ac_tkm = Ac_tkm::where('kd_tkm','=',$tdonasi->kd_tkm)->update([
            'tgl_edit' => $datetime,
            'uid' => Auth::user()->nm_login,
            'deskripsi' => $deskripsi,
            'uid_edit' => Auth::user()->nm_login,
            ]);
        }
        
        // looping berdasarkan banyaknya milih program 
        // insert ke table tdonasi_dtl
        if (is_array($request->mprogram) != NULL || is_object($request->mprogram) != NULL){
            // update ke table tdonasi 
            $tdonasis = Tdonasi::where('no_kwitansi','=',$no_kwitansi)->update([
                'total'  => $request->total,
                'no_kwitansi' => $request->no_kwitansi,
                'nm_wakif' => $request->nm_wakif,
                'kd_kas' => $request->kas,
                'kd_pelanggan' => $request->kd_pelanggan,
                'kd_agen' => $request->jaringan,
                'uid_edit' => Auth::user()->nm_login ,
                'tgl_edit' => $datetime ,
                'ket' => 'Uji Coba Reyhan' ,
                'tgl' => $tgl_setor_time ,
                'tgl_transaksi' => $tgl_transaksi_time,
                'kd_cabang' => $request->cabang ,
                'alur_kerja' => $request->alur_kerja,
                'biaya_bank' => $request->biaya_bank,
                'catatan_konfirmasi'  => $request->keterangan,
            ]);
             // insert ke table tdonasi_dtl
            foreach ($request->mprogram as $index => $program) {
                $tdonasi_dtl = new Tdonasi_dtl ;
                $tdonasi_dtl->no_kwitansi = $request->no_kwitansi ;
                $tdonasi_dtl->kd_program = $request->mprogram[$index];
                $tdonasi_dtl->kd_project = $request->mproject[$index];
                $tdonasi_dtl->qty = $request->qty[$index];
                $tdonasi_dtl->jmh = $request->jmh[$index];
                $tdonasi_dtl->fid_program = NULL ;
                $tdonasi_dtl->fid_sub_program = NULL ;
                $tdonasi_dtl->fqty = NULL;
                $tdonasi_dtl->fharga = NULL;
                $tdonasi_dtl->frealisasi = NULL;
                $tdonasi_dtl->fid_detail = NULL ;
                $tdonasi_dtl->sumber = 'uji_coba_reyhan' ;
                $tdonasi_dtl->save();
            }
        } 
        else 
        {
            // update ke table tdonasi 
            $tdonasis = Tdonasi::where('no_kwitansi','=',$no_kwitansi)->update([
                'no_kwitansi' => $request->no_kwitansi,
                'nm_wakif' => $request->nm_wakif,
                'kd_kas' => $request->kas,
                'kd_pelanggan' => $request->kd_pelanggan,
                'kd_agen' => $request->jaringan,
                'uid_edit' => Auth::user()->nm_login ,
                'tgl_edit' => $datetime ,
                'ket' => 'Uji Coba Reyhan' ,
                'tgl' => $tgl_setor_time ,
                'tgl_transaksi' => $tgl_transaksi_time,
                'kd_cabang' => $request->cabang ,
                'alur_kerja' => $request->alur_kerja,
                'biaya_bank' => $request->biaya_bank,
                'catatan_konfirmasi'  => $request->keterangan,
            ]);
        }
        // end looping 

        // looping kredit ac_tjurnal_dtl
        // insert ke table ac_tjurnal_dtl kredit
        $r = Ac_tjurnal_dtl::where('kd_jurnal','=', $tdonasi->kd_tkm)->orderBy('no_urut','DESC')->pluck('no_urut')->first();;
        if (is_array($request->mprogram) != NULL || is_object($request->mprogram) != NULL){
            // update ke table ac_tjurnal 
            $ac_tjurnal = Ac_tjurnal::where('kd_jurnal','=',$tdonasi->kd_tkm)->update([
                'deskripsi' => $deskripsi,
                'tgl_edit' => $datetime,
                'uid_edit' => Auth::user()->nm_login,
            ]);
            // update ke table ac_tjurnal_dtl debit
            $ac_tjurnal_dtl_debit = Ac_tjurnal_dtl::where('kd_jurnal','=', $tdonasi->kd_tkm)->where('no_urut', '=', 0)->update([
                'kd_dept' => $request->cabang,
                'debet' => $request->total,
            ]);
            // insert ac tjurnal detail kredit 
            foreach ($request->mprogram as $index => $pro) {
                $ac_tjurnal_dtl = new Ac_tjurnal_dtl;
                $ac_tjurnal_dtl->kd_jurnal = $tdonasi->kd_tkm;
                $ac_tjurnal_dtl->kd_akun = $kd_akun_kredit ;
                $ac_tjurnal_dtl->no_urut = ++$r ;
                $ac_tjurnal_dtl->debet = 0;
                $ac_tjurnal_dtl->kredit = $request->jmh[$index] ;
                $ac_tjurnal_dtl->kd_project = $request->mproject[$index] ;
                $ac_tjurnal_dtl->kd_program = $request->mprogram[$index];
                $ac_tjurnal_dtl->kd_dept = $request->cabang;
                $ac_tjurnal_dtl->memo = '';
                $ac_tjurnal_dtl->kd_program_sumber_dana = '' ;
                $ac_tjurnal_dtl->kd_project_sumber_dana = '';
                $ac_tjurnal_dtl->sumber = 'uji_coba_reyhan' ;
                $ac_tjurnal_dtl->id_dtl = NULL ;
                $ac_tjurnal_dtl->save();
            }
        }
        else
        {
            // update ke table ac_tjurnal 
            $ac_tjurnal = Ac_tjurnal::where('kd_jurnal','=',$tdonasi->kd_tkm)->update([
                'deskripsi' => $deskripsi,
                'tgl_edit' => $datetime,
                'uid_edit' => Auth::user()->nm_login,
            ]);
            // update ke table ac_tjurnal_dtl debit
            $ac_tjurnal_dtl_debit = Ac_tjurnal_dtl::where('kd_jurnal','=', $tdonasi->kd_tkm)->where('no_urut', '=', 0)->update([
                'kd_dept' => $request->cabang,
                'debet' => $request->total,
            ]);
        }
        // Tdonasi::where('no_kwitansi','=',$no_kwitansi)->update($data);
        return redirect()->route('tabledonasi')->with('edit','data berhasil di edit');
    
    }
    public function cekperverifikasi($id ,$tgl, $jmh, $sumber, $tanggal)
    {
        $getPdo = DB::connection('sqlsrv_user_lagi')->getPdo();
        $sql = "SELECT z_trf.id,z_trf.TglTRF,z_trf.RecAmt,z_trfd.*,inventory_stock_movement.code,inventory_stock_movement.contact,inventory_stock_movement.payment_type,agen,crm_contact.name,crm_contact.mobile
         FROM z_trf 
         INNER JOIN z_trfd on z_trfd.id_z_trf = z_trf.id
         LEFT JOIN inventory_stock_movement on z_trfd.Refid = inventory_stock_movement.reference
         LEFT JOIN crm_contact on inventory_stock_movement.contact = crm_contact.id
         where z_trfd.id_z_trf =" .$id."
        ";
        $detail = $getPdo->prepare($sql);

        $detail->execute();


        $jmh = (int) $jmh;
        $tbuku_bank = DB::connection('sqlsrv')->table('ac_tbuku_bank')
        ->where('deskripsi','like', '%'.$sumber.'%')
        ->where('debet','=',$jmh)
        ->where('tgl','like','%'.$tgl.'%')
        ->join('mkas','ac_tbuku_bank.kd_kas','mkas.kd_kas')
        ->select('mkas.nm_kas','ac_tbuku_bank.*')
        ->get();
      
        return view('edc.cekperverifikasi', compact('tbuku_bank','sumber','tanggal', 'detail'));
    }

    public function tdonasidetaileditkd($kd)
    {
        if (request()->ajax()) {
            $data = Tdonasi_dtl::findOrFail($kd);

            return response()->json($data);
        }
    }
    public function tdonasidetaileditkdupdate(Request $request, Tdonasi_dtl $tdonasi_dtl )
    {
        $rules = array (
            'progss' => 'required',
            'proj'  =>  'required',
            'qty'   => 'required',
            'dana'  => 'required'
        );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $updatetdonasidtl = Tdonasi_dtl::wherekd($request->kd)->update([
            'kd_program' => $request->progss,
            'kd_project' => $request->proj,
            'qty' =>  $request->qty,
            'jmh' => $request->qty * $request->dana,
        ]);
        
        if ($updatetdonasidtl) {
            // get total dari tdonasi 
            $jum = DB::connection('sqlsrv')->table('tdonasi_dtl')->where('no_kwitansi','=', $request->no_kwitansi)->pluck('jmh');
            
            $tambah = 0;
            foreach ($jum as $jums) {
                $tambah += $jums;
            }
        }

        // update total di tdonasi
        Tdonasi::where('no_kwitansi','=',$request->no_kwitansi)->update([
            'total' => $tambah
        ]);

        return response()->json(['success' => 'Data Berhasil Diupdate']);

    }

    // upload excel z_trf 
    public function upload(Request $request){
        $error = Validator::make($request->all(),[
            'upload' => 'required|mimes:xls,xlsx'
        ]);    
        if ($error->fails()) {
            return response()->json(['erorrs' => $error->errors()->all()]);
        }
        if ($request->hasFile('upload')) {
            $file = $request->file('upload'); //get name file upload
            // Excel::import(new transaksi_import, $file);
            $tes = Excel::toArray(new transaksi_import, $file);

            foreach ($tes as $te) {
                // convert dd/mm/yyyy to yyyy-mm-dd trx
                $getsettle = $te[0]['settlement_date'];
                $changesettle = str_replace('/','-', $getsettle);
                $settlement_dates = date('Y-m-d', strtotime($changesettle));
                // bikin var untuk tampung looping total 
                $tot = 0;
                $z = new z_trf;
                $z->TglTRF = $settlement_dates;
                $z->save();
                foreach ($te as $t) {
                    // increase tot 
                    $tot += $t['total_settlement'];
                    // get id from z_trf 
                    $id = $z->id;

                    // convert dd/mm/yyyy to yyyy-mm-dd trx
                    $gettrx = $t['trx'];
                    $change = str_replace('/','-',$gettrx);
                    $trx = date('Y-m-d', strtotime($change));

                    // convert dd/mm/yyyy to yyyy-mm-dd trx
                    $getsettle = $t['settlement_date'];
                    $changesettle = str_replace('/','-', $getsettle);
                    $settlement_date = date('Y-m-d', strtotime($changesettle));

                    // insert to z_trfd 
                    $z_trfd = new z_trfd;
                    $z_trfd->TglTRF = $trx;
                    $z_trfd->TglTRX = $trx;
                    $z_trfd->TglSettlement = $settlement_date;
                    $z_trfd->Amt = $t['total_settlement'];
                    $z_trfd->ReconCMS = 'Y';
                    $z_trfd->paytype =  'FIN';
                    $z_trfd->id_z_trf =  $id;
                    $z_trfd->save();

                }
                z_trf::where('id','=',$z->id)->update([
                    'NetAmt' => $tot,
                    'RecAmt' => $tot,
                    'rekening_sumber' => 'FINNET',
                    'paytype' => 'FIN',
                ]);
                return response()->json(['success' => 'File Berhasil diupload']);
            }

        }

    }

    public function tdonasidetaildelete($kd, Tdonasi_dtl $tdonasi_dtl )
    {
        // get data 
        $jmh = Tdonasi_dtl::where('kd','=', $kd)->pluck('jmh')->first();
        $no_kwitansi = Tdonasi_dtl::where('kd','=', $kd)->pluck('no_kwitansi')->first();
        $kd_program = Tdonasi_dtl::where('kd','=', $kd)->pluck('kd_program')->first();
        $kd_tkm = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->pluck('kd_tkm')->first();
        $kd_project = Tdonasi_dtl::where('kd','=', $kd)->pluck('kd_project')->first();
        $total = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->pluck('total')->first();
        $debettkm = Ac_tkm_dtl::where('kd_tkm','=', $kd_tkm)->pluck('debet')->first();
        $debettjurnal = Ac_tjurnal_dtl::where('kd_jurnal','=', $kd_tkm)->pluck('debet')->first();
        $kurang = (int) $total - (int) $jmh;
        $kurangtkm = (int) $debettkm - (int) $jmh;
        $kurangtjurnal = (int) $debettjurnal - (int) $jmh;
        // dd($kurangtjurnal);

        // update 
        $tessss = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->update(['total' => $kurang]);
        $te = Ac_tkm_dtl::where('kd_tkm','=', $kd_tkm)->where('kredit','=',0)->update(['debet' => $kurangtkm]);
        $t = Ac_tjurnal_dtl::where('kd_jurnal','=', $kd_tkm)->where('kredit','=',0)->update(['debet' => $kurangtjurnal]);
        // delete 
        $tesss = Tdonasi_dtl::where('kd','=', $kd)->first()->delete();
        $tess = Ac_tjurnal_dtl::where('kd_jurnal','=',$kd_tkm)->where('kd_project','=',$kd_project)->where('kd_program','=',$kd_program)->where('kredit','=',$jmh)->first()->delete();
        $tes = Ac_tkm_dtl::where('kd_tkm','=',$kd_tkm)->where('kd_project','=',$kd_project)->where('kd_program','=',$kd_program)->where('kredit','=',$jmh)->first()->delete();
        
    }

    
}
