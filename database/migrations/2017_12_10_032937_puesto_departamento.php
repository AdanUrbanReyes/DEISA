<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuestoDepartamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_departamento', function (Blueprint $table) {
            $table->string('departamento', 30);
            $table->string('puesto', 16);
            $table->primary(['departamento', 'puesto']);
            $table->foreign('departamento')->references('nombre')->on('departamento')->onUpdate('cascade')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE users ADD FOREIGN KEY (departamento, puesto) REFERENCES puesto_departamento(departamento, puesto) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puesto_departamento');
    }
}
