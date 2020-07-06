<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Sc_pengguna;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;

class loginController extends Controller
{

    // show tampilan login 
     public function getLogin(){
        return view("auth.login");
    }
   
    //proses login
    public function login(Request $request){
        $request->validate([
            'nm_login' => 'required',
            'pwd' => 'required'
        ]);
        // $user = Sc_pengguna::where('nm_login','=',$request->nm_login)->first();
        // $password = Sc_pengguna::where('nm_login','=',$request->nm_login)->first();
        // dd($user);
        $credentials = [
            'nm_login' => $request->nm_login,
            'pwd' => $request->pwd
        ];
        if (Auth::Attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        
     
        return redirect()->back()->with('gagal', 'Password atau Email anda salah!!')->withInput($request->only('nm_login', 'pwd'));
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }

    
}
