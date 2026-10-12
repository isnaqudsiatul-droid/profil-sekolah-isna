<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::insert([
            [
                'foto' => 'ulfah.png',
                'nama_guru' => 'Maria Ulfah, S.Kom., M.T.',
                'slug' => Str::slug('Maria Ulfah'),
                'nip' => '198504122010011008',
                'mapel' => 'Bahasa Indonesia',

            ],
            [
                'foto' => 'susi.png',
                'nama_guru' => 'Susi Qudsiyah, S.Kom., M.T.',
                'slug' => Str::slug('Susi Qudsiyah'),
                'nip' => '197804122010011568',
                'mapel' => 'Seni Budaya dan Keterampilan',
            ],
            [
                'foto' => 'apep.png',
                'nama_guru' => 'Apep Narudin Al-Barki, S.Kom., M.T.',
                'slug' => Str::slug('Apep Narudin Al-Barki'),
                'nip' => '198504122010009876',
                'mapel' => 'Al-Quran dan Hadits',
            ],
        ]);
    }
}
