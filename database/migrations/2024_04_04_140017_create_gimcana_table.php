<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimcanaTable extends Migration
{
    public function up()
    {
        Schema::create('gimcana', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_gimcana', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gimcana');
    }
}

