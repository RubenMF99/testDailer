<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longtext('enunciado');
            $table->unsignedBigInteger('id_tipo_pregunta');
            $table->foreign('id_tipo_pregunta')->references('id')->on('tipo_pregunta');
            $table->unsignedBigInteger('id_categoria_cursos');
            $table->foreign('id_categoria_cursos')->references('id')->on('categoria_cursos');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('user');
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
        Schema::dropIfExists('pregunta');
    }
}
