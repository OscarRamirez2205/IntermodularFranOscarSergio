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
       Schema::create('solicitudes', function(Blueprint $tabla){
            $tabla->id();
            $tabla->unsignedBigInteger('id_centro_empresa');
            $tabla->timestamps();

            $tabla->foreign('id_centro_empresa')->references('id')->on('centros_empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
