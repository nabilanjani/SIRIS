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
        DB::table('jadwal_kuliah')->insert([
            ['id_jadwal' => 'IF1', 'hari' => 'Senin', 'jam_mulai' => '07:00', 'jam_selesai' => '09:30', 'kelas' => 'A'],
            
        ]);
    }
}
