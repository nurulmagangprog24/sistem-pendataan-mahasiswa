<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfileMhs() {

        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.profile', compact('mahasiswa'));
    }
}
