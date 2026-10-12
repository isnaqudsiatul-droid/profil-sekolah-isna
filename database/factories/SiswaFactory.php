<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_program' => fake()->randomElement([1, 2, 3]),
            'nama' => fake()->name(),
            'nis' => fake()->unique()->numerify('2026####'),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'nama_kelas' => fake()->randomElement(['X PPLG 1', 'XI PPLG 2', 'XII TKJ 1']),
            'tahun_masuk' => fake()->year(),
        ];
    }
}
