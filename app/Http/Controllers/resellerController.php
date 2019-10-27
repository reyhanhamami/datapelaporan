<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class resellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(20);
        return view('reseller.reseller',compact('user'));
    }
    public function cari(request $request)
    {
        $cari = $request->cari;
        $user = User::where('nama_akun','like','%'.$cari.'%')->orderBy('nama_akun','ASC')->paginate(20);

        return view('reseller.reseller', compact('user'));
    }

    public function register()
    {
        return view('reseller.register');
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
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'telepon' => 'required|min:6',
            'foto' => 'image|mimes:png,jpg,jpeg',
            'password' => 'required|confirmed|min:8',
            'nama_akun' => 'required',
            'level' => 'required|in:admin,reseller,gudang',
        ]);

        // ambil request foto di taruh di variabel 
        if ($request->foto) {
            $foto = $request->file('foto');
            
            // ambil extensionnya saja
        $ext = $foto->getClientOriginalExtension();
        
        // kasih nama
        $input['imagename'] = date("Y-m-d,His").".$ext";

        // lokasi penyimpanan 
        $lokasi = public_path('images/avatars');
        
        if (!file_exists($lokasi)) {
            mkdir($lokasi);
        };
        
        // plugin image mengambil realpath foto
        $img = Image::make($foto->getRealPath());
        // untuk dipotong 
        $img->resize(150,150)->save($lokasi.'/'.$input['imagename']);
        
        // ambil namanya 
        $data['foto'] = $input['imagename'];
        }
        
        // hash password using bcrypt
        $data['password'] = bcrypt($data['password']);
        
        User::create($data);

        return redirect()->route('reseller')->with('success','User Login berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('reseller.editreseller',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $data = $request->except(['_method','_token']);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'required|min:6',
            'foto' => 'sometimes|nullable|image|mimes:png,jpg,jpeg',
            'password' => 'sometimes|nullable|confirmed|min:8',
            'nama_akun' => 'required',
            'level' => 'required|in:admin,reseller,gudang',
        ]);
        if($request->hasFile('foto')){
        // hapus dulu 
        $image_path = public_path('images/avatars/'.$user->foto);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        // ambil request foto di taruh di variabel 
        $foto = $request->file('foto');

        // ambil extensionnya aja dari nama foto aslinya 
        $ext = $foto->getClientOriginalExtension();

        // kasih nama
        $input['imagename'] = date('Y-m-d,His').".$ext";

        // lokasi penyimpanan 
        $lokasi = public_path('images/avatars');

        if (!file_exists($lokasi)) {
            mkdir($lokasi);
        };

        // plugin image mengambil realpath foto
        $img = Image::make($foto->getRealPath());
        // untuk dipotong 
        $img->resize(150,150)->save($lokasi.'/'.$input['imagename']);
        
        // ambil namanya 
        $data['foto'] = $input['imagename'];
        }

        if($request->filled('password')){
            // jika password diketik ulang di form maka hashing 
            $data['password'] = bcrypt($data['password']);
        } else {
            // jika password engak diisi input data yang lama
            $data = array_except($data, ['password']);
        }

        User::where('id',$user->id)->update($data);
        return redirect()->route('reseller')->with('update','user '.$user->name.' berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        User::destroy('id',$user->id);
        $image_path = public_path('images/avatars/'.$user->foto);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        return redirect()->back()->with('delete','User '.$user->name.' berhasil dihapus');
    }
}
