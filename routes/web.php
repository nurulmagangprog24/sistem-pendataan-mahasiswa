<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layout');
});

Route::get('/kaprodi-dosen', function () {
    return view('kaprodi.dosen');
});

Route::get('/kaprodi-kelas', function () {
    return view('kaprodi.kelas');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/plot', function () {
    return view('kaprodi.plot-kelas');
});