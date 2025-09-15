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
        Schema::create('targets', function (Blueprint $table) {
            $table->bigIncrements('id_target'); // primary key

            $table->string('kode_ukuran')->unique();

            // Relasi ke tabel master
            //relasi tabel mesin
            $table->unsignedBigInteger('id_mesin');
            $table->foreign('id_mesin')
                ->references('id_mesin')
                ->on('mesins')
                ->onDelete('cascade');

            // relasi tabel ukuran
            $table->unsignedBigInteger('id_ukuran');
            $table->foreign('id_ukuran')
                ->references('id_ukuran')
                ->on('ukurans')
                ->onDelete('cascade');
            // $table->foreignId('id_ukuran')
            //     ->constrained('ukurans')
            //     ->onDelete('cascade');

            //Relasi tabel jenis kayu
            $table->unsignedBigInteger('id_jenis_kayu');
            $table->foreign('id_jenis_kayu')
                ->references('id_jenis_kayu')
                ->on('mesins')
                ->onDelete('cascade');
            // $table->foreignId('id_jenis_kayu')
            //     ->constrained('jenis_kayus')
            //     ->onDelete('cascade');

            // Data produksi
            $table->integer('target_mesin');
            $table->integer('orang');
            $table->integer('jam');
            $table->integer('target_per_jam');
            $table->integer('target_per_orang');

            // Gaji & potongan
            $table->decimal('gaji', 15, 2);
            $table->decimal('potongan_per_lembar', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
