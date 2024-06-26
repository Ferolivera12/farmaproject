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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('fecha_hora');
            $table->integer('cantidad');
            $table->float('precio_unitario');
            $table->float('importe_total');
            $table->string('estado');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_proveedor');


            // $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('id_proveedor')->references('id')->on('proveedor')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
