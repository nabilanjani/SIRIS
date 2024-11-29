<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ListUser::class,
            MhsSeeder::class,
            MatKulSeeder::class,
            AkademikSeeder::class,
            JadwalSeeder::class,
            RuangKuliahSeeder::class,
            ProdiSeeder::class,
        ]);
    }
}