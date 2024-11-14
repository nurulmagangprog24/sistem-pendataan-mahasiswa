<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaDosenController;
use App\Http\Controllers\KelolaKelasController;
use App\Http\Controllers\KelolaMahasiswaController;


Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'validasiRegister']);

Route::middleware(['guest'])->group(function() {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'validasiLogin']);
});
Route::get('/home', function() {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('/kelola-dosen', [KelolaDosenController::class, 'showKelolaDosen'])->name('kelola-dosen');
Route::get('/kelola-kelas', [KelolaKelasController::class, 'kelasList'])->name('kelola-kelas');

Route::resource('kelas', KelolaKelasController::class);
Route::resource('dosen', KelolaDosenController::class);

Route::get('/kelola-mahasiswa', [KelolaMahasiswaController::class, 'index']);
Route::resource('mahasiswa', KelolaMahasiswaController::class);


Route::get('/kelola-mahasiswa', [KelolaMahasiswaController::class, 'index'])->name('kelola-mahasiswa');

        
Route::get('/profil', [ProfileController::class, 'showProfileMhs'])->name('profile-mhs');
Route::post('/request/edit', [RequestController::class, 'store'])->name('request.edit');

// Route::group(['middleware' => ['auth', 'role:kaprodi']], function () {
//     // Rute untuk Kaprodi
// });

// Route::group(['middleware' => ['auth', 'role:dosen']], function () {
//     // Rute untuk Dosen
// });

// Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
//     // Rute untuk Mahasiswa
// });