<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfileMhs() {

        $mahasiswa = auth()->user()->mahasiswa;

        $kelas = $mahasiswa->kelas; 

        return view('mahasiswa.profile', compact('mahasiswa', 'kelas'));
    }

    public function editProfilMhs()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        return view('form.edit-data-modal', compact('mahasiswa'));
    }

    public function updateprofilMhs(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|integer|unique:mahasiswa,nim,' . auth()->user()->mahasiswa->id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);
        
        $mahasiswa->update($validatedData);
        $mahasiswa->update(['edit' => false]);

        return redirect()->route('profile-mhs')->with('success', 'Data berhasil diperbarui.');
    }
}
