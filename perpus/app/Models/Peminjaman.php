<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['siswa', 'petugas', 'buku'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function Petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
