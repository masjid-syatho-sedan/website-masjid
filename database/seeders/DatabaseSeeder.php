<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();

        User::factory(10)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'member']);
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $admin->assignRole('admin');

        // Seed kategori
        $kategoris = Kategori::factory(9)->create();

        // Seed tag
        $tags = Tag::factory(18)->create();

        // Seed artikel dengan tag acak
        Artikel::factory(30)
            ->diterbitkan()
            ->recycle([$admin])
            ->recycle($kategoris)
            ->create()
            ->each(function (Artikel $artikel) use ($tags) {
                $artikel->tags()->attach(
                    $tags->random(fake()->numberBetween(1, 4))->pluck('id')
                );
            });

        // Beberapa artikel draft
        Artikel::factory(5)
            ->draft()
            ->recycle([$admin])
            ->recycle($kategoris)
            ->create();

        // Artikel unggulan
        Artikel::factory(3)
            ->diterbitkan()
            ->unggulan()
            ->recycle([$admin])
            ->recycle($kategoris)
            ->create()
            ->each(function (Artikel $artikel) use ($tags) {
                $artikel->tags()->attach(
                    $tags->random(fake()->numberBetween(1, 3))->pluck('id')
                );
            });

        DB::commit();
    }
}
