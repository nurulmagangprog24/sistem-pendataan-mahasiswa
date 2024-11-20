<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Dapatkan data user yang login
        $dosen = Dosen::where('user_id', $user->id)->first(); // Ambil data dosen berdasarkan user

        if (!$dosen) {
            abort(403, 'Unauthorized action.');
        }

        $requests = RequestEdit::where('kelas_id', $dosen->kelas_id)
                        ->with('mahasiswa', 'kelas') // Load relasi mahasiswa dan kelas
                        ->get();

        return view('dosen.requests-list', compact('requests'));
    }

}
