<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lobbies_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lobby_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('lobby_id')->references('id')->on('lobbies')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('lobbies_user');
    }
};
