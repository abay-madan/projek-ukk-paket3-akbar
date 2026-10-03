<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa; // Panggil model Siswa

class SiswaSeeder extends Seeder
{
    public function run()
    {
        // Siapkan beberapa data siswa dummy
        $data_siswa = [
            [
                'nis' => '10293847', // NIS ini sesuai dengan contoh di form login kamu
                'kelas' => 'XII RPL 1'
            ],
            [
                'nis' => '11223344',
                'kelas' => 'XI TKJ 2'
            ],
            [
                'nis' => '99887766',
                'kelas' => 'X DKV 1'
            ],
            [
                'nis' => '1001', // NIS ini sesuai dengan contoh di form login kamu
                'kelas' => 'XII RPL 1'
            ],
            [
                'nis' => '1002',
                'kelas' => 'XI TKJ 2'
            ],
            [
                'nis' => '1003',
                'kelas' => 'X DKV 1'
            ]
        ];

        // Masukkan data ke database secara otomatis
        foreach ($data_siswa as $siswa) {
            Siswa::updateOrCreate(
                ['nis' => $siswa['nis']], // Cek agar tidak duplikat
                ['kelas' => $siswa['kelas']]
            );
        }
    }
}