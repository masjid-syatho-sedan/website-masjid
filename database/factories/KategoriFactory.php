<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->unique()->randomElement([
            'Ibadah', 'Kajian Islam', 'Berita Masjid', 'Tips & Trik',
            'Kegiatan', 'Sosial', 'Pendidikan', 'Ramadan', 'Zakat & Infaq',
        ]);

        $warna = fake()->randomElement([
            '#b45309', '#1e7e34', '#1d4ed8', '#7c3aed',
            '#dc2626', '#0891b2', '#d97706',
        ]);

        return [
            'nama' => $nama,
            'slug' => Str::slug($nama),
            'deskripsi' => fake()->sentence(),
            'warna' => $warna,
        ];
    }
}
