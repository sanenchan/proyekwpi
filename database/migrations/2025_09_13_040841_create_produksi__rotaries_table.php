<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel utama produksi_rotaries
        Schema::create('produksi_rotaries', function (Blueprint $table) {
            $table->bigIncrements('id_rotary'); // primary key
            $table->date('tanggal_produksi');
            $table->integer('hasilkw1')->default(0);
            $table->integer('hasilkw2')->default(0);
            $table->integer('hasilkw3')->default(0);
            $table->integer('hasilkw4')->default(0);
            $table->integer('total')->virtualAs('hasilkw1 + hasilkw2 + hasilkw3 + hasilkw4'); // kolom virtual/total
            $table->decimal('kubikasi', 12, 4)->default(0); // desimal 4 angka di belakang koma
            $table->time('jam_kerja_mulai')->nullable();
            $table->time('jam_kerja_selesai')->nullable();
            $table->integer('pekerja')->default(0);
            $table->integer('target_produksi')->default(0);
            $table->integer('capaian_produksi')->default(0);
            $table->integer('status_produksi')->default(0); // bisa positif atau negatif
            $table->integer('potongan_target')->default(0);
            $table->text('kendala')->nullable();
            $table->string('status_data')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('produksi_rotaries');
    }
};
