<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; // Penting untuk proses login

class AuthController extends Controller
{
    // 1. FUNGSI UNTUK REGISTER
    public function register(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 2. Simpan ke database
        \App\Models\User::create([
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 3. Alihkan halaman setelah sukses (misal ke halaman login)
        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }

    // 2. FUNGSI UNTUK LOGIN (Pastikan nama 'login' huruf kecil semua)
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // UBAH BAGIAN INI: Arahkan langsung ke halaman dashboard baru
        return redirect('/dashboard'); 
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    // 3. FUNGSI UNTUK LOGOUT
    public function logout(Request $request)
        {
            // 1. Keluarkan pengguna dari sistem auth Laravel
            Auth::logout();

            // 2. Hancurkan session lama agar aman
            $request->session()->invalidate();

            // 3. Buat ulang token CSRF yang baru
            $request->session()->regenerateToken();

            // 4. Lempar kembali ke halaman utama ('/')
            return redirect('/');
        }
}