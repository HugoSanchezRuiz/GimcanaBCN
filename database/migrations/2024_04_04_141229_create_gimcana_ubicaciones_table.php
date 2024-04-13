<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimcanaUbicacionesTable extends Migration
{
    public function up()
    {
        Schema::create('gimcana_ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gimcana_id')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->decimal('orden', 1, 0)->nullable();
            $table->timestamps();

            $table->foreign('gimcana_id')
                ->references('id')
                ->on('gimcana')
                ->onDelete('cascade'); // Eliminación en cascada cuando se borra una gimcana

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on('ubicaciones')
                ->onDelete('cascade'); // Eliminación en cascada cuando se borra una ubicación
        });
    }

    public function down()
    {
        Schema::dropIfExists('gimcana_ubicaciones');
    }
}
