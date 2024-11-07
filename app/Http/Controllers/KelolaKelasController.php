<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KelolaKelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('dosen', 'mahasiswa')->get();
        return view('kaprodi.kelola-kelas', compact('kelas'));
    }
    // public function index()
    // {
    //     $kelas = Kelas::with('dosen', 'mahasiswa')->get();
    //     return view('kelas.index', compact('kelas'));
    // }

    // public function create()
    // {
    //     return view('kelas.create');
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:kelas,name',
            'jumlah' => 'required|integer|min:1'
        ]);

        Kelas::create($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    // public function edit($id)
    // {
    //     $kelas = Kelas::findOrFail($id);
    //     $dosen = Dosen::all();
    //     $mahasiswa = Mahasiswa::all();
    
    //     return view('kelas.edit', compact('kelas', 'dosen', 'mahasiswa'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $kelas = Kelas::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'name' => 'required|string|unique:kelas,name,' . $kelas->id,
    //         'jumlah' => 'required|integer|min:1'
    //     ]);

    //     $kelas->update($validatedData);
    //     return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    // }

    // public function destroy($id)
    // {
    //     $kelas = Kelas::findOrFail($id);
    //     $kelas->delete();
    //     return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    // }

    // // Plotting mahasiswa dan dosen ke kelas
    // public function plot(Request $request, $id)
    // {
    //     $kelas = Kelas::findOrFail($id);
    //     $kelas->dosen()->sync($request->dosen_ids);  // Plotting dosen ke kelas
    //     $kelas->mahasiswa()->sync($request->mahasiswa_ids);  // Plotting mahasiswa ke kelas

    //     return redirect()->route('kelas.index')->with('success', 'Plotting berhasil diperbarui');
    // }
}
