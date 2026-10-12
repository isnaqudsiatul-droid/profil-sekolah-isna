<?php

namespace Database\Seeders;

use App\Models\Ektrakurikuler;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judul = 'Palang Merah Remaja (PMR)';

        Ektrakurikuler::create([
            'nama_ekskul' => $judul,
            'slug' => Str::slug($judul),
            'id_guru' => 1,
            'jadwal_latihan' => 'Kamis',
            'deskripsi' => 'Palang Merah Remaja',
            'gambar' => null,
        ]);
    }
}
