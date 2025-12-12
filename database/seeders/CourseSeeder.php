<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos al profesor que creamos antes
        $instructor = User::where('email', 'profe@lms.com')->first();
        // Obtenemos alumnos
        $students = User::where('role', 'student')->get();

        // --- CURSO 1: Laravel 12 Completo ---
        $course1 = Course::create([
            'user_id' => $instructor->id,
            'title' => 'Master en Laravel 12 desde Cero',
            'slug' => 'master-laravel-12',
            'description' => 'Aprende a crear aplicaciones modernas con la última versión de Laravel.',
            'price' => 49.99,
            'status' => 'published',
            'image_path' => 'https://lms-demo.com/images/laravel.jpg',
        ]);

        // Crear 3 Secciones para este curso
        $sections = CourseSection::factory(3)
            ->sequence(
                ['title' => 'Introducción y Configuración', 'sort_order' => 1],
                ['title' => 'Base de Datos y Eloquent', 'sort_order' => 2],
                ['title' => 'Vistas Avanzadas con Blade', 'sort_order' => 3],
            )
            ->create(['course_id' => $course1->id]);

        // Para cada sección, crear 4 lecciones
        foreach ($sections as $section) {
            $lessons = Lesson::factory(4)->create([
                'course_section_id' => $section->id
            ]);

            // Para cada lección, adjuntar recursos y comentarios
            foreach ($lessons as $lesson) {
                // 1 Recurso PDF
                \App\Models\LessonResource::factory()->create([
                    'lesson_id' => $lesson->id,
                    'type' => 'pdf',
                    'title' => 'Diapositivas de clase'
                ]);

                // 2 Comentarios de alumnos random
                Comment::factory(2)->create([
                    'lesson_id' => $lesson->id,
                    'user_id' => $students->random()->id,
                ]);
            }
        }

        // Matricular 10 alumnos en este curso
        foreach ($students->take(10) as $student) {
            $course1->students()->attach($student->id, [
                'enrolled_at' => now(),
                'price_paid' => 49.99,
                'status' => 'active'
            ]);

            // Dejar una valoración (Review)
            Review::create([
                'user_id' => $student->id,
                'course_id' => $course1->id,
                'rating' => rand(4, 5),
                'comment' => 'Excelente curso, muy recomendado.'
            ]);
        }

        // --- Crear 5 cursos de relleno extra ---
        Course::factory(5)->create(['user_id' => $instructor->id]);
    }
}
