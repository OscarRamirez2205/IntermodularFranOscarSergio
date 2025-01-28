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
        Schema::create('empresas', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->string('nombre');
            $tabla->string('descripcion');
            $tabla->string('email')->unique();
            $tabla->string('password');
            $tabla->string('direccion');
            $tabla->string('coordenadas');
            $tabla->string('cif')->unique();
            $tabla->string('provincia');
            $tabla->string('poblacion');
            $tabla->string('usuario');

            $tabla->foreign('usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
