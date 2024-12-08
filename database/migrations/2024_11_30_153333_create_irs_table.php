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
        Schema::create('irs', function (Blueprint $table) {
            $table->bigIncrements('id_irs');
            $table->string('nim')->index();
            $table->string('nama'); 
            $table->string('jurusan'); 
            $table->integer('semester'); 
            //$table->string('tahun_akademik'); 
            $table->string('kodemk')->index(); 
            $table->string('namamk'); 
            $table->string('kelas'); 
            $table->integer('sks'); 
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->date('tanggal_pengajuan')->nullable(); 
            $table->date('tanggal_persetujuan')->nullable(); 

            // foreign key
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kodemk')->references('kodemk')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('id_irs')->references('id')->on('jadwal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};