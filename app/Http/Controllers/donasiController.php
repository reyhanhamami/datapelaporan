<?php

namespace App\Http\Controllers;
use App\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mkas;
use App\Magen;
use App\mcabang;
use App\Sc_pengguna;
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
use App\wakif;
use App\Ac_tjurnal_dtl;
use Yajra\Datatables\Datatables;
use Cache;
use Session;
use Auth;


class donasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Json tdonasi 
    public function jsontdonasi(Request $request)
    {
        // ,'mpelanggan.nm_lengkap','mpelanggan.alamat','mpelanggan.hp','mpelanggan.email'
        if ($request->ajax()) {
            set_time_limit(0);
            if (!empty($request->from_date)) {
                // filter jika ada request cari 
                $join = Tdonasi::with('mpelanggan')->
                whereBetween('tgl', array(
                    $request->from_date, $request->to_date
                ))->select('tdonasi.*');
            } else {
                // join semua jika tidak ada request cari 
                $join = Tdonasi::with('mpelanggan')
                ->select('tdonasi.*');
            }
            // dd($join);

            return Datatables::of($join)
            ->addColumn('sah', function(Tdonasi $tdonasi){
                if ($tdonasi->alur_kerja == 'SAH') {
                    return '<i class="fas fa-check text-success"></i>';
                } 
                else
                {
                    return '<i class="fas fa-times text-danger"></i>';
                }
            })
            ->editColumn('tgl','{{date("Y-m-d", strtotime("$tgl"))}}')
            ->editColumn('tgl_transaksi','{{date("Y-m-d", strtotime("$tgl_transaksi"))}}')
            ->editColumn('tgl_tambah','{{date("Y-m-d", strtotime("$tgl_tambah"))}}')
            ->editColumn('total','Rp.{{number_format("$total")}}')
            ->addColumn('alamat', function(Tdonasi $tdonasi){
                return $tdonasi->mpelanggan ?
                str_limit($tdonasi->mpelanggan->alamat, 30,'...') : '';
            })
            ->addColumn('nm_lengkap', function(Tdonasi $tdonasi){
                return $tdonasi->mpelanggan['nm_lengkap'];
            })
            ->addColumn('hp', function(Tdonasi $tdonasi){
                return $tdonasi->mpelanggan['hp'];
            })
            ->addColumn('email', function(Tdonasi $tdonasi){
                return $tdonasi->mpelanggan ? str_limit($tdonasi->mpelanggan['email'], 10,'...') : '';
            })
            ->addColumn('edit', function(Tdonasi $tdonasi){
                $button  =  '<a href="../editpengesahandonasi/'.$tdonasi->no_kwitansi.'" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"> Edit</i></a>';
                $button .= '<button type="button" name="upload" id="'.$tdonasi->no_kwitansi.'" class="upload btn my-2 btn-dark btn-sm"><i class="fas fa-cloud-upload-alt"> <span class="small"> Send Web</small></i></button>';
                $button .= '<button type="button" name="edit" id="'.$tdonasi->no_kwitansi.'" class="delete btn btn-danger btn-sm "><i class="fas  fa-trash"> Delete</i></button>';
                return $button;
              
                
            })
            ->rawColumns(['edit','sah'])
            ->make(true);
        }
    }

    public function getcabang( Request $request)
    {
        // get searh agen berdasarakn value id cabang
        if ($request->ajax()) {
            $getagen = Magen::where('CabangID','=', $request->cabang)->select('kd_agen','nm_agen')->get();
            $data = view('donasi.getcabang',compact('getagen'))->render();
            return response()->json(['options' => $data]);
        }

    }

    public function getdana(Request $request)
    {
        if ($request->ajax()) {
            $search = Mprogram::where('kd_program','=', $request->mprogram)->pluck('nilai')->first();
            return response()->json(['dana' => $search]);
        }
    }

    // controller 
    public function index(Request $request)
    {
        $nama = Auth::user()->nm_login;
        $peng = Sc_pengguna::where('nm_login','=',$nama)
        ->join('sc_group_data','sc_group_data.kd_group','sc_pengguna.kd_group')
        ->pluck('cabang')->first();
        $ex = explode(';', $peng);
        $mcabang = DB::connection('sqlsrv')->table('mcabang')->select('ID','Nm')->whereIn('id',$ex)->get();

        $mkas = Mkas::select('kd_kas','nm_kas')->get();
        $magen = Magen::select('kd_agen','nm_agen')->get();
        $mprogram = Mprogram::select('kd_program','nm_program')->get();
        $mproject = Mproject::select('kd_project','nm_project')->get();
        $rf_propinsi = Rf_propinsi::select('kd_propinsi','nm_propinsi')->get();

       
        
        return view('donasi.donasi', compact('mcabang','mkas','magen','mprogram','mproject','rf_propinsi','tdonasi'));
    }

    public function carihp(Request $request)
    {
        $data = [];
        if ($request->has("q") and strlen($request->q) > 7) {
            $cari = $request->q;
            $data = DB::connection('sqlsrv')->table('mpelanggan')
            ->where('hp','like',"$cari%")->get();
        }
        return response()->json($data);
    }
    public function cariemail(Request $request){
        $data= [];
        if ($request->has("q") and strlen($request->q) > 5) {
            $cari = $request->q;
           
            $data = Mpelanggan::where('email','like',"%$cari%")->select(['email','kd_pelanggan','nm_lengkap','alamat','kota','hp','propinsi','pos','telp'])->get();
        }
        return response()->json($data);
    }
    public function getvaluewakif()
    {
        $data = [];

        $data = Mpelanggan::where('mpelanggan.kd_pelanggan',$_GET['id'])->first();

        return $data;
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'alur_kerja' => 'required',
            'kas' => 'required',
            'cabang' => 'required',
            'no_kwitansi' => 'required',
            'telp' => 'nullable|sometimes|numeric',
            'nm_lengkap' => 'required|max:100',
            'nm_wakif' => 'max:100',
            'pos' => 'max:5',
            'hp' => 'nullable|sometimes|numeric|min:8',
            'email' => 'nullable|sometimes|email',
            'mprogram' => 'required'
        ]);
        $kd_kas_kode =  $request->kas;
        $no_kwitansi =  $request->no_kwitansi;
        $kasihnol = str_pad($kd_kas_kode, 2, "0", STR_PAD_LEFT);
        $ambil_nm_kas = DB::connection('sqlsrv')->table('mkas')->where('kd_kas','=',$kasihnol)->pluck('nm_kas');
        // $data = $request->all();
        $no_kwitansi_sama = DB::connection('sqlsrv')->table('tdonasi')->where('no_kwitansi','like','%'.$request->no_kwitansi.'%')->get();
        $hp_sama = DB::connection('sqlsrv')->table('mpelanggan')->where('hp','=',$request->hp)->get();
        $email_sama = DB::connection('sqlsrv')->table('mpelanggan')->where('email','=',$request->email)->get();

        // tanggal dan time hari ini 
        $datetime = date("Y-m-d H:i:s");
        // tahun dan bulan 20 02 
        $yearmonth = date('ym');
        
        // tanggal transaksi dan setor dikasih jam detik menit 
        $time = date("H:i:s");
        $tgl_transaksi_time = date('Y-m-d'." ".$time, strtotime($request->tgl_transaksi));
        $tgl_setor_time = date('Y-m-d'." ".$time, strtotime($request->tgl_setor));
        
        $nokdjurnal = DB::connection('sqlsrv')->table('ac_tkm')->orderBy('tgl','desc')->orderBy('kd_tkm','desc')->where('kd_tkm','like','RVZ%')->pluck('kd_jurnal')->first();
        if ($nokdjurnal == NULL) {
            $kd_tkm = "RVZ".$yearmonth.'1';
        } else {
            $kd_tkm = ++$nokdjurnal;
        }

        // deskripsi contoh donasi #20200214# Rek. Bni 1122200 
        $deskripsi = "Donasi#".date('Ymd')."#Rek.".substr($ambil_nm_kas[0],0,22);
       
        $iduser = Auth::user()->nm_login;

        // kode_akun_kredit
        $kd_akun_kredit = DB::connection('sqlsrv')->table('mprogram')->where('kd_program','=',$request->mprogram)->pluck('kd_akun_program')->first();
        
        // kode_akun_debit 
        $kd_akun_debit = DB::connection('sqlsrv')->table('mkas')->where('kd_kas','=',$kasihnol)->pluck('kd_akun')->first();
        $kd_akun_debit = str_replace('.','', $kd_akun_debit);

        // kode pelanggan 
        $lastcustomerno = DB::connection('sqlsrv')->table('mpelanggan')->where('kd_pelanggan', 'like' , '20%')->orderBy('kd_pelanggan', 'DESC')->pluck('kd_pelanggan')->first();
        
        $lastcustomerno =  (int) $lastcustomerno + 1;
        // $kd_urut_pelanggan = '000001';
        // $kd_pelanggan = date('y').$lastcustomerno++;
      
        
        if ($request->carihp or $request->cariemail) {
            // echo 'Data sudah ada';
            $mpelangganupdate = Mpelanggan::where('kd_pelanggan','=', $request->kd_pelanggan)->update([
            'nm_lengkap' => $request->nm_lengkap,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'pos' => $request->pos,
            'propinsi' => $request->propinsi ,
            'telp' => $request->telp,
            'hp' => $request->hp, 
            'email' => $request->email ,
            'tgl_edit' => $datetime ,
            ]);

            // udpate wakif di mysql
            $wakifupdate = wakif::where('customerno','=', $request->kd_pelanggan)->update([
            'customername' => $request->nm_lengkap,
            'address' => $request->alamat,
            'city' => $request->kota,
            'postalcode' => $request->pos,
            'ProvinceID' => $request->propinsi ,
            'Hp2' => $request->telp,
            'MobilePhone' => $request->hp, 
            'customeremail' => $request->email ,
            'datemodified' => $datetime ,
            ]);
        }
        else 
        {
            if ($request->hp and count($hp_sama) >= 1 ) {
                return redirect()->back()->with('gagal','no Hp tidak boleh sama');
            } 
            elseif($request->email and count($email_sama) >= 1)
            {
                return redirect()->back()->with('gagal','email tidak boleh sama');
            }
            else 
            {
                // insert ke table mpelanggan 
                $pelanggan = new Mpelanggan;
                $pelanggan->kd_pelanggan = $lastcustomerno;
                $pelanggan->nm_lengkap = $request->nm_lengkap;
                $pelanggan->alamat = $request->alamat;
                $pelanggan->kota = $request->kota;
                $pelanggan->pos = $request->pos;
                $pelanggan->propinsi = $request->propinsi ;
                $pelanggan->telp = $request->telp;
                $pelanggan->hp = $request->hp; 
                $pelanggan->email = $request->email ;
                $pelanggan->no_vac = 'NULL';
                $pelanggan->aktif = '1';
                $pelanggan->nip_telemarketing = 'NULL' ;
                $pelanggan->nip_sales_va = "";
                $pelanggan->keterangan = NULL ; 
                $pelanggan->status = '1' ;
                $pelanggan->tidak_dikirim = '1' ;
                $pelanggan->tgl_tambah = $datetime;
                $pelanggan->tgl_edit = $datetime ;
                $pelanggan->uid = Auth::user()->nm_login;
                $pelanggan->uid_edit = 'uji_coba_reyhan';
                $pelanggan->kd_salesman = NULL;
                $pelanggan->update_tele = NULL; 
                $pelanggan->KirimTelp = NULL;
                $pelanggan->KirimWA = NULL;
                $pelanggan->KirimEmail = NULL;
                $pelanggan->temp = 'dummy';
                $pelanggan->save();

                // insert ke table wakif mysql 
                $wakif = new wakif;
                $wakif->customerno = $lastcustomerno;
                $wakif->customername = $request->nm_lengkap;
                $wakif->address = $request->alamat;
                $wakif->city = $request->kota;
                $wakif->postalcode = $request->pos;
                $wakif->ProvinceID = $request->propinsi ;
                $wakif->Hp2 = $request->telp;
                $wakif->MobilePhone = $request->hp; 
                $wakif->customeremail = $request->email ;
                // $wakif->Is_Active = '1';
                // $wakif->TelemarketingID = 'NULL' ;
                // $wakif->nip_sales_va = "";
                // $wakif->Description = NULL ; 
                // $wakif->StatusID = '1' ;
                // $wakif->IsNotSend = '1' ;
                $wakif->datecreated = $datetime;
                $wakif->datemodified = $datetime ;
                $wakif->createdby = Auth::user()->nm_login;
                $wakif->save();
            }
           
        }
        if (count($no_kwitansi_sama) >= 1) {
            return redirect()->back()->with('gagal','no kwitansi tidak boleh sama');
        }
        else 
        {
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
            'uid' => Auth::user()->nm_login,
            ]);

        // insert ke table ac_tkm 
        $ac_tkm = new Ac_tkm ;
        $ac_tkm->kd_tkm = $kd_tkm;
        $ac_tkm->tgl = $datetime;
        $ac_tkm->dr = 'Wakif';
        $ac_tkm->deskripsi = $deskripsi;
        $ac_tkm->kd_jurnal = $kd_tkm;
        $ac_tkm->tgl_tambah = $datetime;
        $ac_tkm->tgl_edit = $datetime;
        $ac_tkm->uid = Auth::user()->nm_login;
        $ac_tkm->uid_edit = Auth::user()->nm_login;
        $samas = DB::connection('sqlsrv')->table('ac_tkm')->where('kd_tkm','=',$ac_tkm->kd_tkm)->count();
        if ($samas >= 1) {
            $nokdjurnal = DB::connection('sqlsrv')->table('ac_tkm')->orderBy('tgl','desc')->orderBy('kd_tkm','desc')->where('kd_tkm','like','RVZ%')->pluck('kd_jurnal')->first();
            $ac_tkm->kd_tkm = ++$nokdjurnal;
            $ac_tkm->kd_jurnal = $ac_tkm->kd_tkm;
            $ac_tkm->save();
        } else {
            $ac_tkm->save();
        }
        // insert ke table ac_tkm_dtl debit 
        $ac_tkm_dtl_debit = new Ac_tkm_dtl ;
        $ac_tkm_dtl_debit->kd_tkm = $ac_tkm->kd_tkm;
        $ac_tkm_dtl_debit->kd_akun = $kd_akun_debit;
        $ac_tkm_dtl_debit->no_urut = 0;
        $ac_tkm_dtl_debit->debet = $request->total  ;
        $ac_tkm_dtl_debit->kredit = 0;
        $ac_tkm_dtl_debit->kd_project = "" ; 
        $ac_tkm_dtl_debit->kd_program = ""; 
        $ac_tkm_dtl_debit->save();
        
        // looping ac_tkm_dtl kredit 
        // insert ke table ac_tkm_dtl kredit 
        $n = '1';
        foreach ($request->mprogram as $index => $prog) {
            $ac_tkm_dtl = new Ac_tkm_dtl ;
            $ac_tkm_dtl->kd_tkm = $ac_tkm->kd_tkm;
            $ac_tkm_dtl->kd_akun = $kd_akun_kredit;
            $ac_tkm_dtl->no_urut = $n++;
            $ac_tkm_dtl->debet =   0;
            $ac_tkm_dtl->kredit = $request->jmh[$index];
            $ac_tkm_dtl->kd_project = $request->mproject[$index] ; 
            $ac_tkm_dtl->kd_program = $request->mprogram[$index]; 
            $ac_tkm_dtl->save();
        }
        // insert ke table ac_tjurnal 
        $ac_tjurnal = new Ac_tjurnal;
        $ac_tjurnal->kd_jurnal = $ac_tkm->kd_tkm;
        $ac_tjurnal->tgl = $datetime;
        $ac_tjurnal->deskripsi = $deskripsi;
        $ac_tjurnal->st_posting = 1 ;
        $ac_tjurnal->tgl_tambah = $datetime;
        $ac_tjurnal->tgl_edit = $datetime ;
        $ac_tjurnal->uid = Auth::user()->nm_login;
        $ac_tjurnal->uid_edit = Auth::user()->nm_login; ;
        $ac_tjurnal->tipe_jurnal = NULL ;
        $ac_tjurnal->sumber = 'uji_coba_reyhan' ;
        $ac_tjurnal->save();
        
        // insert ke table ac_tjurnal_dtl debit
        $ac_tjurnal_dtl_debit = new Ac_tjurnal_dtl;
        $ac_tjurnal_dtl_debit->kd_jurnal = $ac_tkm->kd_tkm;
        $ac_tjurnal_dtl_debit->kd_akun = $kd_akun_debit ;
        $ac_tjurnal_dtl_debit->no_urut = 0 ;
        $ac_tjurnal_dtl_debit->debet = $request->total;
        $ac_tjurnal_dtl_debit->kredit = 0 ;
        $ac_tjurnal_dtl_debit->kd_project = "" ;
        $ac_tjurnal_dtl_debit->kd_program = "";
        $ac_tjurnal_dtl_debit->kd_dept = $request->cabang;
        $ac_tjurnal_dtl_debit->memo = '';
        $ac_tjurnal_dtl_debit->kd_program_sumber_dana = '' ;
        $ac_tjurnal_dtl_debit->kd_project_sumber_dana = '';
        $ac_tjurnal_dtl_debit->sumber = 'uji_coba_reyhan' ;
        $ac_tjurnal_dtl_debit->id_dtl = NULL ;
        $ac_tjurnal_dtl_debit->save();
        
        // looping kredit ac_tjurnal_dtl
        // insert ke table ac_tjurnal_dtl kredit
        $r = 1;
        foreach ($request->mprogram as $index => $pro) {
            $ac_tjurnal_dtl = new Ac_tjurnal_dtl;
            $ac_tjurnal_dtl->kd_jurnal = $ac_tkm->kd_tkm;
            $ac_tjurnal_dtl->kd_akun = $kd_akun_kredit ;
            $ac_tjurnal_dtl->no_urut = $r++ ;
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
        
        // insert ke table tdonasi 
        $tdonasi = new Tdonasi;
        $tdonasi->no_kwitansi = $request->no_kwitansi;
        $tdonasi->nm_wakif = $request->nm_wakif;
        $tdonasi->kd_kas = $request->kas;
        if ($request->kd_pelanggan == NULL) {
            $tdonasi->kd_pelanggan = $lastcustomerno;
        }else {
            $tdonasi->kd_pelanggan = $request->kd_pelanggan;
        }
        $tdonasi->kd_agen = $request->jaringan;
        $tdonasi->tgl = $tgl_setor_time ;
        $tdonasi->total = $request->total ;
        $tdonasi->sah  = 0;
        $tdonasi->kd_tkm  = $ac_tkm->kd_tkm;
        $tdonasi->uid = Auth::user()->nm_login;
        $tdonasi->tgl_tambah = $datetime;
        $tdonasi->uid_edit = Auth::user()->nm_login ;
        $tdonasi->tgl_edit = $datetime ;
        $tdonasi->ket = 'Uji Coba Reyhan' ;
        $tdonasi->tgl_transaksi = $tgl_transaksi_time;
        $tdonasi->kd_sales = "";
        $tdonasi->posting = 1 ;
        $tdonasi->sumber = 'uji_coba_reyhan' ;
        $tdonasi->fkd_akun = NULL ;
        $tdonasi->fjenis_aktivitas = NULL ;
        $tdonasi->fsub_jenis_aktivitas = NULL ;
        $tdonasi->fnm_pendaftar = ''   ;
        $tdonasi->kd_cabang = $request->cabang  ;
        $tdonasi->alur_kerja = $request->alur_kerja ;
        $tdonasi->biaya_bank = $request->biaya_bank ;
        $tdonasi->konfirmasi  = NULL;
        $tdonasi->tgl_konfirmasi = NULL ;
        $tdonasi->catatan_konfirmasi  = NULL;
        $tdonasi->update_project = NULL ;
        $tdonasi->save();
        
        // looping berdasarkan banyaknya milih program 
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
        // end looping 
      
        }
         // api sms 
        //  $message = 'Alhamdulillah, kami sudah menerima Donasi an. Bpk/Ibu '.trim($request->nm_lengkap).' 
        //  senilai Rp '.number_format($request->total, 0, ',','.').', Semoga Wakaf/Donasi Anda menjadi Pahala yg Mengalir Abadi';
        //     // Send notification message

        //     $query = [
        //         'userkey' => 'sp7hxw',
        //         'passkey' => '123bwatop',
        //         'nohp' => trim($request->hp),
        //         'pesan' => $message,
        //         'type' => 'otp',
        //     ];

        //     $sms_gateway_url = 'https://alpha.zenziva.net/apps/smsapi.php';

        //     $curl = curl_init();

        //     $url = sprintf("%s?%s", $sms_gateway_url, http_build_query($query));

        //     curl_setopt($curl, CURLOPT_URL, $url);
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        //     $result = curl_exec($curl);
        
        return redirect()->route('tabledonasi')->with('success','Donasi Wakif berhasil dibuat');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function tabledonasi()
    {
        return view('donasi/tabledonasi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function deletedonasi(Donasi $donasi, $no_kwitansi)
    {
        // ambil kode tkm 
        $kd_tkm = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->pluck('kd_tkm');
        // delete tdonasi 
        $delete = Tdonasi::where('no_kwitansi','=', $no_kwitansi)->delete();
        $delete = Tdonasi_dtl::where('no_kwitansi','=', $no_kwitansi)->delete();
        // delete ac tkm 
        $deleteactkm = Ac_tkm::where('kd_tkm','=', $kd_tkm)->delete();
        $deleteactkmdtl = Ac_tkm_dtl::where('kd_tkm','=', $kd_tkm)->delete();
        // delete tjurnal 
        $deleteactjurnal = Ac_tjurnal::where('kd_jurnal','=', $kd_tkm)->delete();
        $deleteactjurnaldtl = Ac_tjurnal_dtl::where('kd_jurnal','=', $kd_tkm)->delete();
        // return redirect()->back()->with('delete','no kwitansi '.$no_kwitansi.' berhasil dihapus');
    }

    public function uploadweb($no_kwitansi)
    {
        $tdonasi = Tdonasi::with('Tdonasi_dtl','Mpelanggan')->where('no_kwitansi','=', $no_kwitansi)->get();

        foreach ($tdonasi as $fulldata) {
            // ambil tdonasi detail masukin ke dalam array 
            $tampung = array();
            $i = 0;
            foreach ($fulldata->tdonasi_dtl as $det) {
                $tampung[] = array(
                    "NoKwitansi"=> $det['no_kwitansi'],
                    "Kd_Project_Master"=> $det['kd_project'],
                    "Qty"=> $det['qty'],
                    "Jmh"=> $det['jmh'],
                    "KdProgram"=> $det['kd_program']
                );
            }

            $dataarray = array(
            "NoKwitansi"=> $fulldata->no_kwitansi,
            "KdDonatur"=> $fulldata->kd_pelanggan,
            "Kd"=> $fulldata->kd_kas,
            "NmWakif"=> $fulldata->nm_wakif,
            "TglTransaksi"=> $fulldata->tgl_transaksi,
            "Total"=> $fulldata->total,
            "Donatur"=> array(
                "NmLengkap"=> $fulldata->mpelanggan['nm_lengkap'],
                "Alamat"=> $fulldata->mpelanggan['alamat'],
                "Kota"=> $fulldata->mpelanggan['kota'],
                "Pos"=> $fulldata->mpelanggan['pos'],
                "Propinsi"=> $fulldata->mpelanggan['propinsi'],
                "Telp"=> $fulldata->mpelanggan['telp'],
                "Hp"=> $fulldata->mpelanggan['hp'],
                "Email"=> $fulldata->mpelanggan['email']
            ),
            "Items"=> $tampung,
            );

            $datajson = json_encode($dataarray);
            
            $url = 'https://develwqupgrade.wakafquran.org/api/transaction_offline/f5c4a4d2-3901-441c-b565-5eefcf48f0fa/8e7f63fd38d36d63';

            if ($datajson) {
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_FOLLOWLOCATION => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type:application/json',
                    ),
                    CURLOPT_POSTFIELDS => $datajson,
                ));
                $hasil = curl_exec($ch);
                // $response = json_decode($hasil);
                curl_close($ch);
                echo $hasil;
            }
        }

    }
   
}
