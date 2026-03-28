<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Ibadah', 'Kajian Islam', 'Berita Masjid', 'Tips & Trik',
            'Kegiatan', 'Sosial', 'Pendidikan', 'Ramadan', 'Zakat & Infaq',
        ]);

        $color = fake()->randomElement([
            '#b45309', '#1e7e34', '#1d4ed8', '#7c3aed',
            '#dc2626', '#0891b2', '#d97706',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'color' => $color,
        ];
    }
}
