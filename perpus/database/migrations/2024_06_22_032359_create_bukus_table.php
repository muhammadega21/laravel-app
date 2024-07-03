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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengarang_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->unsignedBigInteger('rak_id');
            $table->foreign('pengarang_id')->references('id')->on('pengarangs');
            $table->foreign('penerbit_id')->references('id')->on('penerbits');
            $table->foreign('rak_id')->references('id')->on('raks');
            $table->string('judul', 30);
            $table->integer('tahun_terbit');
            $table->integer('jumlah');
            $table->string('isbn', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
