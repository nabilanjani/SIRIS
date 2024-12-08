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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kodemk')->index();
            $table->string('namamk');
            $table->enum('jenis_mata_kuliah', ['wajib', 'pilihan']);
            $table->enum('jenis_pertemuan', ['tatap_muka', 'online']);
            $table->enum('jenis_kelas', ['reguler', 'iup']);
            $table->string('kelas'); 
            $table->integer('sks'); 
            $table->integer('semester');
            $table->string('ruang_kuliah');
            $table->string('hari');
            $table->string('dosen_pengampu');
            $table->string('koordinator')->nullable();
            $table->time('mulai'); 
            $table->time('selesai'); 
            $table->integer('kuota'); 
            $table->string('kurikulum');
            $table->rememberToken();
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