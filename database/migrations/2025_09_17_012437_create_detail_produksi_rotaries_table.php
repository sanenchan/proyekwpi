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
        Schema::create('detail_produksi_rotaries', function (Blueprint $table) {
            $table->bigIncrements('id'); // primary key

            // Foreign key ke tabel produksi_rotaries (id_rotary)
            $table->unsignedBigInteger('id_rotary');
            $table->foreign('id_rotary')
                ->references('id_rotary')
                ->on('produksi_rotaries')
                ->onDelete('cascade');

            // Foreign key ke tabel pegawais (id)
            $table->foreignId('id_pegawai')
                ->references('id_pegawai')
                ->on('pegawais')
                ->onDelete('cascade');

            $table->integer('potongan_target')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_produksi_rotaries');
    }
};
