<?php

namespace Database\Seeders;

use App\Models\Petugas;
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

        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 1
        ]);

        Petugas::create([
            'id_petugas' => 'P001',
            'user_id' => $user->id,
            'username' => 'Admin',
            'name' => 'Administrator',
        ]);
    }
}
