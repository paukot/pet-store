<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Enums\TagEnum;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        foreach (CategoryEnum::cases() as $category) {
            Category::updateOrCreate(['id' => $category->value], ['name' => strtolower($category->name)]);
        }

        foreach (TagEnum::cases() as $tag) {
            Tag::updateOrCreate(['id' => $tag->value], ['name' => strtolower($tag->name)]);
        }
    }
}
