<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'scope_of_work' =>$this->faker->randomElement(explode(",","تأسیس, تطویر, تحلیل, قیاس, إشراف, أخرى")),
            'goal' => $this->faker->sentence(10),
            'summary' => $this->faker->paragraph(3),
            'stages' => $this->faker->sentence(8),
            'duration' => $this->faker->randomDigitNotNull . ' months',
        ];
    }
}
