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
        'jumlah_batang',
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
    protected static function booted()
    {
        static::saved(function ($produksi) {
            // update jumlah pekerja
            $produksi->pekerja = $produksi->detailRotaries()->count();
            $produksi->saveQuietly();

            // distribusikan potongan target
            $jumlahPekerja = $produksi->pekerja;
            if ($jumlahPekerja > 0 && $produksi->potongan_target > 0) {
                $potonganPerOrang = $produksi->potongan_target / $jumlahPekerja;

                foreach ($produksi->detailRotaries as $detail) {
                    $detail->updateQuietly([
                        'potongan_target' => $potonganPerOrang,
                    ]);
                }
            }
        });
    }

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
                // Ambil data dari tabel target (relasi)
                $targetTotal = $model->target->target ?? 0;       // total target produksi
                $targetOrang = $model->target->orang ?? 1;        // jumlah orang standar
                $targetJam = $model->target->jam ?? 1;    // durasi jam standar

                // Hitung target per orang per jam (hanya dari tabel target)
                $targetPerOrangPerJam = 0;
                if ($targetOrang > 0 && $targetJam > 0) {
                    $targetPerOrangPerJam = $targetTotal / $targetOrang / $targetJam;
                }
                // Hitung target produksi nyata berdasarkan jumlah pekerja aktual & jam kerja aktual
                $model->target_produksi = $targetPerOrangPerJam * ($model->pekerja ?? 0) * $durasiJam;

                // $targetPerPekerja = $model->target->target ?? 0;
                // $model->target_produksi = $targetPerPekerja * $model->pekerja * $durasiJam;
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
