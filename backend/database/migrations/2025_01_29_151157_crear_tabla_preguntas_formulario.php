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
        Schema::create('preguntaFormulario', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_formulario');
            $tabla->unsignedBigInteger('id_pregunta');
            $tabla->timestamps();

            $tabla->foreign('id_formulario')->references('id')->on('preguntas')->onDelete('cascade');
            $tabla->foreign('id_pregunta')->references('id')->on('formularios')->onDelete('cascade');
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
