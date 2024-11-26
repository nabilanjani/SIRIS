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
            ['id_jadwal' => 'IF1', 'hari' => 'Senin', 'waktu' => '07:00 - 09:30', 'kelas' => 'A'],
            
        ]);
    }
}
