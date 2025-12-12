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
        Schema::create('lesson_resources', function (Blueprint $table) {
            $table->id();
            // RELACIÓN: Pertenece a una lección
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Ej: "Diapositivas PDF" o "Enlace de interés"

            // Tipo de recurso para saber qué ícono mostrar en el frontend
            $table->enum('type', ['pdf', 'link', 'zip', 'image'])->default('pdf');

            // Almacenamos la URL o la ruta del archivo.
            // Si es archivo local: 'resources/curso1/guia.pdf'
            // Si es link: 'https://google.com'
            $table->string('path_or_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_resources');
    }
};
