<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        return [
            'user_id' => User::factory(), // Crea un instructor por defecto si no se pasa
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(100, 999), // Slug único
            'description' => $this->faker->paragraphs(3, true),
            'image_path' => 'https://via.placeholder.com/640x480.png/007799?text=Curso+Laravel',
            'price' => $this->faker->randomElement([19.99, 49.99, 99.00, 0.00]),
            'compare_price' => $this->faker->randomElement([120.00, 150.00, null]),
            'status' => 'published',
        ];
    }
}
