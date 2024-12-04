<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'kaprodi') {
            $kaprodi = $user->kaprodi;
            return view('profile', compact('user', 'kaprodi'));
        } elseif ($user->role === 'dosen wali') {
            $dosen = $user->dosen;
            return view('profile', compact('user', 'dosen'));
        } elseif ($user->role === 'mahasiswa') {
            $mahasiswa = $user->mahasiswa;
            $kelas = $mahasiswa->kelas;
            return view('profile', compact('user', 'mahasiswa', 'kelas'));
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Validasi dan update untuk Kaprodi atau Dosen
        if ($user->role === 'kaprodi' || $user->role === 'dosen wali') {
            if ($user->role === 'kaprodi') {
                // Validasi untuk Kaprodi
                $validatedData = array_merge($validatedData, $request->validate([
                    'nip' => 'required|unique:kaprodi,nip,' . ($user->kaprodi ? $user->kaprodi->id : ''),
                    'kode_dosen' => 'required|unique:kaprodi,kode_dosen,' . ($user->kaprodi ? $user->kaprodi->id : ''),
                ]));
                $user->kaprodi->update($validatedData);
            } else {
                // Validasi untuk Dosen
                $validatedData = array_merge($validatedData, $request->validate([
                    'nip' => 'required|unique:dosen,nip,' . ($user->dosen ? $user->dosen->id : ''),
                    'kode_dosen' => 'required|unique:dosen,kode_dosen,' . ($user->dosen ? $user->dosen->id : ''),
                ]));
                $user->dosen->update($validatedData);
            }
        }

        // Validasi dan update untuk Mahasiswa
        if ($user->role === 'mahasiswa') {
            $validatedData['nim'] = $request->validate([
                'nim' => 'required|unique:mahasiswa,nim,' . $user->mahasiswa->id,
            ])['nim'];

            $validatedData['tempat_lahir'] = $request->input('tempat_lahir');
            $validatedData['tanggal_lahir'] = $request->input('tanggal_lahir');

            // Update data mahasiswa
            $user->mahasiswa->update($validatedData);
        }

        // Update data user (username dan email)
        $user = User::findOrFail($user->id); 
        $user->update($validatedData);
        $user->save(); 

        // Redirect kembali ke profil dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
