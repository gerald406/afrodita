<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();

            // Relación con la Pregunta
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();

            // Texto de la opción
            $table->string('answer_text');

            // ¿Es esta la respuesta correcta?
            $table->boolean('is_correct')->default(false);

            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_answers');
    }
};
