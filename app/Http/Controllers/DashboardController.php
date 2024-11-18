<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index() {
        $role = Auth::user()->role;

        if ($role == 'kaprodi') {
            $jumlahDosen = Dosen::count();
            $jumlahKelas = Kelas::count();
            return view('dashboard.kaprodi', compact('jumlahDosen', 'jumlahKelas'));
        } elseif ($role == 'dosen wali') {
            $dosenId = auth()->user()->dosen->id; // ID dosen dari user yang login

            // Cari kelas yang diampu dosen
            $kelas = Dosen::findOrFail($dosenId)->kelas;

            // Hitung mahasiswa di kelas tersebut
            $jumlahMahasiswa = $kelas->mahasiswa->count();

            // Hitung jumlah permintaan perubahan data dari mahasiswa di kelas tersebut
            $jumlahPermintaan = $kelas->mahasiswa()
            ->whereHas('requests') // Pastikan mahasiswa memiliki permintaan
            ->count();
            return view('dashboard.dosen', compact('jumlahMahasiswa', 'jumlahPermintaan'));
        } elseif ($role == 'mahasiswa') {
            return view('dashboard.mahasiswa', ['username' => Auth::user()->username]);
        }

        return abort(403, 'Unauthorized');

    }
}
