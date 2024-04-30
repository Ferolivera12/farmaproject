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
        Schema::create('medicamento_departamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_departamento');
            $table->unsignedBigInteger('id_medicamento');
            $table->timestamps();

            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('cascade');
            $table->foreign('id_medicamento')->references('id')->on('medicamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamento_departamento');
    }
};
