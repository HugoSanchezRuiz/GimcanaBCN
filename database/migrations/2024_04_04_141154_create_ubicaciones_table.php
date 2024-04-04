<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionesTable extends Migration
{
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->string('calle', 50)->nullable();
            $table->string('num_calle', 3)->nullable();
            $table->string('codigo_postal', 5)->nullable();
            $table->string('ciudad', 255)->nullable();
            $table->string('Pista', 255)->nullable();
            $table->decimal('contador_likes', 5, 2)->nullable();
            $table->unsignedBigInteger('tipo_ubicacion_id')->nullable();
            $table->string('latitud', 255)->nullable();
            $table->string('longitud', 255)->nullable();
            $table->timestamps();

            $table->foreign('tipo_ubicacion_id')->references('id')->on('tipo_ubicaciones');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ubicaciones');
    }
}

