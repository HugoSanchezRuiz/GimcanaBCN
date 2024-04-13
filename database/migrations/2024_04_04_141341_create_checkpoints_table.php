<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpointsTable extends Migration
{
    public function up()
    {
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('gimcana_ubicaciones_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gimcana_ubicaciones_id')->references('id')->on('gimcana_ubicaciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkpoints');
    }
}
