<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('components.layout');
});

// Route::get('/register', [RegisterController::class, 'register'])->name('register');
// Route::post('/register-proses', [RegisterController::class, 'register_proses'])->name('register-proses');

// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/create', [DosenController::class, 'create'])->name('create');

// Route::get('/', function () {
//     return view('authlogin');
// });
// Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
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
