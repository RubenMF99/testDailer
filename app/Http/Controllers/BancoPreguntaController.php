<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Preguntas;
use App\RespuestaPregunta;

class BancoPreguntaController extends Controller
{
    public function listarBancoPreguntas(){
        $preguntas = Preguntas::join('tipo_pregunta','pregunta.id_tipo_pregunta','=','tipo_pregunta.id')->paginate(3);
        return [
            'pagination' => [
                'total'        => $preguntas->total(),
                'current_page' => $preguntas->currentPage(),
                'per_page'     => $preguntas->perPage(),
                'last_page'    => $preguntas->lastPage(),
                'from'         => $preguntas->firstItem(), 
                'to'           => $preguntas->lastItem(),
            ],
            'preguntas' => $preguntas
        ];

    }
    public function index(){
        return view('BancoPreguntas.index');
    }
    public function falsoVerdadero(Request $request){
        $campos = $request->campos;
        
        try{
            DB::beginTransaction();

            $pregunta = new Preguntas();
            $pregunta->enunciado = $campos['enunciado_pregunta'];
            $pregunta->id_categoria_cursos = $campos['id_categoria'];
            $pregunta->id_tipo_pregunta = 2;
            $pregunta->save();
        
            $respuestapregunta = new RespuestaPregunta();
            $respuestapregunta->id_pregunta = $pregunta->id;
            $respuestapregunta->respuesta = $campos['respuesta'];   
               
            $respuestapregunta->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        return $campos;
    }
}
