<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $table = 'lahans';

    // Primary key (opsional, default 'id')
    protected $primaryKey = 'id_lahan';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'kode_lahan',
        'nama_lahan',
    ];

}
