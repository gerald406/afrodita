<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_user', function (Blueprint $table) {
            // Clave compuesta para evitar duplicados (un usuario solo completa una lección una vez)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');

            // Fecha de finalización (útil para reportes)
            $table->timestamp('completed_at')->useCurrent();

            $table->primary(['user_id', 'lesson_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_user');
    }
};
