<?php

namespace Database\Factories;

use App\Models\Trend;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(10);
        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'trend_id' => Trend::inRandomOrder()->first()?->id,
            'user_id' => 1,
            'published' => fake()->optional()->dateTime(),
        ];
    }
}
