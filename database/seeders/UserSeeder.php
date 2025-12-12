<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear ADMIN principal (para que tú entres)
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@lms.com',
            'password' => Hash::make('password'), // Clave genérica
            'role' => 'admin',
            'dni' => '00000001',
        ]);

        // 2. Crear INSTRUCTOR de prueba
        User::create([
            'name' => 'Profesor Demo',
            'email' => 'profe@lms.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'dni' => '00000002',
            'bio' => 'Ingeniero de Software Senior experto en Laravel.',
        ]);

        // 3. Crear ESTUDIANTE de prueba
        User::create([
            'name' => 'Estudiante Demo',
            'email' => 'alumno@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'dni' => '00000003',
        ]);

        // 4. Crear 20 estudiantes extra aleatorios
        User::factory(20)->create(['role' => 'student']);
    }
}
