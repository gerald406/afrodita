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
        // Tabla para Configuración General (Solo tendrá 1 registro)
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Mi LMS');
            $table->string('site_logo')->nullable(); // Path
            $table->string('site_favicon')->nullable(); // Path

            // Popup de comunicados
            $table->boolean('popup_active')->default(false);
            $table->string('popup_image')->nullable();
            $table->string('popup_link')->nullable(); // Si al dar clic lleva a algun lado

            $table->timestamps();
        });

        // Tabla para Sliders del Home
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('link_url')->nullable(); // Botón de acción
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_settings_tables');
    }
};
