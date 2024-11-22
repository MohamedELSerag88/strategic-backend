<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OpinionMeasurement>
 */
class OpinionMeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'subject' => $this->faker->word(), // Random word for the subject
            'domain' => $this->faker->word(), // Random word for the domain
            'targeted_segment' => $this->faker->word(), // Random word for targeted segment
            'geographical_scope' => $this->faker->city(), // Random city name for geographical scope
            'participants' => $this->faker->numberBetween(10, 100), // Random number of participants
            'start_date' => $this->faker->date(), // Random start date
            'end_date' => $this->faker->date(), // Random end date
            'expert_id' => \App\Models\Expert::factory(), // Assuming an Expert model exists and related
        ];
    }
}
