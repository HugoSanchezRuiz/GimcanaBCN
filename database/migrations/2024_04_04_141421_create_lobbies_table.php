<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLobbiesTable extends Migration
{
    public function up()
    {
        Schema::create('lobbies', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_lobby');
            $table->unsignedBigInteger('gimcana_id');
            $table->string('lobbies_codigo')->nullable();
            $table->enum('estado', ['ocupada', 'libre'])->default('libre');
            $table->integer('capacidad')->default(4); // Capacidad máxima de usuarios en el lobby
            $table->timestamps();

            $table->foreign('gimcana_id')->references('id')->on('gimcana')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lobbies');
    }
}

