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
        Schema::table('mesins', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kategori_mesin')->after('id_mesin'); // posisi setelah id_mesin
            $table->foreign('id_kategori_mesin')->references('id_kategori_mesin')->on('kategori_mesins');
        });
    }

    public function down(): void
    {
        Schema::table('mesins', function (Blueprint $table) {
            $table->dropForeign(['id_kategori_mesin']);
            $table->dropColumn('id_kategori_mesin');
        });
    }
};
