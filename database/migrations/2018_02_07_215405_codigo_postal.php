<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodigoPostal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_postal', function (Blueprint $table) {
            $table->increments('id');
            $table->char('codigo_postal', 5);
            $table->string('estado', 40);
            $table->string('municipio', 60);
            $table->string('asentamiento', 70);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigo_postal');
    }
}
