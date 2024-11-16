<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    // public function createRequest()
    // {
    //     $mahasiswa = auth()->user()->mahasiswa;
    //     $kelas = $mahasiswa->kelas; 
    //     return view('mahasiswa.profile', compact('kelas', 'mahasiswa')); // Blade view for request creation
    // }

    public function index()
    {
        // Mendapatkan dosen saat ini
        $dosen = auth()->user()->dosen;

        // Mendapatkan permintaan dari mahasiswa di kelas dosen
        $requests = RequestEdit::with('mahasiswa', 'kelas')
                ->where('kelas_id', $dosen->kelas_id)
                ->get();

        return view('dosen.requests-list', compact('requests'));
    }


    public function storeRequest(Request $request)
    {
        $data = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'keterangan' => 'required|string|max:255',
        ]);

        RequestEdit::create([
            'kelas_id' => $data['kelas_id'],
            'keterangan' => $data['keterangan'],
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
        ]);

        return redirect()->back()->with('success', 'Request sent to advisor.');
    }

    public function approve($id)
    {
        // Temukan permintaan
        $request = RequestEdit::findOrFail($id);

        // Set mahasiswa `edit` menjadi true
        $mahasiswa = $request->mahasiswa;
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Hapus permintaan setelah disetujui
        $request->delete();

        return redirect()->route('requests-list')->with('success', 'Permintaan berhasil disetujui. Mahasiswa dapat mengedit datanya.');
    }

    
}
