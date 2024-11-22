<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Expert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,  // Randomly pick a category
            'title' => $this->faker->sentence(),
            'specialization' => $this->faker->randomElement(explode(",","تخطیط, إدارة, أخرى")),
            'objective' => $this->faker->paragraph(),
            'main_axes' => $this->faker->text(200),
            'main_knowledge' => $this->faker->text(150),
            'main_skills' => $this->faker->text(150),
            'presentation_format' => $this->faker->randomElement(explode(",","عن بعد , حضوريا, فردية , أضافيه")),
            'duration' => $this->faker->numberBetween(1, 8),  // Random duration in hours
            'duration_type' => $this->faker->randomElement(['Hours', 'Days']),
            'price' => $this->faker->numberBetween(100, 1000),  // Random price
            'expert_id' => Expert::inRandomOrder()->first()->id,  // Randomly pick an expert
        ];
    }
}
