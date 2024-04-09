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
        //
        Schema::create('ubicacion_tipo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ubicacion_id');
            $table->unsignedBigInteger('tipo_ubicacion_id');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
            $table->foreign('tipo_ubicacion_id')->references('id')->on('tipo_ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
