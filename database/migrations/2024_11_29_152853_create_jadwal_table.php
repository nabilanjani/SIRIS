<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('prodi');
            $table->string('mata_kuliah');
            $table->string('jenis_mata_kuliah');
            $table->string('jenis_pertemuan');
            $table->string('jenis_kelas');
            $table->string('kelas');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('ruang_kuliah');
            $table->string('dosen_pengampu');
            $table->string('koordinator')->nullable();
            $table->string('hari');
            $table->time('mulai');
            $table->time('selesai');
            $table->integer('kuota');
            $table->string('kurikulum');
            $table->unsignedTinyInteger('status')->default(0); // Default status tanpa after()
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
