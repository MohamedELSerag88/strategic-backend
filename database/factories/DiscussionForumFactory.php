<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscussionForum>
 */
class DiscussionForumFactory extends Factory
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
            'domain' =>$this->faker->randomElement(explode(",","قائمة: التخطیط, الإدارة, الإنتاج, المحتوى, المؤسسات, سیاسات التحریر, أخرى")), // Random word for the domain
            'start_date' => $this->faker->date(), // Random start date
            'end_date' => $this->faker->date(), // Random end date
        ];
    }
}
