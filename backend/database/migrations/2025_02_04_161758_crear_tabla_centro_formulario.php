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
        Schema::create('centroFormulario', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_formulario');
            $tabla->unsignedBigInteger('id_centro');
            $tabla->timestamps();

            $tabla->foreign('id_formulario')->references('id')->on('preguntas')->onDelete('cascade');
            $tabla->foreign('id_centro')->references('id')->on('centros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centroFormulario');
    }
};
