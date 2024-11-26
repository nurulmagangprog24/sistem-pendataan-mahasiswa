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

        // if(Auth::attempt($dataLogin)) {
        //     if(Auth::user()->role == 'kaprodi'){
        //         return redirect('dashboard/kaprodi');
        //     } elseif (Auth::user()->role == 'dosen wali'){
        //         return redirect('dashboard/dosen');
        //     } elseif (Auth::user()->role == 'mahasiswa'){
        //         return redirect('dashboard/mahasiswa');
        //     }
        // } else {
        //     return redirect('')->withErrors('Email atau password yang dimasukkan tidak sesuai')->withInput();
        // }
        Auth::attempt($dataLogin);
        return redirect('dashboard');
    }

    function logout() {
        Auth::logout();
        return redirect('')->with('success', 'Berhasil Logout');
    }

    
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        // Perbarui password
        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->new_password),
        ]);
        
        return back()->with('success', 'Password berhasil direset.');
    }
}
