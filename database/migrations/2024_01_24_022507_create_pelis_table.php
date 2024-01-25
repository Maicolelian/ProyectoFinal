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
        Schema::create('pelis', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('lanzamiento', 255);
            $table->string('lenguaje', 255);
            $table->string('titulo_original', 255);
            $table->text('resumen');
            $table->string('poster', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelis');
    }
};
