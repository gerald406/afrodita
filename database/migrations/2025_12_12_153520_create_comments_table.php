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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relacionado a una lección específica
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');

            $table->text('body'); // La pregunta o respuesta
            $table->boolean('is_approved')->default(true);

            // AUTO-REFERENCIA: Para permitir "Responder" a un comentario.
            // Si parent_id es NULL, es una pregunta nueva.
            // Si tiene valor, es una respuesta a otro comentario.
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('comments') // Apunta a esta misma tabla
                ->onDelete('cascade');    // Si borran la pregunta padre, se borran las respuestas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
