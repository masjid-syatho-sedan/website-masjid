<?php

namespace Database\Seeders;

use App\Models\Category;
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

        // Seed categories
        Category::factory(9)->create();

        // Seed tags
        Tag::factory(18)->create();

        // Seed articles with real content
        $this->call(ArticleSeeder::class);

        DB::commit();
    }
}
