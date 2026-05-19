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
Route::post('/logout', [AuthController::class, 'logout']);

// Halaman utama Dashboard (Tabel & Grafik)
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Halaman Khusus Catat Perjalanan (Form Input)
Route::get('/catat-perjalanan', function () {
    return view('catat-perjalanan');
});