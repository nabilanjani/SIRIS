<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            ['user_id' => 1, 'nim' => '24060122140169', 'nama' => 'Nabila Betari Anjani', 'alamat' => 'Semarang', 'no_telp' => '08123456789', 'email' => 'mahasiswa1@gmail.com', 'angkatan' => 2022, 'jalur_masuk' => 'UM', 'status' => 'Aktif', 'ipk' => 4.00, 'ips' => 4.00],
        ]);
    }
}
