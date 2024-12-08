<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MataKuliah;

class MatKulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Atau gunakan metode insert atau firstOrCreate
        $mata_kuliah = [
            ['kodemk' => 'PAIK6501', 'namamk' => 'Pengembangan Berbasis Platform', 'semester' => '5', 'sks' => 4],
            ['kodemk' => 'PAIK6702', 'namamk' => 'Teori Bahasa dan Otomata', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6502', 'namamk' => 'Komputasi Tersebar dan Paralel', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6505', 'namamk' => 'Pembelajaran Mesin', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6503', 'namamk' => 'Sistem Informasi', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6504', 'namamk' => 'Proyek Perangkat Lunak', 'semester' => '5', 'sks' => 3],
            ['kodemk' => 'PAIK6404', 'namamk' => 'Grafika Komputasi Visual', 'semester' => '4', 'sks' => 3],
            ['kodemk' => 'PAIK6401', 'namamk' => 'Pemrograman Berorientasi Objek', 'semester' => '4', 'sks' => 3],
            ['kodemk' => 'PAIK6406', 'namamk' => 'Sistem Cerdas', 'semester' => '4', 'sks' => 3],
            ['kodemk' => 'PAIK6405', 'namamk' => 'Rekayasa Perangkat Lunak', 'semester' => '4', 'sks' => 3],
            ['kodemk' => 'PAIK6403', 'namamk' => 'Manajemen Basis Data', 'semester' => '4', 'sks' => 3],
            ['kodemk' => 'PAIK6601', 'namamk' => 'Analisis dan Strategi ALgoritma', 'semester' => '6', 'sks' => 3],


        ];

        // Gunakan metode insert atau create
        foreach ($mata_kuliah as $matkul) {
            MataKuliah::firstOrCreate(
                ['kodemk' => $matkul['kodemk']], 
                $matkul
            );
        }
    }
}