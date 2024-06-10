<?php

use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pengarang::class)->constrained();
            $table->foreignIdFor(Penerbit::class)->constrained();
            $table->foreignIdFor(Rak::class)->constrained();
            $table->string('judul');
            $table->integer('tahun_terbit');
            $table->integer('jumlah');
            $table->string('isbn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
