<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama_siswa');
            $table->string('nisn', 16)->nullable()->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->year('tahun_masuk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};