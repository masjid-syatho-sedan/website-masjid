<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artikel>
 */
class ArtikelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = fake()->sentence(fake()->numberBetween(4, 10));
        $judul = rtrim($judul, '.');

        $diterbitkanPada = fake()->boolean(80)
            ? fake()->dateTimeBetween('-1 year', 'now')
            : null;

        return [
            'user_id' => User::factory(),
            'kategori_id' => Kategori::factory(),
            'judul' => $judul,
            'slug' => Str::slug($judul).'-'.Str::random(5),
            'ringkasan' => fake()->paragraph(),
            'konten' => implode("\n\n", fake()->paragraphs(fake()->numberBetween(4, 8))),
            'gambar' => null,
            'status' => $diterbitkanPada ? 'diterbitkan' : 'draft',
            'unggulan' => fake()->boolean(15),
            'dilihat' => fake()->numberBetween(0, 1500),
            'diterbitkan_pada' => $diterbitkanPada,
        ];
    }

    /**
     * State untuk artikel yang sudah diterbitkan.
     */
    public function diterbitkan(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diterbitkan',
            'diterbitkan_pada' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * State untuk artikel draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'diterbitkan_pada' => null,
        ]);
    }

    /**
     * State untuk artikel unggulan.
     */
    public function unggulan(): static
    {
        return $this->state(fn (array $attributes) => [
            'unggulan' => true,
        ]);
    }
}
