<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['rak'];

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }
}
