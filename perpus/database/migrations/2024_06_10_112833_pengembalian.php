<?php

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Pengembalian;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pengembalian::class)->constrained();
            $table->foreignIdFor(Siswa::class)->constrained();
            $table->foreignIdFor(Petugas::class)->constrained();
            $table->foreignIdFor(Buku::class)->constrained();
            $table->foreignIdFor(Denda::class)->constrained();
            $table->date('tgl_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
