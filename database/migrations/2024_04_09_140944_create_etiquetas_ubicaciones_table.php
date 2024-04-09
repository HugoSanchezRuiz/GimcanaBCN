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
        Schema::create('etiquetas_ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->nullable();
            $table->unsignedBigInteger('etiqueta_id')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etiquetas_ubicaciones');
    }
};
