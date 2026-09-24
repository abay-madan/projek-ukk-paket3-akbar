<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    // 1. Paksa Laravel untuk pakai tabel 'aspirasis' (sesuaikan dengan nama di phpMyAdmin)
    protected $table = 'aspirasis'; 

    // 2. Kasih tahu Laravel kalau primary key-nya adalah id_aspirasi, bukan id
    protected $primaryKey = 'id_aspirasi';

    // 3. Wajib tambahkan ini biar fungsi updateOrCreate di Controller diizinkan menyimpan data
    protected $fillable = [
        'id_aspirasi', 
        'status', 
        'id_kategori', 
        'feedback'
    ];
}