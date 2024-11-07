<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaDosenController;
use App\Http\Controllers\KelolaKelasController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('components.layout');
// });

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
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/kaprodi', [DashboardController::class, 'dashboardKaprodi'])->middleware('RoleMiddleware:kaprodi');
    Route::get('/dashboard/dosen', [DashboardController::class, 'dashboardDosen'])->middleware('RoleMiddleware:dosen wali');
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->middleware('RoleMiddleware:mahasiswa');
    Route::get('/logout', [LoginController::class, 'logout']);
});

// Route::get('/kelola-dosen', [KelolaDosenController::class, 'showKelolaDosen'])->name('kelola-dosen');
// Route::get('/kelola-kelas', [KelolaKelasController::class, 'kelasList'])->name('kelola-kelas');

// Route::post('/kaprodi/dosen', [KelolaDosenController::class, 'createDosen'])->name('tambah-dosen');

Route::get('/kelola-dosen', [KelolaDosenController::class, 'index'])->name('kelola-dosen');
Route::get('/kelola-kelas', [KelolaKelasController::class, 'index'])->name('kelola-kelas');

// Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::resource('dosen', KelolaDosenController::class);
    Route::resource('kelas', KelolaKelasController::class);
// });



// Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::resource('kelas', KelolaKelasController::class);
    Route::post('kelas/{id}/plot', [KelolaKelasController::class, 'plot'])->name('kelas.plot');
// });


// Route::group(['middleware' => ['auth', 'role:kaprodi']], function () {
//     // Rute untuk Kaprodi
// });

// Route::group(['middleware' => ['auth', 'role:dosen']], function () {
//     // Rute untuk Dosen
// });

// Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
//     // Rute untuk Mahasiswa
// });

