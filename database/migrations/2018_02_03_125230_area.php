<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Area extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->string('nombre', 50);
            $table->string('departamento', 30);
            $table->string('supervisor', 191);
            $table->primary(['nombre', 'departamento']);
            $table->foreign('departamento')->references('nombre')->on('departamento')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supervisor')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area');
    }
}
