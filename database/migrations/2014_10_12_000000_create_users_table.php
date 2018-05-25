<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('email', 191);
            $table->string('password', 255);
            $table->string('name', 30);
            $table->string('primer_apellido', 30);
            $table->string('segundo_apellido', 30);
            $table->string('departamento', 30);
            $table->string('puesto', 10);
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->primary('email');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
