<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $judul =  'MTs Bahrul Hidayah Raih Medali Emas LKS Web Technologies 2026';
        
        Berita::create([
            'judul'     => $judul,
            'slug'      => Str::slug($judul),
            'isi'       => 'Prestasi membanggakan kembali diukir oleh kontingen peserta didik',
            'tanggal'   => now(),
            'id_user'   => 1,
            'gambar'    => null,
            'status'    => 'draft',
        ]);
    }
}