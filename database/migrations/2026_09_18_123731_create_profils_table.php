<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id('id_profil');
            $table->string('nama_sekolah');
            $table->string('nama_kepala_sekolah');
            $table->string('foto_kepala_sekolah', 100)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('npsn', 50);
            $table->text('alamat');
            $table->string('kontak', 15);
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->year('tahun_berdiri');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};
