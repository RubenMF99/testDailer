<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosAprederanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_aprederan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cursos');
            $table->unsignedBigInteger('id_que_aprederan');

            $table->primary(['id_cursos', 'id_que_aprederan']);
            $table->foreign('id_cursos')->references('id')->on('cursos');
            $table->foreign('id_que_aprederan')->references('id')->on('que_aprendistes');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos_aprederan');
    }
}
