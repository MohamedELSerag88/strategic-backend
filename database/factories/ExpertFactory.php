<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'about' => $this->faker->paragraph(),
            'specialization' => $this->faker->randomElement(['Technology', 'Education', 'Health', 'Finance', 'Engineering']),
            'job' => $this->faker->jobTitle(),
            'practical_experiences' => $this->faker->text(200),
            'training_courses' => $this->faker->text(150),
            'academic_qualifications' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD', 'Diploma']),
            'research' => $this->faker->text(250),
            'nationality' => $this->faker->country(),
            'resident_country' => $this->faker->country(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
