<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestController extends Controller
{
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


    public function store(Request $request)
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

        return redirect()->back()->with('success', 'Permintaan edit berhasil dikirim.');
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

    public function reject($id)
    {
        $request = RequestEdit::findOrFail($id);

        $request->delete();

        // session()->flash('request_rejected', 'Permintaan edit data Anda telah ditolak.');

        // Beri respons sukses
        return redirect()->back()->with('success', 'Request berhasil ditolak.');
    }

    
}
