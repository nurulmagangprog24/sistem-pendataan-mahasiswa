<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelolaDosenController extends Controller
{
    public function index() {
        $dosen = Dosen::with('kelas')->get();
        $kelas = Kelas::whereDoesntHave('dosen')->get();
        return view('kaprodi.kelola-dosen', compact('dosen', 'kelas'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'kode_dosen' => 'required|integer|unique:dosen,kode_dosen',
            'nip' => 'required|integer|unique:dosen,nip',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        // Proses penyimpanan data
        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'dosen wali',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'kelas_id' => $request->kelas_id ?? null,
                'kode_dosen' => $request->kode_dosen,
                'nip' => $request->nip,
                'name' => $request->username,
            ]);
        });

        return redirect()->route('kelola-dosen')->with('success', 'Dosen berhasil ditambahkan');
    }
    

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

        $user = $dosen->user;
        $user->update([
            'username' => $validatedData['name'],
        ]);
         
       return redirect()->route('kelola-dosen')->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        
        $user->delete();
        $dosen->delete();

        return redirect()->route('kelola-dosen')->with('success', 'Data dosen berhasil dihapus');

    }
}
