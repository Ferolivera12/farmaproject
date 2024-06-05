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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fechavencimiento');
            $table->unsignedBigInteger('categoria_id');
            $table->decimal('precio', 8, 2);
            $table->string('laboratorio');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')
                ->onDelete('cascade');  // Esta línea asegura que cuando una categoría es eliminada, sus medicamentos también se eliminan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
