<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'kelas'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class);
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }
}
