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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // RELACIONES: Quién comenta y qué curso
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            // Valoración de 1 a 5 (usamos tinyInteger para optimizar espacio)
            $table->unsignedTinyInteger('rating');

            $table->boolean('is_approved')->default(true); // Por defecto aprobado

            $table->text('comment')->nullable(); // Opinión escrita (opcional)

            $table->timestamps();

            // REGLA DE NEGOCIO: Un usuario solo puede valorar 1 vez el mismo curso
            $table->unique(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
