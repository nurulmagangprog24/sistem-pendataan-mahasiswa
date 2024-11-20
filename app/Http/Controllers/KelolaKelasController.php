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
        $dosen = Dosen::whereDoesntHave('kelas')->get();
        $kelas = Kelas::with('dosen', 'mahasiswa')->withCount('mahasiswa')->get();
        $availableMahasiswa = Mahasiswa::whereNull('kelas_id')->get();
        
        $mahasiswa = []; 
    
        // Ambil data mahasiswa untuk semua kelas (opsional)
        foreach ($kelas as $item) {
            $mahasiswa[$item->id] = $item->mahasiswa()->get(); // Ambil mahasiswa berdasarkan kelas
        }
        return view('kaprodi.kelola-kelas', compact('dosen', 'kelas', 'mahasiswa', 'availableMahasiswa'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:kelas,name',
            'jumlah' => 'required|integer|min:1',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        Kelas::create($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function addMahasiswa(Request $request, Kelas $kelas)
    {
        // $request->validate([
        //     'mahasiswa_id' => 'required|exists:mahasiswa,id',
        // ]);

        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->kelas_id = $kelas->id;
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
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
