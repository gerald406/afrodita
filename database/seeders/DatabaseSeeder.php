<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gerardino Cauna',
            'email' => 'gcauna@admin.com',
            'password' => bcrypt('gcauna@admin.com'),
        ]);

        $this->call([
            SettingSeeder::class, // Independiente
            UserSeeder::class,    // Usuarios necesarios para cursos
            CourseSeeder::class,  // Cursos -> Secciones -> Lecciones -> etc.
        ]);
    }
}
