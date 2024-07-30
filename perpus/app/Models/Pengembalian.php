<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['siswa', 'buku', 'petugas'];

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
