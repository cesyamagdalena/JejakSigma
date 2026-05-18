<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jika Anda ingin mengaktifkan ini nanti, pastikan UserFactory juga sudah diupdate (lihat catatan di bawah)
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'nik' => '3171234567890123', // Tambahkan field nik di sini (sesuaikan panjang karakter dengan aturan database Anda)
        ]);
    }
}