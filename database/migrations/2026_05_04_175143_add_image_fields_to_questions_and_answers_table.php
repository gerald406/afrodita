<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Tabla questions ──────────────────────────────────
        Schema::table('questions', function (Blueprint $table) {

            // Columna para imagen del enunciado
            $table->string('question_image')->nullable()->after('content');

            // CRÍTICO: content debe ser nullable para permitir
            // preguntas que solo tienen imagen (sin texto)
            $table->longText('content')->nullable()->change();
        });

        // ── Tabla question_answers ───────────────────────────
        Schema::table('question_answers', function (Blueprint $table) {

            // Columna para imagen de cada opción de respuesta
            $table->string('answer_image')->nullable()->after('answer_text');

            // CRÍTICO: answer_text debe ser nullable para permitir
            // respuestas que solo tienen imagen (sin texto)
            $table->string('answer_text')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('question_image');
            $table->longText('content')->nullable(false)->change();
        });

        Schema::table('question_answers', function (Blueprint $table) {
            $table->dropColumn('answer_image');
            $table->string('answer_text')->nullable(false)->change();
        });
    }
};
