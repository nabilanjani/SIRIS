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
                'nip' => '198203092006041002',
                'nama' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
            ],
            [
                'nip' => '197404011999031002',
                'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
            ],
            [
                'nip' => '199603032024061003',
                'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.',
            ],
        ]);
    }
}
