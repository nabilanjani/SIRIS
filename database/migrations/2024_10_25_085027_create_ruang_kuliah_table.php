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
        Schema::create('ruang_kuliah', function (Blueprint $table) {

            $table->id('id_ruang', 20);
            $table->string('kode_ruang', 10)->unique();
            $table->string('jenis_ruang', 50)->nullable();
            $table->string('kapasitas', 10)->nullable();
            $table->string('status', 1)->nullable();

            // $table->string('id_ruang', 10)->primary();
            $table->string('nama_ruang', 50)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_kuliah');
    }
};
