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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->char('id_siswa', 4)->nullable();
            $table->string('name', 30);
            $table->string('username', 15);
            $table->string('nis', 10)->nullable();
            $table->char('no_telp', 15)->nullable();
            $table->boolean('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
            $table->string('image', 50)->default('user.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
