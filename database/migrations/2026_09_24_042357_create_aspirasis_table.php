<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->integer('id_aspirasi')->primary(); 
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']); 
            $table->integer('id_kategori');            
            $table->integer('feedback');               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};

// php artisan make:model Admin
// php artisan make:model Siswa
// php artisan make:model Kategori
// php artisan make:model InputAspirasi
// php artisan make:model Aspirasi