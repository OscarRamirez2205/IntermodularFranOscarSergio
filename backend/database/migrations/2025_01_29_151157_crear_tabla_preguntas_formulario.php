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
        Schema::create('preguntaformulario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_formulario')
                  ->constrained('formularios')
                  ->onDelete('cascade');
            $table->foreignId('id_pregunta')
                  ->constrained('preguntas')  // Cambiado de 'formularios' a 'preguntas'
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntaFormulario');
    }
};
