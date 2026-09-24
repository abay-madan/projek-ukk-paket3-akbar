<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primarykey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['id_kategori','ket_kategori'];
}
