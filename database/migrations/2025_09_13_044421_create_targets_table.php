<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table) {
            // 1. id_target sebagai primary key
            $table->bigIncrements('id_target');

            // 2. ukuran -> text
            $table->string('ukuran');

            // 3. target -> angka
            $table->integer('target');

            // 4. orang -> angka
            $table->integer('orang');

            // 5. jam -> angka
            $table->integer('jam');

            // 6. targetperjam = target / jam
            $table->decimal('targetperjam', 15, 2)
                ->virtualAs('target / jam'); // Generated Column

            // 7. targetperorang = target / orang
            $table->decimal('targetperorang', 15, 2)
                ->virtualAs('target / orang'); // Generated Column

            // 8. gaji -> uang
            $table->decimal('gaji', 15, 2);

            // 9. potongan / lembur = targetperorang / gaji
            $table->decimal('potongan', 15, 2)
                ->virtualAs('targetperorang / gaji'); // Generated Column

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
