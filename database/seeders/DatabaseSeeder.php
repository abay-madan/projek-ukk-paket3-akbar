<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seeder User / Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], 
            [
                'name' => 'Administrator',
                'password' => bcrypt('admin123'), 
            ]
        );

        // 2. Seeder Kategori
        DB::table('kategoris')->insertOrIgnore([
            ['id_kategori' => 1, 'ket_kategori' => 'Fasilitas & Infrastruktur'], // Disingkat agar tidak lewat 30 huruf
            ['id_kategori' => 2, 'ket_kategori' => 'Kebersihan Lingkungan'],
            ['id_kategori' => 3, 'ket_kategori' => 'Keamanan & Ketertiban'],
            ['id_kategori' => 4, 'ket_kategori' => 'Pelayanan Guru / Staf'],
            ['id_kategori' => 5, 'ket_kategori' => 'Lain-lain'],
        ]);
    }
}