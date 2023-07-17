<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_examen');
            $table->longtext('intr_parcial');
            $table->string('valor_part');
            $table->string('time_parcial');
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->foreign('id_examen')->references('id')->on('examen');
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
        Schema::dropIfExists('parcial');
    }
}
