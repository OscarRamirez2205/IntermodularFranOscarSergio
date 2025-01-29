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
        Schema::create('categoriaServicio', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_categoria');
            $tabla->unsignedBigInteger('id_servicio');
            $tabla->timestamps();

            $tabla->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $tabla->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoriaServicio');
    }
};
