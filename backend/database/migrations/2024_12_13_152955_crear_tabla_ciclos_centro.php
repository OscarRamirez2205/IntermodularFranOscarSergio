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
        Schema::create('ciclosCentro', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_centro');
            $tabla->unsignedBigInteger('id_ciclo');

            $tabla->foreign('id_centro')->references('id')->on('centros')->onDelete('cascade');
            $tabla->foreign('id_ciclo')->references('id')->on('ciclos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
