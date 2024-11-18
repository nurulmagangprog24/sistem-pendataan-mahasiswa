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
use App\Http\Controllers\DosenController;


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
Route::resource('kelas', KelolaKelasController::class);
Route::resource('dosen', KelolaDosenController::class);
Route::resource('mahasiswa', KelolaMahasiswaController::class);

Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('/kelola-dosen', [KelolaDosenController::class, 'dosenList'])->name('kelola-dosen');
    Route::get('/kelola-kelas', [KelolaKelasController::class, 'kelasList'])->name('kelola-kelas');
    Route::get('/kelola-mahasiswa', [KelolaMahasiswaController::class, 'index'])->name('kelola-mahasiswa');
});
    
Route::middleware(['auth', 'role:dosen wali'])->group(function () {
    Route::get('/daftar-mahasiswa', [KelolaMahasiswaController::class, 'listMhs'])->name('daftar-mahasiswa');
    Route::get('/requests', [RequestController::class, 'index'])->name('requests-list');
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'showProfileMhs'])->name('profile-mhs');
    Route::post('/request/store', [RequestController::class, 'storeRequest'])->name('request.store');
    Route::get('/profile/edit', [ProfileController::class, 'editProfilMhs'])->name('profile-mhs.edit');
    Route::put('/profile', [ProfileController::class, 'updateProfilMhs'])->name('profile.update');
});



// Route::group(['middleware' => ['auth', 'role:kaprodi']], function () {
//     // Rute untuk Kaprodi
// });

// Route::group(['middleware' => ['auth', 'role:dosen']], function () {
//     // Rute untuk Dosen
// });

// Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
//     // Rute untuk Mahasiswa
// });