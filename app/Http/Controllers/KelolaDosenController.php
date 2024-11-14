<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaDosenController extends Controller
{
    function showKelolaDosen() {
        $dosen = Dosen::with('kelas')->get();
        $kelas = Kelas::whereDoesntHave('dosen')->get();
        return view('kaprodi.kelola-dosen', compact('dosen', 'kelas'));
    }

    // public function createDosen(Request $request) {
    //     // Validasi data
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'kelas_id' => 'required|exists:kelas,id',
    //         'kode_dosen' => 'required|unique:dosen,kode_dosen',
    //         'nip' => 'required|unique:dosen,nip',
    //         'name' => 'required|string|max:255',
    //     ]);

    //     // // Simpan data dosen
    //     // Dosen::create([
    //     //     'kode_dosen' => $request->kode_dosen,
    //     //     'nip' => $request->nip,
    //     //     'name' => $request->name,
    //     // ]);
    //     Dosen::create($request->all());

    //     // Redirect atau response sesuai kebutuhan
    //     return redirect()->back()->with('success', 'Data Dosen berhasil ditambahkan');
    // }
    

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'kelas_id' => 'nullable|exists:kelas,id',
    //         'kode_dosen' => 'required|unique:dosen,kode_dosen',
    //         'nip' => 'required|unique:dosen,nip',
    //         'name' => 'required|string'
    //     ]);

    //     Dosen::create($validatedData);
    //     return redirect()->route('kelola-dosen')->with('success', 'Dosen berhasil ditambahkan');
    // }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        $kelas = Kelas::all();
        return view('kaprodi.kelola-dosen', compact('dosen', 'kelas'));
    }

    public function update(Request $request, $id) {
      $validatedData = $request->validate([
           'kelas_id' => 'nullable|exists:kelas,id',
           'kode_dosen' => 'required|unique:dosen,kode_dosen,' . $id,
           'nip' => 'required|unique:dosen,nip,' . $id,
           'name' => 'required|string'
       ]);
        
       $dosen = Dosen::findOrFail($id);
       $dosen->update($validatedData);
       $dosen->save();
         
       return redirect()->route('kelola-dosen')->with('success', 'Data dosen berhasil diperbarui');
    }

    // public function destroy($id)
    // {
    //     $dosen = Dosen::findOrFail($id);
    //     $dosen->delete();
    //     return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus');
    // }
}
