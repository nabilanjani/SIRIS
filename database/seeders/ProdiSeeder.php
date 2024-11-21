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
            ['id_prodi' => '1', 'nama_prodi' => 'Informatika'],
        ]);
    }
}