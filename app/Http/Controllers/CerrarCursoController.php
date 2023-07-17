<?php

namespace App\Http\Controllers;
use App\Curso;

use Illuminate\Http\Request;

class CerrarCursoController extends Controller
{
    public function index(){
        return view('Cursos.Cerrar.index');
    }
    public function listarCursosCerrar(Request $request){
        $criterio = $request->criterio;
        $buscar = $request->buscar;

        if ($buscar==''){
    $cursos = Curso::select('cursos.*')->where('estado_registro','=','1')->where('estado_curso','<>','3')->orderBy('cursos.id', 'desc')->paginate(6);
    }else{
        $cursos = Curso::select('cursos.*',)->where('cursos.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('cursos.id', 'desc')->paginate(6);
    }
    return [
        'pagination' => [
            'total'        => $cursos->total(),
            'current_page' => $cursos->currentPage(),
            'per_page'     => $cursos->perPage(),
            'last_page'    => $cursos->lastPage(),
            'from'         => $cursos->firstItem(), 
            'to'           => $cursos->lastItem(),
        ],
        'cursos' => $cursos
    ];
    }
    public function desactivarCurso(Request $request){
        $curso = Curso::findOrFail( $request->id);
       $curso->estado_curso = 2;
       $curso->save();
    }
    public function activarCurso(Request $request){
        $curso = Curso::findOrFail( $request->id);
       $curso->estado_curso = 1;
       $curso->save();
    }
    
}
