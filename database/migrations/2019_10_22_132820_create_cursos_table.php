<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_curso');
            $table->string('subtitulo_curso');
            $table->longtext('descripcion');
            $table->string('url_curso');
            $table->integer('estudiante_maximo')->nullable();
            $table->integer('estudiantes_inscritos')->nullable();
            $table->boolean('destacado')->nullable();
            $table->boolean('visualizar_leciones')->nullable();
            $table->integer('estado_curso')->nullable();
            $table->integer('duracion_numero')->nullable();
            $table->unsignedBigInteger('id_tipo_duracion')->nullable();
            $table->foreign('id_tipo_duracion')->references('id')->on('tipo_duracions');
            $table->string('imagen_destacada')->nullable();
            $table->decimal('precio')->nullable();
            $table->decimal('precio_venta')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->unsignedBigInteger('id_nivel')->nullable();
            $table->foreign('id_nivel')->references('id')->on('nivels');
            $table->unsignedBigInteger('id_tipo_curso')->nullable();
            $table->foreign('id_tipo_curso')->references('id')->on('tipo_curso');
            $table->unsignedBigInteger('id_instructor')->nullable();
            $table->foreign('id_instructor')->references('id')->on('instructors');
            $table->string('contenido_principal')->nullable();
            $table->date('fecha_inicial');
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
        Schema::dropIfExists('cursos');
    }
}
