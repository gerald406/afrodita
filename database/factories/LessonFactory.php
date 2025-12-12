<?php

namespace Database\Factories;

use App\Models\CourseSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(5);
        return [
            'course_section_id' => CourseSection::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Placeholder video
            'content' => $this->faker->text(500),
            'duration_minutes' => rand(5, 60),
            'is_free' => $this->faker->boolean(20), // 20% prob. de ser gratis
            'sort_order' => 0,
        ];
    }
}
