<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function showLoginForm()
    {
        return view('auth.login');
    }

    function validasiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Validasi email dan password
        $errors = [];
        if (!$user) {
            $errors['email'] = 'Email tidak tepat.';
        } elseif (!Hash::check($request->password, $user->password)) {
            $errors['password'] = 'Password tidak sesuai.';
        }

        // Cek jika ada error
        if (!empty($errors)) {
            return redirect('')->withErrors($errors)->withInput();
        }

        // Login user jika validasi berhasil
        Auth::login($user);
        return redirect('dashboard');
    }


    function logout()
    {
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
