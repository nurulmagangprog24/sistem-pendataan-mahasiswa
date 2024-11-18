<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class KelolaMahasiswaController extends Controller
{
    public function index() {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();

        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function listMhs() {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();

        $dosen = auth()->user()->dosen;
        $mahasiswa = $dosen->kelas ? $dosen->kelas->mahasiswa : collect();

        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, $id) {
      $validatedData = $request->validate([
           'kelas_id' => 'nullable|exists:kelas,id',
           'nim' => 'required|unique:mahasiswa,nim,' . $id,
           'name' => 'required|string',
           'tempat_lahir' => 'required|string',
           'tanggal_lahir' => 'required|date',
       ]);
        
       $mahasiswa = Mahasiswa::findOrFail($id);

       if ($request->filled('kelas_id') && $mahasiswa->kelas_id !== $request->kelas_id) {
        $kelas = Kelas::findOrFail($request->kelas_id);

        // Periksa apakah jumlah mahasiswa di kelas sudah mencapai batas maksimal
        if ($kelas->mahasiswa()->count() >= Kelas::KAPASITAS_KELAS) {
            return redirect()->back()->withErrors(['msg' => 'Jumlah mahasiswa di kelas ini telah mencapai batas maksimal.']);
        }
    }

       $mahasiswa->update($validatedData);
       $mahasiswa->save();
         
       return redirect()->route('kelola-mahasiswa')->with('success', 'Data dosen berhasil diperbarui');
    }
}
