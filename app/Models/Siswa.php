<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $primaryKey = 'nis'; 
    public $incrementing = false; // Matikan auto-increment karena NIS diketik manual
    protected $keyType = 'integer'; // Tipe data NIS adalah integer[cite: 4]
    
    protected $fillable = ['nis', 'kelas']; // Sesuai kolom di ERD[cite: 4]
}