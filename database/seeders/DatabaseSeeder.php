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
        // 1. Pakai updateOrCreate: Kalau email udah ada, lewati. Kalau belum, buat baru.
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Patokan pencarian
            [
                'name' => 'Administrator',
                'password' => bcrypt('admin123'), 
            ]
        );

        // 2. Pakai insertOrIgnore: Biar data kategori nggak dobel kalau di-seed ulang
        \Illuminate\Support\Facades\DB::table('kategoris')->insertOrIgnore([
            ['id_kategori' => 'Fasilitas & Infrastruktur Sekolah'],
            ['id_kategori' => 'Kebersihan Lingkungan'],
            ['id_kategori' => 'Keamanan & Ketertiban'],
            ['id_kategori' => 'Pelayanan Guru / Staf'],
            ['id_kategori' => 'Lain-lain'],
        ]);
    }
}
