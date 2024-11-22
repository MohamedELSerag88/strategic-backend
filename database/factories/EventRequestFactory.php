<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRequest>
 */
class EventRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::inRandomOrder()->first()->id,  // Randomly pick an event
            'event_type' => $this->faker->randomElement(['Online', 'In-Person', 'Hybrid']),
            'event_presentation' => $this->faker->randomElement(explode(",","عن بعد , حضوريا, فردية , أضافيه")),
            'name' => $this->faker->name(),
            'job' => $this->faker->jobTitle(),
            'org_type' => $this->faker->randomElement(explode(",","علامیة, غیر إعلامیة")),
            'phone' => $this->faker->phoneNumber(),
            'org_name' => $this->faker->company(),
            'headquarter_country' => $this->faker->country(),  // Random country from the Country model
            'event_country' => $this->faker->country(),  // Random event country
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'notes' => $this->faker->text(200),
        ];
    }
}
