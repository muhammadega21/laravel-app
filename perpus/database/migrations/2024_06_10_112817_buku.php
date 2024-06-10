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
            $table->unsignedBigInteger('pengarang_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->unsignedBigInteger('rak_id');
            $table->foreign('pengarang_id')->references('id')->on('pengarang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penerbit_id')->references('id')->on('penerbit')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rak_id')->references('id')->on('rak')->onDelete('cascade')->onUpdate('cascade');
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
