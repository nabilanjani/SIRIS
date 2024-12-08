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
        Schema::create('khs', function (Blueprint $table) {
            $table->bigIncrements('id_irs');
            $table->string('nim')->index();
            $table->string('nama'); 
            $table->string('semester');
            $table->string('jurusan');
            // $table->double('ips');  
            $table->string('kodemk')->index(); 
            $table->string('namamk'); 
            $table->integer('sks'); 
            $table->string('nilai_huruf')->nullable();
            $table->decimal('nilai_angka', 5, 2)->nullable();


            //foreign key
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kodemk')->references('kodemk')->on('mata_kuliah')->onDelete('cascade');

            $table->unique(['nim', 'kodemk', 'semester']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};