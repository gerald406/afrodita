<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            // Relación: Pertenece a un Quiz
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();

            // Contenido
            // Usamos longText para permitir HTML extenso del editor WYSIWYG (imágenes base64 o links)
            $table->longText('content');

            // Tipo de pregunta
            $table->enum('type', ['multiple_choice', 'true_false', 'single_choice'])->default('single_choice');

            // Puntos: Cuánto vale esta pregunta (Ej: 2 puntos)
            $table->integer('points')->default(1);

            // Retroalimentación (Opcional): Explicación que se muestra al finalizar
            $table->text('feedback')->nullable();

            $table->integer('sort_order')->default(0); // Para ordenar si no es aleatorio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
