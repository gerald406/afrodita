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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->default('indigo'); // Para estilos css
            $table->timestamps();
        });

        // Agregar relación a la tabla cursos (si no la tienes ya)
        if (!Schema::hasColumn('courses', 'category_id')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
