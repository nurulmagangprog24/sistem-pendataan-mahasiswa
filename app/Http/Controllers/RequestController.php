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

    public function approveRequest($requestId)
    {
        $request = Request::findOrFail($requestId);
        $mahasiswa = $request->mahasiswa;
        $mahasiswa->update(['edit' => true]);

        return redirect()->route('request.index')->with('success', 'Student request approved.');
    }
    
}
