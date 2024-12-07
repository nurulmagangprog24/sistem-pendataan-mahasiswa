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
    function index()
    {
        $role = Auth::user()->role;

        if ($role == 'kaprodi') {
            $jumlahDosen = Dosen::count();
            $jumlahKelas = Kelas::count();
            return view('dashboard.kaprodi', compact('jumlahDosen', 'jumlahKelas'));
        } elseif ($role == 'dosen wali') {
            $dosenId = auth()->user()->dosen->id; // ID dosen dari user yang login

            // Inisialisasi default nilai
            $jumlahMahasiswa = 0;
            $jumlahPermintaan = 0;

            // Cari kelas yang diampu dosen
            $kelas = Dosen::findOrFail($dosenId)->kelas;

            if ($kelas) {
                // Hitung mahasiswa di kelas tersebut
                $jumlahMahasiswa = $kelas->mahasiswa->count();

                // Hitung jumlah permintaan perubahan data dari mahasiswa di kelas tersebut
                $jumlahPermintaan = $kelas->mahasiswa()
                    ->whereHas('requests') // Pastikan mahasiswa memiliki permintaan
                    ->count();
            }

            return view('dashboard.dosen', compact('jumlahMahasiswa', 'jumlahPermintaan'));
        } elseif ($role == 'mahasiswa') {
            $mahasiswa = auth()->user()->mahasiswa;
            $request = RequestEdit::where('mahasiswa_id', $mahasiswa->id)->first();

            if (!$request && !$mahasiswa->edit) {
                $status = 'Tidak Ada Permintaan'; 
            } elseif ($request) {
                $status = 'Menunggu';
            } elseif ($mahasiswa->edit) {
                $status = 'Disetujui';
            } else {
                $status = 'Ditolak'; 
            }

            return view('dashboard.mahasiswa', ['username' => Auth::user()->username, 'status' => $status]);
        }

        return abort(403, 'Unauthorized');
    }
}
