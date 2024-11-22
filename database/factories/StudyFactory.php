<?php

namespace Database\Factories;

use App\Models\Expert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Study>
 */
class StudyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(), // Random word for type
            'title' => $this->faker->sentence(), // Random sentence for title
            'expert_id' => Expert::factory(), // Random expert (assuming you have an Expert factory)
            'specialization' => $this->faker->word(), // Random word for specialization
            'page_numbers' => $this->faker->numberBetween(20, 500), // Random page number between 20 and 500
            'publication_date' => $this->faker->date(), // Random publication date
            'main_topics' => $this->faker->words(3, true), // Random 3 words for main topics
            'summary' => $this->faker->paragraph(), // Random paragraph for summary
            'file' => $this->faker->filePath(), // Random file path
        ];
    }
}
