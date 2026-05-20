<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==========================================
// ROUTES UNTUK USER YANG BELUM LOGIN (GUEST)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/proses-login', [AuthController::class, 'login'])->name('proses.login');
    Route::post('/proses-register', [AuthController::class, 'register'])->name('proses.register');
});

// ==========================================
// ROUTES UNTUK USER YANG SUDAH LOGIN (AUTH)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Dashboard (Tabel & Grafik)
    Route::get('/dashboard', function () {
        // 1. AMBIL DATA ASLI DARI DATABASE (Hanya milik user yang sedang login)
        $catatanPerjalanan = DB::table('travels')
            ->where('user_id', Auth::id())
            ->get();

        // 2. KIRIM DATA KE VIEW DASHBOARD
        return view('dashboard', compact('catatanPerjalanan'));
    })->name('dashboard');

    Route::get('/catat-perjalanan', function () {
        return view('catat-perjalanan');
    })->name('catat.perjalanan');


// 1. PROSES SIMPAN DATA BARU (Dari halaman Catat Perjalanan)
    Route::post('/travel', function (Request $request) {
    // 1. Validasi cukup menggunakan 'date'
    $request->validate([
        'tanggal' => 'required|date',
        'lokasi'  => 'required|string',
        'jarak'   => 'required|numeric',
        'waktu'   => 'required|string',
    ], [
        // Ubah pesan errornya agar lebih sesuai dengan input saat ini
        'tanggal.date' => 'Pilih tanggal dari kalender yang disediakan.',
        'tanggal.required' => 'Tanggal wajib diisi.',
    ]);

    // 2. Langsung simpan ke database TANPA konversi Carbon lagi
    DB::table('travels')->insert([
        'user_id'    => Auth::id(),
        'tanggal'    => $request->tanggal, // Langsung masukkan variabel ini
        'lokasi'     => $request->lokasi,
        'jarak'      => $request->jarak,
        'waktu'      => $request->waktu,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Data perjalanan berhasil ditambahkan!');
})->name('travel.store');

    // 2. PROSES UPDATE DATA (Dari Modal Edit di Dashboard)
    Route::put('/travel/{id}', function (Request $request, $id) {
        $request->validate([
            'tanggal' => 'required|date',    // Memastikan format YYYY-MM-DD aman untuk database saat edit
            'lokasi'  => 'required|string',
            'jarak'   => 'required|numeric',
            'waktu'   => 'required|string',
        ]);

        // UPDATE DATABASE
        DB::table('travels')
            ->where('id', $id)
            ->where('user_id', Auth::id()) // Memastikan hanya bisa edit data milik sendiri
            ->update([
                'tanggal'    => $request->tanggal,
                'lokasi'     => $request->lokasi,
                'jarak'      => $request->jarak,
                'waktu'      => $request->waktu,
                'updated_at' => now(),
            ]);

        return redirect()->route('dashboard')->with('success', 'Data perjalanan berhasil diperbarui!');
    })->name('travel.update');

    // 3. PROSES HAPUS DATA
    Route::delete('/travel/{id}', function ($id) {
        DB::table('travels')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('dashboard')->with('success', 'Data perjalanan berhasil dihapus!');
    })->name('travel.destroy');
    
});