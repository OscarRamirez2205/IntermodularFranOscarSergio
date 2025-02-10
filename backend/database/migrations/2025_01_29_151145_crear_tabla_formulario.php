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
        Schema::create('formularios', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->string('nombre');
            $tabla->string('definicion');
            $tabla->string('tipo');
            $tabla->unsignedBigInteger('id_token');
            $tabla->timestamps();

            $tabla->foreign('id_token')->references('id')->on('tokens')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
