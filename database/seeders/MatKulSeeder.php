<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatKulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mata_kuliah')->insert([
            ['kodemk' => 'PAIK6501', 'nama' => 'Pengembangan Berbasis Platform', 'semester' => '5', 'sks' => 4],
            ['kodemk' => 'PAIK6702', 'nama' => 'Teori Bahasa dan Otomata', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6502', 'nama' => 'Komputasi Tersebar dan Paralel', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6505', 'nama' => 'Pembelajaran Mesin', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6503', 'nama' => 'Sistem Informasi', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6504', 'nama' => 'Proyek Perangkat Lunak', 'semester' => '5', 'sks' => 3],
        ]);
    }
}
