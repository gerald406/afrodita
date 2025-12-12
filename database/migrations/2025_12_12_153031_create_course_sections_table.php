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
        Schema::create('course_sections', function (Blueprint $table) {
            $table->id();
            // RELACIÓN: Pertenece a un curso específico
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Ej: "Módulo 1: Introducción"

            // Ordenamiento: Para controlar qué módulo va primero (1, 2, 3...)
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_sections');
    }
};
