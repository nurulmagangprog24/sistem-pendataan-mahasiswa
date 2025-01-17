<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kaprodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Kelas
        $kelas1 = Kelas::create([
            'name' => 'Kelas A',
            'jumlah' => 10,
        ]);

        $kelas2 = Kelas::create([
            'name' => 'Kelas B',
            'jumlah' => 10,
        ]);

        // Buat Kaprodi
        $kaprodiUser = User::create([
            'username' => 'kaprodi1',
            'email' => 'kaprodi@example.com',
            'password' => Hash::make('password'),
            'role' => 'kaprodi',
        ]);

        Kaprodi::create([
            'user_id' => $kaprodiUser->id,
            'kode_dosen' => 101,
            'nip' => 12345678,
            'name' => 'Kaprodi 1',
        ]);

        // Buat Dosen
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'username' => 'dosen'.$i,
                'email' => 'dosen'.$i.'@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen wali',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'kelas_id' => $i <= 2 ? ($i == 1 ? $kelas1->id : $kelas2->id) : null, // Dosen 1 untuk Kelas A, Dosen 2 untuk Kelas B
                'kode_dosen' => 200 + $i,
                'nip' => 98765432 + $i,
                'name' => 'Dosen '.$i,
            ]);
        }

        // Buat Mahasiswa
        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'username' => 'mahasiswa'.$i,
                'email' => 'mahasiswa'.$i.'@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'kelas_id' => $i <= 10 ? $kelas1->id : $kelas2->id, // Mahasiswa 1-10 di Kelas A, 11-20 di Kelas B
                'nim' => '00'.$i,
                'name' => 'Mahasiswa '.$i,
                'tempat_lahir' => 'Tempat Lahir '.$i,
                'tanggal_lahir' => now()->subYears(20)->toDateString(),
                'edit' => false,
            ]);
        }
    }
}
