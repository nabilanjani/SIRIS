<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->string('id_jadwal', 20)->primary();
            $table->string('kodemk', 10)->nullable()->index('kodemk');
            $table->string('kelas', 10)->nullable();
            $table->string('id_ruang', 10)->nullable()->index('id_ruang');
            $table->string('hari', 20)->nullable();
            $table->time('waktu')->nullable();
            $table->integer('kuota')->nullable();
            $table->json('id_dosen')->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
