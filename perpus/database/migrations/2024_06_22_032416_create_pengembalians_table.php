<?php

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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('buku_id');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('petugas_id')->references('id')->on('petugas');
            $table->foreign('buku_id')->references('id')->on('bukus');
            $table->char('id_kembali', 6);
            $table->date('tgl_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
