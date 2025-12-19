<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();

            // Control de Tiempo
            $table->timestamp('started_at'); // Hora exacta de inicio
            $table->timestamp('completed_at')->nullable(); // Hora de finalización

            // Resultados
            $table->decimal('score_obtained', 8, 2)->nullable(); // Puntaje final
            $table->boolean('is_passed')->default(false); // Aprobado/Reprobado

            // Estado del intento
            // in_progress: Haciendo el examen
            // completed: Finalizado correctamente
            // timeout: Se acabó el tiempo
            // abandoned: Cerró la ventana y no volvió
            $table->enum('status', ['in_progress', 'completed', 'timeout', 'abandoned'])->default('in_progress');

            // UX: Guardar en qué pregunta se quedó para reanudar
            $table->integer('current_question_index')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
