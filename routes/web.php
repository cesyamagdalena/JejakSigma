<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/proses-login', [AuthController::class, 'login']);
Route::post('/proses-register', [AuthController::class, 'register']);

// TAMBAHKAN BARIS INI
Route::post('/logout', [AuthController::class, 'logout']);

// BARU: Tambahan Route agar halaman /dashboard tidak 404
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/catat-perjalanan', function () {
    return view('catatperjalanan');
});