<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kelas;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Petugas;
use App\Models\Rak;
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
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-A',
            'status' => 1,
        ]);

        Petugas::create([
            'id_petugas' => 'A001',
            'user_id' => 1,
            'username' => 'Admin',
            'name' => 'Administrator',
        ]);

        Siswa::create([
            'id_siswa' => 'S001',
            'user_id' => 2,
            'username' => 'user',
            'name' => 'User',
            'nis' => '111',
            'kelas_id' => 1
        ]);

        Rak::create([
            'id_rak' => 'R001',
            'nama_rak' => 'Pengetahuan',
            'keterangan' => 'Berisi buku pelajaran kelas XI - XII'
        ]);

        Buku::create([
            'rak_id' => 1,
            'judul' => 'Pendidikan Agama Islam SMA Kelas XI',
            'slug' => 'pendidikan-agama-islam-sma-kelas-xi',
            'sinopsis' => 'Buku Pendidikan Agama Islam SMA Kelas XI merupakan buku pelajaran tentang pendidikan agama Islam. Buku ini dikhususkan untuk siswa SMA Kelas XI.',
            'pengarang' => 'Sadi, H.M.Nasikin, A.Ilyas Ismail',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2015,
            'tempat_terbit' => 'Jakarta',
            'jumlah' => 70,
            'bahasa' => 'Indonesia',
            'halaman' => 150,
            'isbn' => '9786022415602',
        ]);
    }
}
