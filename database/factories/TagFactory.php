<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->unique()->randomElement([
            'shalat', 'quran', 'hadits', 'dakwah', 'ramadan', 'zakat',
            'puasa', 'haji', 'umrah', 'sedekah', 'doa', 'dzikir',
            'kajian', 'fiqih', 'akidah', 'tasawuf', 'sirah', 'tafsir',
        ]);

        return [
            'nama' => $nama,
            'slug' => Str::slug($nama),
        ];
    }
}
