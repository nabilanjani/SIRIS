<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data awal untuk tabel jadwal
        $jadwal = [
            [
                'namamk' => 'Pengembangan Berbasis Platform',
                'jenis_mata_kuliah' => 'wajib',
                'jenis_pertemuan' => 'tatap_muka',
                'jenis_kelas' => 'reguler',
                'kelas' => 'A',
                'sks' => 4,
                'semester' => 5,
                'ruang_kuliah' => 'Ruang 101',
                'dosen_pengampu' => 'Dr. Agus Santoso',
                'koordinator' => 'Dr. Budi Raharjo',
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'kuota' => 40,
                'kurikulum' => '2020',
            ],
            [
                'namamk' => 'Teori Bahasa dan Otomata',
                'jenis_mata_kuliah' => 'wajib',
                'jenis_pertemuan' => 'online',
                'jenis_kelas' => 'iup',
                'kelas' => 'B',
                'sks' => 3,
                'semester' => 5,
                'ruang_kuliah' => 'Zoom',
                'dosen_pengampu' => 'Dr. Siti Aminah',
                'koordinator' => null,
                'mulai' => '10:00:00',
                'selesai' => '12:00:00',
                'kuota' => 20,
                'kurikulum' => '2020',
            ],
            [
                'namamk' => 'Sistem Informasi',
                'jenis_mata_kuliah' => 'pilihan',
                'jenis_pertemuan' => 'tatap_muka',
                'jenis_kelas' => 'reguler',
                'kelas' => 'C',
                'sks' => 3,
                'semester' => 5,
                'ruang_kuliah' => 'Ruang 202',
                'dosen_pengampu' => 'Dr. Rina Kartika',
                'koordinator' => null,
                'mulai' => '13:00:00',
                'selesai' => '15:00:00',
                'kuota' => 30,
                'kurikulum' => '2018',
            ],
            [
                'namamk' => 'Dasar Pemrograman',
                'jenis_mata_kuliah' => 'wajib',
                'jenis_pertemuan' => 'tatap_muka',
                'jenis_kelas' => 'reguler',
                'kelas' => 'A',
                'sks' => 3,
                'semester' => 1,
                'ruang_kuliah' => 'Ruang 101',
                'dosen_pengampu' => 'Dr. Agus Santoso',
                'koordinator' => 'Dr. Budi Raharjo',
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'kuota' => 40,
                'kurikulum' => '2020',
            ],
            [
                'namamk' => 'Dasar Sistem',
                'jenis_mata_kuliah' => 'wajib',
                'jenis_pertemuan' => 'tatap_muka',
                'jenis_kelas' => 'reguler',
                'kelas' => 'A',
                'sks' => 3,
                'semester' => 1,
                'ruang_kuliah' => 'Ruang 103',
                'dosen_pengampu' => 'Dr. Nabila',
                'koordinator' => 'Dr. Budi Raharjo',
                'mulai' => '08:00:00',
                'selesai' => '10:00:00',
                'kuota' => 40,
                'kurikulum' => '2020',
            ],
        ];

        // Insert data ke tabel jadwal
        DB::table('jadwal')->insert($jadwal);
    }
}
