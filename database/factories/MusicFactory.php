<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use App\Models\Music;
use App\Enums\MusicGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{

    protected $model = Music::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(nbWords: 3),
            'artist' => $this->faker->name(),
            'genre' => $this->faker->randomElement(MusicGenre::cases())->value,
            'file_path' => 'music/' . $this->faker->uuid() . '.mp3',
        ];
    }
}
