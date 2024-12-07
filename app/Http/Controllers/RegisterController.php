<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function validasiRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'role' => 'required',
            // Validasi tambahan untuk masing-masing role
            'kode_dosen' => 'nullable|string|max:10|unique:dosen,kode_dosen',
            'nip' => 'nullable|string|unique:dosen,nip',
            'nim' => 'nullable|string|unique:mahasiswa,nim',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
        ]);

        // Simpan data user dasar
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Simpan data tambahan berdasarkan role
        switch ($request->role) {
            case 'kaprodi':
                Kaprodi::create([
                    'user_id' => $user->id,
                    'kode_dosen' => $request->kode_dosen,
                    'nip' => $request->nip,
                    'name' => $request->username,
                ]);
                break;

            case 'dosen wali':
                Dosen::create([
                    'user_id' => $user->id,
                    'kelas_id' => $request->kelas_id ?? null,
                    'kode_dosen' => $request->kode_dosen,
                    'nip' => $request->nip,
                    'name' => $request->username,
                ]);
                break;

            case 'mahasiswa':
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'kelas_id' => $request->kelas_id ?? null,
                    'nim' => $request->nim,
                    'name' => $request->username,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                ]);
                break;
        }

        // Redirect ke halaman yang sesuai setelah register
        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silakan Login!!!');
    }

}
