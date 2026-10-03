<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasis';
    protected $primaryKey = 'id_pelaporan'; // Typo prmarykey dari aslinya sudah dibetulkan
    public $incrementing = false;
    protected $keyType = 'int';
    
    // Tambahkan 'foto' di paling ujung
    protected $fillable =  ['id_pelaporan','nis','id_kategori','lokasi','ket', 'foto'];
}