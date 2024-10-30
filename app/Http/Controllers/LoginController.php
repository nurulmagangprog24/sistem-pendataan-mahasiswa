<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLoginForm() {
        return view('login');
    }

    function validasiLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infoLogin =  [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infoLogin)) {
            if(Auth::user()->role == 'kaprodi'){
                return redirect('dashboard/kaprodi');
            } elseif (Auth::user()->role == 'dosen wali'){
                return redirect('dashboard/dosen');
            } elseif (Auth::user()->role == 'mahasiswa'){
                return redirect('dashboard/mahasiswa');
            }
        } else {
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
