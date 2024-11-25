<?php

namespace Database\Seeders;

use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use App\Models\Music;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Task::factory(20)->create();

        $tagNames = ['new', 'old', 'best', 'high', 'low'];
        foreach ($tagNames as $name) {
            Tag::create(['name' => $name]);
        }

        Music::factory(15)->create()->each(function ($music) {
            // Get 2 random tags
            $tags = Tag::inRandomOrder()->limit(2)->get();
            // Attach the tags to the music
            $music->tags()->attach($tags);
        });
    }
}
