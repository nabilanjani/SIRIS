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
        DB::table('prodi')->insert([
            ['nama' => 'Informatika'],
            ['nama' => 'Statistika'],
            ['nama' => 'Biologi'],
            ['nama' => 'Fisika'],
            ['nama' => 'Kimia'],
            ['nama' => 'Bioteknologi'],
            ['nama' => 'Matematika'],
        ]);
    }
}