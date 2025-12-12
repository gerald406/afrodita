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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // RELACIÓN: Un curso pertenece a un profesor (User)
            // constrained() crea la llave foránea automáticamente apuntando a 'users'.
            // onDelete('cascade') significa que si borramos al profesor, se borran sus cursos (opcional, pero limpio).
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // RELACIÓN: Categoría (Asumiendo que tienes una tabla categories, si no, crearla antes o poner nullable)
            // $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); 

            $table->string('title'); // Título del curso
            $table->string('slug')->unique(); // URL amigable (ej: curso-de-laravel-12)
            $table->text('description')->nullable(); // Descripción larga (HTML o Markdown)

            $table->string('image_path')->nullable(); // Imagen destacada del curso

            // Precios con 10 dígitos total, 2 decimales (ej: 99999999.99)
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('compare_price', 10, 2)->nullable(); // Precio "antes" (para ofertas)

            // Estado del curso: Borrador, Publicado, Archivado
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
