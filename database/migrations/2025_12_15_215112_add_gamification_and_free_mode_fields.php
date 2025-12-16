<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Configuración para "Modo Netflix" (Días Gratis)
        Schema::table('general_settings', function (Blueprint $table) {
            $table->boolean('free_mode_active')->default(false);
            $table->timestamp('free_mode_start')->nullable();
            $table->timestamp('free_mode_end')->nullable();
            $table->string('free_mode_message')->nullable(); // Ej: "¡Fin de semana gratis!"
        });

        // 2. Puntos en la tabla Users (Caché para no sumar el historial siempre)
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_points')->default(0)->after('role');
        });

        // 3. Tabla Historial de Puntos
        Schema::create('user_point_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points'); // Cantidad (ej: 100)
            $table->string('event_type'); // ej: 'lesson_completed', 'course_completed', 'bonus'
            $table->unsignedBigInteger('reference_id')->nullable(); // ID de la lección o curso
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_point_logs');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('total_points');
        });

        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['free_mode_active', 'free_mode_start', 'free_mode_end', 'free_mode_message']);
        });
    }
};
