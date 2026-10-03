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
    }
}