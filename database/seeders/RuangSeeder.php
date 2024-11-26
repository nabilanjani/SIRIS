<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruang_kuliah')->insert([
            ['id_ruang' => 'E101', 'nama_ruang' => 'E101'],
            ['id_ruang' => 'E102', 'nama_ruang' => 'E102'],
            ['id_ruang' => 'E103', 'nama_ruang' => 'E103'],
            ['id_ruang' => 'A303', 'nama_ruang' => 'A303'],
        ]);
    }
}
