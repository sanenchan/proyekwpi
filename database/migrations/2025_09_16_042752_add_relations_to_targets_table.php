<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('targets', function (Blueprint $table) {
            // Tambah kolom relasi
            $table->unsignedBigInteger('id_mesin')->after('id_target');
            $table->unsignedBigInteger('id_ukuran')->after('id_mesin');
            $table->unsignedBigInteger('id_jenis_kayu')->after('id_ukuran');

            // Foreign keys
            $table->foreign('id_mesin')->references('id_mesin')->on('mesins')->onDelete('cascade');
            $table->foreign('id_ukuran')->references('id_ukuran')->on('ukurans')->onDelete('cascade');
            $table->foreign('id_jenis_kayu')->references('id_jenis_kayu')->on('jenis_kayus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('targets', function (Blueprint $table) {
            $table->dropForeign(['id_mesin']);
            $table->dropForeign(['id_ukuran']);
            $table->dropForeign(['id_jenis_kayu']);

            $table->dropColumn(['id_mesin', 'id_ukuran', 'id_jenis_kayu']);
        });
    }
};
