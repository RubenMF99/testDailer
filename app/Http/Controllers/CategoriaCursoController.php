<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CategoriaCurso;
use App\tipo_curso;
use App\Curso;
use App\Persona;
use App\Apoyan;
use App\MisCursos;

class CategoriaCursoController extends Controller
{
    public function ListarCategorias(){
        $categoria_curso = CategoriaCurso::where('estado_registro','=',1)->orderBy('nombre_categoria','asc')->get();
    $categoria = array();
      foreach ($categoria_curso as $categorias) {
            $numero_curso = DB::table('cursos')->where('id_categoria','=',$categorias->id)->count();
            if($numero_curso>=1)
            {
                $item_categoria = array('id'=>$categorias->id,'nombre_categoria'=> $categorias->nombre_categoria);
                array_push($categoria, $item_categoria);
            }
        }
        return['categoria'=>$categoria];

    }
    public function selectCategoria(){
        $categorias = CategoriaCurso::where('estado_registro','=',1)->get();
        return ['categorias' => $categorias];
    
    }

    public function ListarCategorias1(){
        $this->listar_Categoria_curso();
    }
    public function Listar_Categoria_curso(){
        $categoria = tipo_curso::select('id', 'nombre','descripcion','url_imagen')->where('id','<>',4)->paginate(4);
        $arraycursos=array();
        $estructura = array();
        $contenido = array();
        
        foreach($categoria as $cate){
                    $cursos = Curso::join('personas','cursos.id_instructor','=','personas.id')
                                    ->join('apoyan','cursos.apoya','=','apoyan.id')
                                    ->where('cursos.id_tipo_curso','=',$cate->id)
                                    ->where('cursos.estado_registro','=',1)
                                    ->where('id_tipo_curso','<>',4)
                                    ->select('cursos.id as id','cursos.nombre_curso as curso',
                                    'cursos.subtitulo_curso as descripcion','cursos.duracion_numero as duracion',
                                    'cursos.id_tipo_duracion as tiempo','cursos.id_tipo_curso as tipocategoria','cursos.imagen_destacada as imagen',
                                    'cursos.precio as precio', 'cursos.precio_venta as precioventa','apoyan.imagen_url as imgapoya','url_curso as url')
                                    ->orderBy('cursos.created_at','desc')->take(3)->get();
                    
                if(!is_null($cursos))
                {
                    if(sizeof($cursos)>0)
                    {
                        $estructura = array('categoria'=>$cate,'contenido_cate'=>$cursos);
                        array_push($arraycursos, $estructura);
                    }
                }
        }
        return ['Curos_Categorias' => $arraycursos];
    }
    public function Listar_Categoria_curso2(Request $request){
        $categoria = tipo_curso::where('nombre','=', $request->categoria)->select('id', 'nombre')->paginate(4);
        $arraycursos=array();
        $estructura = array();
        $contenido = array();
        
        foreach($categoria as $cate){
                    $cursos = Curso::join('personas','cursos.id_instructor','=','personas.id')
                                    ->join('apoyan','cursos.apoya','=','apoyan.id')
                                    ->where('cursos.id_tipo_curso','=',$cate->id)
                                    ->select('cursos.id as id','cursos.nombre_curso as curso',
                                    'cursos.subtitulo_curso as descripcion','cursos.duracion_numero as duracion',
                                    'cursos.id_tipo_duracion as tiempo','cursos.id_tipo_curso as tipocategoria','cursos.imagen_destacada as imagen',
                                    'cursos.precio as precio', 'cursos.precio_venta as precioventa','apoyan.imagen_url as imgapoya','url_curso as url')
                                    ->orderBy('id_tipo_curso','asc')->get();
                    
                if(!is_null($cursos))
                {
                    $estructura = array('categoria'=>$cate,'contenido_cate'=>$cursos);
                    array_push($arraycursos, $estructura);
                }
        }
        return ['Curos_Categorias' => $arraycursos];
    }

    public function verificarstate($curso){
        $data = MisCursos::where('id_curso','=',$curso)->where('id_estudiante','=',session()->get('id_person'))->select('state')->get();
        return['state'=>$data];
    }
}
