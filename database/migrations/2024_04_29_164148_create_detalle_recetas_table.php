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
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_receta');
            $table->string('productos_solicitados');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('id_receta')->references('id')->on('receta_medica')->onDelete('cascade');
            $table->foreign('id_producto')->references('id')->on('medicamentos')->onDelete('cascade');
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
