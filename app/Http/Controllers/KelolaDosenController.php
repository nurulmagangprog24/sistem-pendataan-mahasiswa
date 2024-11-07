<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelolaDosenController extends Controller
{
    // function showKelolaDosen() {
    //     return view('kaprodi.kelola-dosen');
    // }

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

    public function index()
    {
        $dosen = Dosen::with('user', 'kelas')->get();
        $kelas = Kelas::all();
        return view('kaprodi.kelola-dosen', compact('dosen', 'kelas'));
    }

    // public function create()
    // {
    //     $kelas = Kelas::all();
    //     return view('dosen.create', compact('kelas'));
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
            'kode_dosen' => 'required|unique:dosen,kode_dosen',
            'nip' => 'required|unique:dosen,nip',
            'name' => 'required|string'
        ]);

        Dosen::create($validatedData);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    // public function edit($id)
    // {
    //     $dosen = Dosen::findOrFail($id);
    //     $kelas = Kelas::all();
    //     return view('dosen.edit', compact('dosen', 'kelas'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $dosen = Dosen::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'kelas_id' => 'required|exists:kelas,id',
    //         'kode_dosen' => 'required|unique:dosen,kode_dosen,' . $dosen->id,
    //         'nip' => 'required|unique:dosen,nip,' . $dosen->id,
    //         'name' => 'required|string'
    //     ]);

    //     $dosen->update($validatedData);
    //     return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    // }

    // public function destroy($id)
    // {
    //     $dosen = Dosen::findOrFail($id);
    //     $dosen->delete();
    //     return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus');
    // }
}
