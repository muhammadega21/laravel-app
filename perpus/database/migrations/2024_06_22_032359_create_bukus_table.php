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
            $table->unsignedBigInteger('rak_id');
            $table->foreign('rak_id')->references('id')->on('raks');
            $table->string('judul', 100);
            $table->string('slug');
            $table->string('isbn', 15)->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->text('tempat_terbit')->nullable();
            $table->integer('jumlah');
            $table->string('bahasa', 30)->nullable();
            $table->integer('halaman')->nullable();
            $table->string('image')->nullable();
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
