<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempt_answers', function (Blueprint $table) {
            $table->id();

            // Vinculación al intento
            $table->foreignId('quiz_attempt_id')->constrained()->cascadeOnDelete();

            // Pregunta que se respondió
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();

            // Opción seleccionada por el alumno
            $table->foreignId('question_answer_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempt_answers');
    }
};
