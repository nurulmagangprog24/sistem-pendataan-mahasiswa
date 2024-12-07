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
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::prefix('kaprodi')->middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('/kelola-dosen', [KelolaDosenController::class, 'index'])->name('kelola-dosen');
    Route::post('/kelola-dosen/store', [KelolaDosenController::class, 'store'])->name('dosen.store');
    Route::put('/kelola-dosen/{id}/update', [KelolaDosenController::class, 'update'])->name('dosen.update');
    Route::delete('/kelola-dosen/{id}', [KelolaDosenController::class, 'destroy'])->name('dosen.destroy');     
    Route::get('/kelola-kelas', [KelolaKelasController::class, 'index'])->name('kelola-kelas');
    Route::post('/kelola-kelas/store', [KelolaKelasController::class, 'store'])->name('kelas.store');
    Route::put('/kelola-kelas/{id}/update', [KelolaKelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelola-kelas/{id}', [KelolaKelasController::class, 'destroy'])->name('kelas.destroy');     
    Route::post('/kelola-kelas/{kelas}/tambah-mahasiswa', [KelolaKelasController::class, 'addMahasiswa'])->name('kelola-kelas.tambahMahasiswa');
    // Route::delete('/kelola-kelas/{kelas}/hapus/{mahasiswa}', [KelolaKelasController::class, 'hapusMahasiswa'])->name('kelola-kelas.hapusMahasiswa');
    Route::put('/kelola-kelas/{kelas}/pindahkan/{mahasiswa}', [KelolaKelasController::class, 'pindahkanMahasiswa'])->name('kelola-kelas.pindahkanMahasiswa');
    // Route::get('/kelola-mahasiswa', [KelolaMahasiswaController::class, 'index'])->name('kelola-mahasiswa');
});
    
Route::prefix('dosen')->middleware(['auth', 'role:dosen wali'])->group(function () {
    Route::get('/kelas', [KelolaMahasiswaController::class, 'listMhs'])->name('mahasiswa-kelas');
    Route::post('/kelola-mahasiswa/store', [KelolaMahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::put('/kelola-mahasiswa/{id}/update', [KelolaMahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/kelola-mahasiswa/{id}', [KelolaMahasiswaController::class, 'destroy'])->name('mahasiswa.destroy'); 
    Route::delete('/kelola-mahasiswa/{id}/remove', [KelolaMahasiswaController::class, 'removeFromClass'])->name('mahasiswa.remove');   
    Route::get('/requests', [RequestController::class, 'index'])->name('requests-list');
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');
});

Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
});