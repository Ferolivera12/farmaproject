<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('medicamento_departamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddepartamento');
            $table->unsignedBigInteger('idmedicamento');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('iddepartamento')->references('id')->on('departamentos')->onDelete('cascade');
            $table->foreign('idmedicamento')->references('id')->on('medicamentos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamento_departamento');
    }
};
