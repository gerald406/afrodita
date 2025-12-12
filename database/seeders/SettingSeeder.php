<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos tabla para no duplicar si corremos el seeder varias veces
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'LMS Laravel 12',
                'description' => 'Nombre de la plataforma',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'free_course_access_date',
                'value' => null, // '2023-12-25' para activar
                'description' => 'Fecha de puertas abiertas (YYYY-MM-DD)',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
