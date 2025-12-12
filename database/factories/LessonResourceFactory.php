<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonResourceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'title' => 'Recurso: ' . $this->faker->words(3, true),
            'type' => $this->faker->randomElement(['pdf', 'link']),
            'path_or_url' => $this->faker->url(),
        ];
    }
}
