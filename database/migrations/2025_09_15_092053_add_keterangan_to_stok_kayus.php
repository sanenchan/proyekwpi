<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stok_kayus', function (Blueprint $table) {
            // Lahan
            $table->unsignedBigInteger('id_lahan')->after('id_stok_kayu');
            $table->foreign('id_lahan')->references('id_lahan')->on('lahans');

            // Jenis Kayu
            $table->unsignedBigInteger('id_jenis_kayu')->after('id_stok_kayu');
            $table->foreign('id_jenis_kayu')->references('id_jenis_kayu')->on('jenis_kayus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_kayus', function (Blueprint $table) {
            // Lahan
            $table->dropForeign(['id_lahan']);
            $table->dropColumn('id_lahan');
            // Jenis Kayu
            $table->dropForeign(['id_jenis_kayu']);
            $table->dropColumn('id_jenis_kayu');
            // 
        });
    }
};
