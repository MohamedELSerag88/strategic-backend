<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
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
            'type' => $this->faker->randomElement(['Individual', 'Corporate', 'Student']),
            'duration' => $this->faker->randomElement(explode(",","سنة,سنتان")),
            'job' => $this->faker->jobTitle(),
            'nationality' => $this->faker->country(),  // Random country for nationality
            'resident_country' => $this->faker->country(),  // Random country for residence
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'password' => bcrypt('password'), // For simplicity, use a default password
            'contact_type' => $this->faker->randomElement(explode(",","البرید الإلكتروني, الموبایل, الواتساب")),
            'organization_name' => $this->faker->company(),
            'photo' => $this->faker->imageUrl(640, 480, 'people'),  // Generate random image URL for photo
        ];
    }
}
