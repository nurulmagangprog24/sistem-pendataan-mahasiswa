<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'Pak Kaprodi',
                'email' => 'kaprodi@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => 'kaprodi' 
            ], 
            [
                'username' => 'Pak Dosen',
                'email' => 'dosen@gmail.com',
                'password' => bcrypt('qwertyuiop'),
                'role' => 'dosen wali' 
            ], 
            [
                'username' => 'Mas Mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => 'mahasiswa' 
            ], 
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        } 
    }
}
