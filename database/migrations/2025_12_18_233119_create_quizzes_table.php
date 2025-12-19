<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

            // Relación: Un quiz pertenece a un Curso
            // Si se borra el curso, se borran sus exámenes (cascade)
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();

            // Relación opcional: Si el quiz pertenece a una lección específica (Bloqueo de avance)
            $table->foreignId('lesson_id')->nullable()->constrained()->nullOnDelete();

            // Información Básica
            $table->string('title'); // Título del examen
            $table->string('slug')->unique(); // URL amigable
            $table->text('description')->nullable(); // Instrucciones previas

            // Configuración de Tiempo
            $table->integer('duration_minutes')->default(60); // Tiempo límite (0 = ilimitado)
            $table->dateTime('start_time')->nullable(); // Fecha apertura (opcional)
            $table->dateTime('end_time')->nullable();   // Fecha cierre (opcional)

            // Reglas Académicas
            $table->integer('passing_score')->default(70); // Nota mínima para aprobar (Ej: 14 o 70)
            $table->integer('max_attempts')->default(3);   // Intentos permitidos (0 = ilimitado)

            // Configuración del Banco de Preguntas
            $table->boolean('is_randomized')->default(true); // ¿Las preguntas salen en orden aleatorio?
            $table->integer('questions_to_show')->default(10); // Cantidad de preguntas a tomar del banco total

            // Estado
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            $table->timestamps();
            $table->softDeletes(); // Papelera de reciclaje
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
