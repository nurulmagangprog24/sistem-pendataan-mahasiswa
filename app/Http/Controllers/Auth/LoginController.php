<?php

namespace App\Http\Controllers\Auth;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }

    public function login(){
        return view('auth.login');
    }

    public function login_proses(Request $request){
        // dd($request->all()); 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->route('login')->with('failed', 'Email atau Password salah');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('Success', 'Kamu berhasil logout');
    }
}
