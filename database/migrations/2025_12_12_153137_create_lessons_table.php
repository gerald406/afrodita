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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            // RELACIÓN: Pertenece a una sección (Módulo), NO directamente al curso
            $table->foreignId('course_section_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->string('slug'); // URL de la lección

            // Contenido:
            $table->string('video_url')->nullable(); // Link de YouTube/Vimeo o ruta local
            $table->string('video_iframe')->nullable(); // Código embed si es necesario
            $table->longText('content')->nullable(); // Descripción textual o artículo

            $table->integer('duration_minutes')->default(0); // Duración estimada

            // Checkbox para permitir ver esta clase gratis como "gancho"
            $table->boolean('is_free')->default(false);

            $table->integer('sort_order')->default(0); // Orden dentro del módulo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
