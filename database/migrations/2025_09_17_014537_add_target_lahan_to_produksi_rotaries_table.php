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
        Schema::table('produksi_rotaries', function (Blueprint $table) {
            // Tambahkan kolom id_target setelah tanggal_produksi (NOT NULL)
            $table->unsignedBigInteger('id_target')->after('tanggal_produksi');

            // Foreign key ke tabel targets
            $table->foreign('id_target')
                ->references('id_target') // sesuaikan dengan PK di tabel targets
                ->on('targets')
                ->onDelete('restrict');

            // Kolom id_lahan wajib
            $table->unsignedBigInteger('id_lahan')->after('id_target');

            $table->foreign('id_lahan')
                ->references('id_lahan') // sesuaikan dengan PK di tabel lahans
                ->on('lahans')
                ->onDelete('restrict');
        });
    }


    public function down(): void
    {
        Schema::table('produksi_rotaries', function (Blueprint $table) {
            $table->dropForeign(['id_target']);
            $table->dropForeign(['id_lahan']);
            $table->dropColumn(['id_target', 'id_lahan']);
        });
    }

};
