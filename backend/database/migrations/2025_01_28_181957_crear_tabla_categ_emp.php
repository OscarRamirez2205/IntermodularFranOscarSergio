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
        Schema::create('categoriaEmpresa', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->unsignedBigInteger('id_categoria');
            $tabla->unsignedBigInteger('id_empresa');
            $tabla->timestamps();

            $tabla->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $tabla->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoriaEmpresa');
    }
};
