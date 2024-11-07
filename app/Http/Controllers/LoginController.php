<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function showLoginForm() {
        return view('auth.login');
    }

    function validasiLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $dataLogin =  [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($dataLogin)) {
            if(Auth::user()->role == 'kaprodi'){
                return redirect('dashboard/kaprodi');
            } elseif (Auth::user()->role == 'dosen wali'){
                return redirect('dashboard/dosen');
            } elseif (Auth::user()->role == 'mahasiswa'){
                return redirect('dashboard/mahasiswa');
            }
        } else {
            return redirect('')->withErrors('Email atau password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect('')->with('success', 'Berhasil Logout');
    }

}
