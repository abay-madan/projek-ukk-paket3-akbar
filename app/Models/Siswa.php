<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $primarykey = 'nis';
    public $incrementing = false ; # ini untuk yang bukan auto-increment
    protected $keyType = 'int' ;
    protected $fillable = ['nis', 'kelas'];
}
