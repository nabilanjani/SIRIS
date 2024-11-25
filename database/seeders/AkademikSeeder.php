<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('akademik')->insert([
            ['user_id' => 2, 'nidn' => '0017037201', 'nama' => 'Prof. Dr. Kusworo Adi, S.Si., M.T', 'no_hp' => '081324567354', 'email' => 'dekan1@gmail.com', 'jabatan' => 'Dekan', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1978-10-12', 'alamat' => 'Kandri Pesona Asri'],
            ['user_id' => 3, 'nidn' => '0021111111', 'nama' => 'Awang Kurnia Saputra, S.Kom.', 'no_hp' => '081324567354', 'email' => 'bagianakademik1@gmail.com', 'jabatan' => 'Akademik', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1978-10-12', 'alamat' => 'Kandri Pesona Asri'],
            ['user_id' => 4, 'nidn' => '0024057906', 'nama' => 'Dr. Sutikno, S.T., M.Cs.', 'no_hp' => '081324567354', 'email' => 'pembimbingakademik1@gmail.com', 'jabatan' => 'Lektor', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1978-10-12', 'alamat' => 'Kandri Pesona Asri'],
            ['user_id' => 5, 'nidn' => '0011087104', 'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.', 'no_hp' => '081324567354', 'email' => 'kaprodi1@gmail.com', 'jabatan' => 'Lektor', 'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1978-10-12', 'alamat' => 'Kandri Pesona Asri'],
            
            //['nidn' => '0009038204', 'nama' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.', 'no_hp' => '081324567354', 'email' => 'adiwibowo@lecturer.undip.ac.id', 'jabatan' => 'Lektor Kepala'], 
            // ['nidn' => '0627128001', 'nama' => 'Guruh Aryotejo, S.Kom., M.Sc.', 'no_hp' => '081324567354', 'email' => 'guruh@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
            // ['nidn' => '0016057801', 'nama' => 'Dr. Helmie Arif Wibawa, S.Si., M.Cs.', 'no_hp' => '081324567354', 'email' => 'helmie@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
            // ['nidn' => '0003038907', 'nama' => 'Khadijah, S.Kom., M.Cs.', 'no_hp' => '081324567354', 'email' => 'khadijah@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
            // ['nidn' => '0622038802', 'nama' => 'Prajanto Wahyu Adi, M.Kom.', 'no_hp' => '081324567354', 'email' => 'prajanto@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
            // ['nidn' => '0025118503', 'nama' => 'Rismiyati, B.Eng, M.Cs', 'no_hp' => '081324567354', 'email' => 'rismiyati@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
            // ['nidn' => '0007116503', 'nama' => 'Drs. Eko Adi Sarwoko, M.Komp.', 'no_hp' => '081324567354', 'email' => 'ekoadisarwoko@lecturer.undip.ac.id', 'jabatan' => 'Lektor Kepala'],
            // ['nidn' => '0005077005', 'nama' => 'Priyo Sidik Sasongko, S.Si., M.Kom.', 'no_hp' => '081324567354', 'email' => 'priyosidiksasongko@lecturer.undip.ac.id', 'jabatan' => 'Lektor'],
        ]);
    }
}
