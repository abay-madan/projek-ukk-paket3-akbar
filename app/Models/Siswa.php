<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
<<<<<<< HEAD
    protected $primaryKey = 'nis'; 
    public $incrementing = false; // Matikan auto-increment karena NIS diketik manual
    protected $keyType = 'integer'; // Tipe data NIS adalah integer[cite: 4]
    
    protected $fillable = ['nis', 'kelas']; // Sesuai kolom di ERD[cite: 4]
}
=======
    protected $primarykey = 'nis';
    public $incrementing = false ; # ini untuk yang bukan auto-increment
    protected $keyType = 'int' ;
    protected $fillable = ['nis', 'kelas'];
}
>>>>>>> 3ed1c5f4c0b6f6827a0d43741efb858363b977b8
