<?php

namespace App\Http\Controllers;

use App\Models\RequestEdit;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        RequestEdit::create([
            'kelas_id' => $request->kelas_id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Request edit telah dikirim ke dosen.');
    }
}
