<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangKuliahSeeder extends Seeder
{
    public function run()
    {
        DB::table('ruang_kuliah')->insert([
            [
                'kode_ruang' => 'A101',
                'jenis_ruang' => 'Kelas',
                'kapasitas' => 50,
            ],
            [
                'kode_ruang' => 'B202',
                'jenis_ruang' => 'Kelas',
                'kapasitas' => 50,
            ],
            [
                'kode_ruang' => 'C303',
                'jenis_ruang' => 'Kelas',
                'kapasitas' => 50,
            ],
        ]);
    }
}
