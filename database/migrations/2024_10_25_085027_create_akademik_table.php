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
        Schema::create('akademik', function (Blueprint $table) {
            $table->string('nidn', 20)->primary();
            $table->string('nama', 100)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('jabatan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademik');
    }
};
