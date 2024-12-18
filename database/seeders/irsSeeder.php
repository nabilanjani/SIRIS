<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class irsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('irs')->insert([
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6404',
                'namamk' => 'Grafika dan Komputasi Visual',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'hari' => 'Senin',
                'status' => 'disetujui',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6401',
                'namamk' => 'Pemrograman Berorientasi Objek',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'hari' => 'Selasa',
                'status' => 'disetujui',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6406',
                'namamk' => 'Sistem Cerdas',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'hari' => 'Rabu',
                'status' => 'disetujui',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6601',
                'namamk' => 'Analisis dan Strategi Algoritma',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'hari' => 'Kamis',
                'status' => 'disetujui',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6403',
                'namamk' => 'Manajemen Basis Data',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'hari' => 'Jumat',
                'status' => 'disetujui',
            ],
            [
                'nim' => '24060122140169',
                'nama' => 'Nabila Betari Anjani',
                'jurusan' => 'Informatika',
                'semester' => 4,
                'kodemk' => 'PAIK6405',
                'namamk' => 'Rekayasa Perangkat Lunak',
                'kelas' => 'A',
                'sks' => 3,
                'mulai' => '13:00:00',
                'selesai' => '15:00:00',
                'hari' => 'Senin',
                'status' => 'disetujui',
            ],
        ]);
    }
}
