<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imagen_contenido')->default('NULL')->nullable();
            $table->longtext('contenido')->nullable();
            $table->mediumtext('urlvideo')->nullable();
            $table->longtext('descripcion_video')->nullable();
            $table->unsignedBigInteger('id_curso');
            $table->string('view')->default('NULL')->nullable();
            $table->foreign('id_curso')->references('id')->on('cursos');
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
        Schema::dropIfExists('intro');
    }
}
