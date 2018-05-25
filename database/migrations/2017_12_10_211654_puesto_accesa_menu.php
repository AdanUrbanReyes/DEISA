<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuestoAccesaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_accesa_menu', function (Blueprint $table) {
            $table->string('departamento', 30);
            $table->string('puesto', 10);
            $table->string('menu', 40);
            $table->primary(['departamento', 'puesto', 'menu']);
            $table->foreign(['departamento', 'puesto'])->references(['departamento', 'puesto'])->on('puesto_departamento')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu')->references('titulo')->on('menu')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puesto_accesa_menu');
    }
}