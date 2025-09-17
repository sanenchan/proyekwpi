<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class Produksi_Rotary extends Model
{
    use HasFactory;

    protected $table = 'produksi_rotaries';
    protected $primaryKey = 'id_rotary'; // sesuai migrasi
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tanggal_produksi',
        'id_target',
        'id_lahan',
        'hasilkw1',
        'hasilkw2',
        'hasilkw3',
        'hasilkw4',
        'kubikasi',
        'total',
        'jam_kerja_mulai',
        'jam_kerja_selesai',
        'pekerja',
        'target_produksi',
        'capaian_produksi',
        'status_produksi',
        'potongan_target',
        'kendala',
        'status_data',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            // Muat relasi yang diperlukan
            $model->loadMissing('detailRotaries', 'target.ukuranModel');

            // Hitung capaian produksi
            $model->capaian_produksi = ($model->hasilkw1 ?? 0)
                + ($model->hasilkw2 ?? 0)
                + ($model->hasilkw3 ?? 0)
                + ($model->hasilkw4 ?? 0);

            // kubikasi (oke)
            // pastikan relasi target dan ukuranModel sudah dimuat
            $model->loadMissing('target.ukuranModel', 'detailRotaries');

            $ukuran = $model->target?->ukuranModel; // pakai nama baru
            $panjang = $ukuran?->panjang;
            $tinggi = $ukuran?->tinggi;
            $tebal = $ukuran?->tebal;

            $model->capaian_produksi = ($model->hasilkw1 ?? 0)
                + ($model->hasilkw2 ?? 0)
                + ($model->hasilkw3 ?? 0)
                + ($model->hasilkw4 ?? 0);

            if ($ukuran) {
                $model->kubikasi = round(
                    ($panjang * $tinggi * $tebal * $model->capaian_produksi) / 1000000,
                    3
                );
            }

            // Hitung jumlah pekerja
            static::saved(function ($model) {
                $model->loadMissing('detailRotaries');
                $model->pekerja = $model->detailRotaries->count();
                $model->saveQuietly(); // update tanpa memicu loop event
            });
            // Hitung target produksi berdasarkan durasi kerja
            if ($model->target) {
                $durasiJam = 0;

                if (!empty($model->jam_kerja_mulai) && !empty($model->jam_kerja_selesai)) {
                    $start = strtotime($model->jam_kerja_mulai);
                    $end = strtotime($model->jam_kerja_selesai);
                    if ($start !== false && $end !== false && $end > $start) {
                        $durasiJam = ($end - $start) / 3600;
                    }
                }

                $targetPerPekerja = $model->target->target ?? 0;
                $model->target_produksi = $targetPerPekerja * $model->pekerja * $durasiJam;
            }

            // Hitung status produksi dan potongan target
            $model->status_produksi = $model->capaian_produksi - ($model->target_produksi ?? 0);
            $model->potongan_target = ($model->status_produksi < 0 && $model->target)
                ? abs($model->status_produksi) * ($model->target->potongan ?? 0)
                : 0;

            // Debug data sebelum disimpan
            // dd($model->toArray());
        });
    }
    // 🔗 Relasi ke Target
    public function target()
    {
        return $this->belongsTo(Target::class, 'id_target', 'id_target');
    }

    // 🔗 Relasi ke Lahan
    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'id_lahan', 'id_lahan');
    }

    // 🔗 Relasi ke detail produksi (1 -> banyak)
    public function detailRotaries()
    {
        return $this->hasMany(DetailProduksiRotary::class, 'id_rotary', 'id_rotary');
    }


}

// protected static function boot()
// {
//     parent::boot();

//     static::saving(function ($model) {
//         // 1. capaian produksi
//         $model->capaian_produksi = ($model->hasilkw1 ?? 0)
//             + ($model->hasilkw2 ?? 0)
//             + ($model->hasilkw3 ?? 0)
//             + ($model->hasilkw4 ?? 0);

//         // 2. kubikasi
//         if ($model->target && $model->target->ukuran) {
//             $u = $model->target->ukuran;
//             $model->kubikasi = round(
//                 ($u->panjang * $u->lebar * $u->tebal * $model->capaian_produksi) / 1000000,
//                 3
//             );
//         }

//         // 3. pekerja
//         $model->pekerja = $model->detailRotaries->count();

