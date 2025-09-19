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
            $table->integer('jumlah_batang')->default(0)->after('id_lahan');
        });
    }

    public function down(): void
    {
        Schema::table('produksi_rotaries', function (Blueprint $table) {
            $table->dropColumn('jumlah_batang');
        });
    }
};
