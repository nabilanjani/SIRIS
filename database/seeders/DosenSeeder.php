<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // Clear the table before seeding (optional)
        // DB::table('dosen')->truncate(); // Uncomment if you want to clear existing data

        // Insert seed data
        DB::table('dosen')->insert([
            [
                'nip' => '12345',
                'nama' => 'Dr. Aris Sugiharto',
            ],
            [
                'nip' => '12354',
                'nama' => 'Dr. Nyoba',
            ],
            [
                'nip' => '12346',
                'nama' => 'Dr. Nyoba Lagi',
            ],
        ]);
    }
}
