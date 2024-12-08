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
        ];

        // Insert data ke tabel jadwal
        DB::table('jadwal')->insert($jadwal);
    }
}
