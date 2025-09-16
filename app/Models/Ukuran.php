<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $table = 'ukurans';

    // Primary key (opsional, default 'id')
    protected $primaryKey = 'id_ukuran';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'panjang',
        'tinggi',
        'tebal'
    ];
}
