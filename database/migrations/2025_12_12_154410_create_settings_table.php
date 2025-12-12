<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Ej: 'free_access_date'
            $table->text('value')->nullable(); // Ej: '2023-12-25'
            $table->string('description')->nullable(); // Para que el admin sepa qué hace
            $table->timestamps();
        });

        // Insertamos la configuración inicial por defecto (Seeder ligero inline)
        DB::table('settings')->insert([
            'key' => 'free_course_access_date',
            'value' => null, // Por defecto no hay día gratis
            'description' => 'Fecha (YYYY-MM-DD) en la que todos los cursos son gratuitos para matricularse o ver.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
