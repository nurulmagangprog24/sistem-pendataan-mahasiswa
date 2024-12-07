<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelolaMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();

        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function listMhs()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();

        $dosen = auth()->user()->dosen;
        $kelasDosen = $dosen->kelas;
        $mahasiswa = $kelasDosen ? $kelasDosen->mahasiswa : collect();

        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelasDosen', 'kelas'));
    }


    public function store(Request $request)
    {
        $kelas = Kelas::findOrFail($request->kelas_id);

        // Hitung jumlah mahasiswa dalam kelas
        $jumlahMahasiswa = $kelas->mahasiswa()->count();

        if ($jumlahMahasiswa >= $kelas->jumlah) {
            return redirect()->back()->with('error', 'Kelas sudah penuh. Tidak dapat menambahkan mahasiswa baru.');
        }

        // Validasi data
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nim' => 'required|integer|unique:mahasiswa,nim',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        // Proses penyimpanan data
        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'kelas_id' => $request->kelas_id ?? null,
                'nim' => $request->nim,
                'name' => $request->username,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);
        });

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('dosen.kelola-mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
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
            if ($kelas->mahasiswa()->count() >= $kelas->jumlah) {
                return redirect()->back()->withErrors(['msg' => 'Jumlah mahasiswa di kelas ini telah mencapai batas maksimal.']);
            }
        }

        $mahasiswa->update($validatedData);
        $mahasiswa->save();

        return redirect()->route('mahasiswa-kelas')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $user->delete();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa-kelas')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function removeFromClass($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        // Pastikan mahasiswa memiliki kelas yang terhubung
        if (!$mahasiswa->kelas_id) {
            return redirect()->back()->with('error', 'Mahasiswa ini tidak terdaftar di kelas mana pun.');
        }

        // Set kelas_id menjadi null untuk mengeluarkan mahasiswa dari kelas
        $mahasiswa->kelas_id = null;
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Mahasiswa berhasil dikeluarkan dari kelas.');
    }
}
