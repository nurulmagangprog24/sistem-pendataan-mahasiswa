<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('components.layout');
// });

// Route::get('/register', [RegisterController::class, 'register'])->name('register');
// Route::post('/register-proses', [RegisterController::class, 'register_proses'])->name('register-proses');

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

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register-proses', [LoginController::class, 'validasiRegister']);

// Route::get('/create', [DosenController::class, 'create'])->name('create');

// Route::get('/', function () {
//     return view('authlogin');
// });
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::group(['middleware' => ['auth', 'role:kaprodi']], function () {
//     // Rute untuk Kaprodi
// });

// Route::group(['middleware' => ['auth', 'role:dosen']], function () {
//     // Rute untuk Dosen
// });

// Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
//     // Rute untuk Mahasiswa
// });

// Route::get('/dashboard', function () {
//     // Hanya kaprodi yang bisa mengakses route ini
// })->middleware('role:kaprodi');
