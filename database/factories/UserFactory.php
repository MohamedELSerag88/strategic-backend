<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'job' => $this->faker->jobTitle(),
            'password' => bcrypt('password'), // Default password
            'photo' => $this->faker->imageUrl(640, 480, 'people'), // Random image URL for photo
            'contact_type' => $this->faker->randomElement(explode(",","البرید الإلكتروني, الموبایل, الواتساب")), // Random contact type
            'notification' => $this->faker->boolean(), // Random boolean for notification setting
            'reset_password' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
