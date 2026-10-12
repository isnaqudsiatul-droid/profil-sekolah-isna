<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            [
                'nisn'          => '0082365315',
                'nama_siswa'    => 'Isna Qudsiatul Aulia',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2024',
            ],
            [
                'nisn'          => '0082365876',
                'nama_siswa'    => 'Silvi Alviana',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2024',
            ],
            [
                'nisn'          => '0089875315',
                'nama_siswa'    => 'Silvi Nispi',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2024',
            ],
        ]);
    }
}
