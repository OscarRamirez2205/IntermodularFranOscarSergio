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
        Schema::create('usuarios', function(BluePrint $tabla) {
            $tabla->id();
            $tabla->string('nombre');
            $tabla->string('NIF')->unique();
            $tabla->string('email');
            $tabla->string('password');
            $tabla->string('centro');

            $tabla->foreign('centro')->references('id')->on('centros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
