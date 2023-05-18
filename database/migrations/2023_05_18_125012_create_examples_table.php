<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamplesTable extends Migration
{
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->id();
            $table->string('example');
            $table->string('answer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('examples');
    }
}