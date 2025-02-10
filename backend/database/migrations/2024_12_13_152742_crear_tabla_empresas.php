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
            $tabla->string('cif')->unique();
            $tabla->string('descripcion');
            $tabla->string('imagen');
            $tabla->string('notas');
            $tabla->string('email')->unique();
            $tabla->string('direccion_calle');
            $tabla->string('direccion_provincia');
            $tabla->float('direccion_lat');
            $tabla->float('direccion_log');
            $tabla->string('provincia');
            $tabla->string('poblacion');
            $tabla->int('vacantes');
            $tabla->string('horario_inicio');
            $tabla->string('horario_fin');
            $tabla->string('password');
            $tabla->timestamps();


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
