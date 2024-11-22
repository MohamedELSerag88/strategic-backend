<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'field' => $this->faker->word(), // Random word for field
            'date' => $this->faker->date(), // Random date
            'title' => $this->faker->sentence(),
            'publication_date' => $this->faker->date(),
            'summary' => $this->faker->paragraph(),
            'text' => $this->faker->text(),
            'keywords' => implode(', ', $this->faker->words(5)), // Random keywords
            'main_image' => $this->faker->imageUrl(640, 480, 'news'), // Main image URL
            'side_image' => $this->faker->imageUrl(320, 240, 'news'), // Side image URL
            'editor_name' => $this->faker->name(), // Random editor name
            'editing_date' => $this->faker->date(), // Random editing date
        ];
    }
}
