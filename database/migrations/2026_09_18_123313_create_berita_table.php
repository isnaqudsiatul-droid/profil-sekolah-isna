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
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->text('slug')->unique();
            $table->longText('isi');
            $table->date('tanggal')->nullable();
            $table->string('gambar', 100)->nullable();
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
