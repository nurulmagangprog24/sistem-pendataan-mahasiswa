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
        return view('dashboard.index');
    }
    
    function dashboardKaprodi() {
        $jumlahDosen = Dosen::count();
        $jumlahKelas = Kelas::count();

        Log::info('Fungsi kaprodi dijalankan', ['jumlahDosen' => $jumlahDosen, 'jumlahKelas' => $jumlahKelas]);
        
        return view('dashboard.index', compact('jumlahDosen', 'jumlahKelas'));
    }







    function dashboardDosen() {
        return view('dashboard.index');
    }

    function dashboardMahasiswa() {
        return view('dashboard.index');
    }

}
