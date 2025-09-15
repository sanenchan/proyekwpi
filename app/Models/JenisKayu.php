<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKayu extends Model
{
    protected $table = 'jenis_kayus';

    // Primary key (opsional, default 'id')
    protected $primaryKey = 'id_jenis_kayu';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'kode_kayu',
        'nama_kayu',
    ];
}
