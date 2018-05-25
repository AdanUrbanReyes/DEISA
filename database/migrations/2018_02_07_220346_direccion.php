<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Direccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle', 70);
            $table->unsignedSmallInteger('numero_exterior');
            $table->unsignedSmallInteger('numero_interior')->nullable();
            $table->unsignedInteger('codigo_postal');
            $table->foreign('codigo_postal')->references('id')->on('codigo_postal')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