//         // 4. target produksi
//         if ($model->target) {
//             $durasiJam = 0;
//             if ($model->jam_kerja_mulai && $model->jam_kerja_selesai) {
//                 $durasiJam = (strtotime($model->jam_kerja_selesai) - strtotime($model->jam_kerja_mulai)) / 3600;
//             }
//             $model->target_produksi = ($model->target->target ?? 0) * $model->pekerja * $durasiJam;
//         }

//         // 5. status produksi
//         $model->status_produksi = $model->capaian_produksi - ($model->target_produksi ?? 0);

//         // 6. potongan produksi
//         $model->potongan_target = ($model->status_produksi < 0 && $model->target)
//             ? abs($model->status_produksi) * ($model->target->potongan ?? 0)
//             : 0;
//     });
// }


// protected static function boot()
// {
//     parent::boot();
//     static::saving(function ($model) {

//         $model->loadMissing('detailRotaries');

//         // capaian produksi (oke)
//         $model->capaian_produksi = ($model->hasilkw1 ?? 0)
//             + ($model->hasilkw2 ?? 0)
//             + ($model->hasilkw3 ?? 0)
//             + ($model->hasilkw4 ?? 0);


//         // kubikasi (oke)
//         // pastikan relasi target dan ukuranModel sudah dimuat
//         $model->loadMissing('target.ukuranModel', 'detailRotaries');

//         $ukuran = $model->target?->ukuranModel; // pakai nama baru
//         $panjang = $ukuran?->panjang;
//         $tinggi = $ukuran?->tinggi;
//         $tebal = $ukuran?->tebal;

//         $model->capaian_produksi = ($model->hasilkw1 ?? 0)
//             + ($model->hasilkw2 ?? 0)
//             + ($model->hasilkw3 ?? 0)
//             + ($model->hasilkw4 ?? 0);

//         if ($ukuran) {
//             $model->kubikasi = round(
//                 ($panjang * $tinggi * $tebal * $model->capaian_produksi) / 1000000,
//                 3
//             );
//         }

//         // pekerja(belum bisa ngitung)
//         $model->pekerja = $model->detailRotaries()->count();
//         $model->pekerja = $model->detailRotaries->count();


//         // target produksi (belum bisa ngitung)
//         if ($model->target) {
//             $durasiJam = 0;

//             if (!empty($model->jam_kerja_mulai) && !empty($model->jam_kerja_selesai)) {
//                 $start = strtotime($model->jam_kerja_mulai);
//                 $end = strtotime($model->jam_kerja_selesai);

//                 if ($start !== false && $end !== false && $end > $start) {
//                     $durasiJam = ($end - $start) / 3600;
//                 }
//             }

//             $targetPerPekerja = $model->target->target ?? 0;
//             $model->target_produksi = $targetPerPekerja * ($model->pekerja ?? 0) * $durasiJam;
//         }


//         $model->status_produksi = $model->capaian_produksi - ($model->target_produksi ?? 0);
//         $model->potongan_target = ($model->status_produksi < 0 && $model->target)
//             ? abs($model->status_produksi) * ($model->target->potongan ?? 0)
//             : 0;

//         // debug
//         // 🔴 Debug semua data sebelum insert
//         dd([
//             'tanggal_produksi' => $model->tanggal_produksi,
//             'id_target' => $model->id_target,
//             'id_lahan' => $model->id_lahan,
//             'hasilkw1' => $model->hasilkw1,
//             'hasilkw2' => $model->hasilkw2,
//             'hasilkw3' => $model->hasilkw3,
//             'hasilkw4' => $model->hasilkw4,
//             'total' => $model->total,

//             //panjang dkk
//             'panjang' => $panjang,
//             'tinggi' => $tinggi,
//             'tebal' => $tebal,



//             'kubikasi' => $model->kubikasi,
//             'jam_kerja_mulai' => $model->jam_kerja_mulai,
//             'jam_kerja_selesai' => $model->jam_kerja_selesai,
//             'durasi' => $durasiJam,


//             'pekerja' => $model->pekerja,
//             'target_produksi' => $model->target_produksi,
//             'capaian_produksi' => $model->capaian_produksi,
//             'status_produksi' => $model->status_produksi,
//             'potongan_target' => $model->potongan_target,
//             'kendala' => $model->kendala,
//             'status_data' => $model->status_data,
//         ]);


//     });

// }