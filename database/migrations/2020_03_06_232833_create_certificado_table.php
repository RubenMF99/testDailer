<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('id_estudiante');
                $table->string('cod_barras');
                $table->unsignedBigInteger('id_cursos');
                $table->unsignedBigInteger('id_profesor');
                $table->unsignedBigInteger('id_director');
                $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiante');
                $table->foreign('id_cursos')->references('id')->on('cursos');
                $table->foreign('id_profesor')->references('id_persona')->on('instructors');
                $table->foreign('id_director')->references('id_persona')->on('director');
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
        Schema::dropIfExists('certificado');
    }
}
