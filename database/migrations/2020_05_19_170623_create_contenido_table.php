<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_modulo');
            $table->foreign('id_modulo')->references('id')->on('modulo');
            $table->unsignedBigInteger('id_lectura');
            $table->foreign('id_lectura')->references('id')->on('lectura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenido');
    }
}
