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
        Schema::create('detalle_recetas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medicamento');
            $table->unsignedBigInteger('id_receta');
            $table->string('productos_solicitados');
            $table->integer('cantidad');
            $table->foreign('id_receta')->references('id')->on('receta_medicas')->onDelete('cascade');
            $table->foreign('id_medicamento')->references('id')->on('medicamentos')->onDelete('cascade');
            $table->string('producto_solicitado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_recetas');
    }
};
