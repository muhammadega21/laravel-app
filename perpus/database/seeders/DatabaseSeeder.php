<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 1
        ]);

        User::create([
            'email' => 'dermawane988@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-A',
            'status' => 1,
        ]);

        Petugas::create([
            'id_petugas' => 'P001',
            'user_id' => 1,
            'username' => 'Admin',
            'name' => 'Administrator',
        ]);

        Siswa::create([
            'id_siswa' => 'S001',
            'user_id' => 2,
            'username' => 'Ega',
            'name' => 'Muhammad Ega Dermawan',
            'nis' => '111',
            'kelas_id' => 1
        ]);
    }
}
