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
            'dosen_id' => 'exists:dosen,id',
        ]);

        $kelas = Kelas::create([
            'name' => $validatedData['name'],
            'jumlah' => $validatedData['jumlah'],
        ]);

        // Jika dosen_id diisi, update dosen yang dipilih
        if (!empty($validatedData['dosen_id'])) {
            $dosen = Dosen::findOrFail($validatedData['dosen_id']);
            $dosen->update(['kelas_id' => $kelas->id]);
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dibuat');
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

    public function update(Request $request, $id)
    {

        $kelas = Kelas::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:kelas,name,' . $kelas->id,
            'jumlah' => 'required|integer|min:1',
            'dosen_id' => 'exists:dosen,id',
        ]);

        $kelas->update([
            'name' => $validatedData['name'],
            'jumlah' => $validatedData['jumlah'],
        ]);

        // Update kolom kelas_id di tabel dosen
        if (!empty($validatedData['dosen_id'])) {
        // Set dosen sebelumnya yang terkait dengan kelas ini menjadi null
        Dosen::where('kelas_id', $kelas->id)->update(['kelas_id' => null]);
        }

        // Update dosen yang dipilih untuk menjadi dosen kelas ini
        $dosen = Dosen::findOrFail($validatedData['dosen_id']);
        $dosen->update(['kelas_id' => $kelas->id]);

        return redirect()->route('kelola-kelas')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas -> delete();

        return redirect()->route('kelola-kelas')->with('success', 'Kelas berhasil dihapus');
    }

}
