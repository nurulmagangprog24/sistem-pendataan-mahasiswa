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

    public function edit()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa->edit) {
            return redirect()->back()->with('error', 'You do not have permission to edit.');
        }

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa->edit) {
            return redirect()->back()->with('error', 'You do not have permission to edit.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $mahasiswa->update($validatedData);
        $mahasiswa->update(['edit' => false]);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
