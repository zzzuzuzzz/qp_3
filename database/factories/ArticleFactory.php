<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title);

        return [
            'slug' => $slug,
            'title' => $title,
            'description' => $this->faker->word(),
            'body' => $this->faker->text(),
            'published_at' => $this->faker->optional()->dateTimeThisMonth()
        ];
    }
}
