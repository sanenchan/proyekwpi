<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduksiRotary extends Model
{
    protected static function booted()
    {
        static::saved(function ($detail) {
            $detail->produksiRotary->update([
                'pekerja' => $detail->produksiRotary->detailRotaries()->count()
            ]);
        });

        static::deleted(function ($detail) {
            $detail->produksiRotary->update([
                'pekerja' => $detail->produksiRotary->detailRotaries()->count()
            ]);
        });
    }

    use HasFactory;

    protected $table = 'detail_produksi_rotaries';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_rotary',
        'id_pegawai',
        'potongan_target',
        'jam_mulai',
        'jam_selesai',

    ];
    //  public static function shouldRegisterNavigation(): bool
    // {
    //     return false; // ⛔ jangan daftarkan di sidebar
    // }

    // 🔗 Relasi ke ProduksiRotary
    public function produksiRotary()
    {
        return $this->belongsTo(Produksi_Rotary::class, 'id_rotary', 'id_rotary');
    }

    // 🔗 Relasi ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

}
