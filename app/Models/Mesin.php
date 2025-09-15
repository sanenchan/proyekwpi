<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

    // Jika primary key bukan "id", sesuaikan
    protected $primaryKey = 'id_mesin';

    // Mass assignable
    protected $fillable = [
        'nama_mesin',
        'lokasi',
        'id_kategori_mesin', // relasi ke KategoriMesin
        'keterangan',
    ];

    // Relasi ke kategori mesin
    public function kategori()
    {
        return $this->belongsTo(KategoriMesin::class, 'id_kategori_mesin');
    }
}
