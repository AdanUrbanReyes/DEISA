<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('numero');
            $table->string('razon_social', 150);
            $table->string('planta', 150);
            $table->string('empresa', 150);
            $table->unsignedInteger('direccion');
            $table->string('giro', 100);
            $table->string('rfc', 13)->nullable();
            $table->unsignedInteger('sae')->nullable();
            $table->string('proveedor', 20)->nullable();
            $table->enum('tipo', ['Matriz', 'Sucursal'])->default('Matriz');
            $table->enum('estado', ['Activo', 'Inactivo', 'Prospecto'])->default('Activo');
            $table->foreign('direccion')->references('id')->on('direccion')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
