<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class khsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('khs')->insert([
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6404',
                'namamk' => 'Grafika dan Komputasi Visual',
                'sks' => 3,
                'nilai_angka' => 80,
                'nilai_huruf' => 'A',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6401',
                'namamk' => 'Pemrograman Berorientasi Objek',
                'sks' => 3,
                'nilai_angka' => 86,
                'nilai_huruf' => 'A',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6406',
                'namamk' => 'Sistem Cerdas',
                'sks' => 3,
                'nilai_angka' => 78,
                'nilai_huruf' => 'B',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6601',
                'namamk' => 'Analisis dan Strategi Algoritma',
                'sks' => 3,
                'nilai_angka' => 90,
                'nilai_huruf' => 'A',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6403',
                'namamk' => 'Manajemen Basis Data',
                'sks' => 3,
                'nilai_angka' => 92,
                'nilai_huruf' => 'A',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'semester' => 4,
                'jurusan' => 'Informatika',
                'kodemk' => 'PAIK6405',
                'namamk' => 'Rekayasa Perangkat Lunak',
                'sks' => 3,
                'nilai_angka' => 100,
                'nilai_huruf' => 'A',
            ],
        ]);
    }
}