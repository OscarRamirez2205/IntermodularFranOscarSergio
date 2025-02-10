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
        Schema::create('solicitudes_ciclos', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_solicitud');
            $tabla->unsignedBigInteger('id_ciclo');
            $tabla->integer('numPuestos');
            $tabla->timestamps();

            $tabla->foreign('id_solicitud')->references('id')->on('solicitudes')->onDelete('cascade');
            $tabla->foreign('id_ciclo')->references('id')->on('ciclos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_ciclos');
    }
};
