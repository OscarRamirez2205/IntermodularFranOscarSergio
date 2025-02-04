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
        Schema::create('centros_empresas', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_centro');
            $tabla->unsignedBigInteger('id_empresa');
            $tabla->string('nota');
            $tabla->timestamps();

            $tabla->foreign('id_centro')->references('id')->on('centros')->onDelete('cascade');
            $tabla->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
