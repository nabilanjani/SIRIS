<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Kolom yang menjadi foreign key
            $table->string('nim', 14)->primary();
            $table->string('nama', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->integer('semester')->nullable();
            $table->string('jalur_masuk', 50)->nullable();
            $table->enum('status', ['Aktif', 'Cuti', 'Belum Her-Registrasi'])->default('Belum Her-Registrasi');

            $table->unsignedBigInteger('doswal');
        
            // Relasi ke tabel users dan akademik
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doswal')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
