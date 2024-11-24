<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_studi')->insert([
            ['nama_prodi' => 'Informatika'],
            ['nama_prodi' => 'Statistika'],
            ['nama_prodi' => 'Biologi'],
            ['nama_prodi' => 'Fisika'],
            ['nama_prodi' => 'Kimia'],
            ['nama_prodi' => 'Bioteknologi'],
            ['nama_prodi' => 'Matematika'],
        ]);
    }
}