<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ListUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = [
            [
                'usertype' => 'mahasiswa',
                'name' => 'Nabila Betari Anjani',
                'email' => 'mahasiswa1@gmail.com',
                'password' => 'mahasiswa123',
            ],
            [
                'usertype' => 'dekan',
                'name' => 'Kusworo Adi',
                'email' => 'dekan1@gmail.com',
                'password' => 'dekan123',
            ],
            [
                'usertype' => 'bagianakademik',
                'name' => 'Awang Kurnia Saputra',
                'email' => 'bagianakademik1@gmail.com',
                'password' => 'ba123456',
            ],
            [
                'usertype' => 'pembimbingakademik',
                'name' => 'Sutikno',
                'email' => 'pembimbingakademik1@gmail.com',
                'password' => 'pa123456',
            ],
            [
                'usertype' => 'kaprodi',
                'name' => 'Aris Sugiharto',
                'email' => 'kaprodi1@gmail.com',
                'password' => 'kaprodi123',
            ],
        ];
        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}