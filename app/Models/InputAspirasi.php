<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasis';
    protected $prmarykey = 'id_pelaporan';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable =  ['id_pelaporan','nis','id_kategori','lokasi','ket'];
}
