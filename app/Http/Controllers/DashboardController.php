<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
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
            // $mahasiswaBimbingan = Mahasiswa::where('dosen_wali_id', Auth::id())->count();
            // $permintaanData = Permintaan::where('dosen_id', Auth::id())->count();
            return view('dashboard.dosen');
        } elseif ($role == 'mahasiswa') {
            return view('dashboard.mahasiswa', ['username' => Auth::user()->username]);
        }

        return abort(403, 'Unauthorized');

    }
}
