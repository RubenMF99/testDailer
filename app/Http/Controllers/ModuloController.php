<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modulo;
use App\Curso;
use App\Persona;
use App\viewcurso;
use App\Contenido;
use App\Lectura;
use App\Preguntas;
use App\Respuesta;
use App\RespuestaPregunta;
use App\Examen;
use App\ExamenPregunta;
use App\Parcial;
use App\MisCursos;

class ModuloController extends Controller
{
    public function index(){
        return view('Modulos.index');
    }
    public function ListarModulos(Request $request){
        $data_course = $request->idcurso;
        $data_student = intval($request->student);
        $data_curso = Curso::where('url_curso','=',$data_course)->select('id_tipo_curso','nombre_curso')->take(1)->get();
        $data_modulos = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
        ->join('personas','cursos.id_instructor','=','personas.id')
        ->select('modulo.id as idmodulo','modulo.nombre','modulo.objetivo','modulo.video','modulo.material_apoyo','cursos.id as idcurso','personas.id as idpersona',
        'personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.correo_institucional')
        ->where('cursos.url_curso','=',$data_course)
        ->get();
        $data_modulo_count = DB::table('modulo')->join('cursos','modulo.id_curso','=','cursos.id')
        ->where('cursos.nombre_curso','=',$data_course)->count();
        $firts = true;
        $arrays = array();
        $id_modulo ='';
        $arrays2 = array();
        $arrayscontenido = array();
        $prueba = array();
        $count_modulos =0;
        $parcial = false;
        foreach($data_modulos as $models)
        {
            $data_view_modulo = viewcurso::where('view_cursos.id_estudiante','=',$data_student)
            ->where('view_cursos.id_curso','=',$models->idcurso)
            ->where('view_cursos.id_modulo','=',$models->idmodulo)
            ->get();

            // array_push($prueba,$data_view_modulo);
            if(count($data_view_modulo)>0)
            {
                // aca son los que estan en la base de datos
                $data = array("id"=>$models->idmodulo,"nombre" => $models->nombre,"icons"=>"fas fa-check",
                "style_div_principal"=>"padding:10px;text-align:center;cursor:pointer;",
                "style_icons"=>"color:#337ab7;float:right;top:5px;position:relative;",
                "style_num"=>"color:#337ab7; width:30px; height:30px;border-radius:50%; border:2px solid #337ab7;");
                array_push($arrays,$data);
                $count_modulos = ++$count_modulos;
                if($count_modulos==$data_modulo_count)
                {
                    $parcial = true;
                }
            }
            else{
                // 
                    
                    if($firts)
                    {
                            $data = array("id"=>$models->idmodulo,"nombre" => $models->nombre,"icons"=>"far fa-clock",
                        "style_div_principal"=>"color:#FF9821;border-left:4px solid #FF9821;-webkit-bos-sahdow:0px 0px 5px rgba(0,0,0,0.2);
                        -moz-box-shadow:0px 0px 5px rgba(0,0,0,0.2);box-shadow:0px 0px 5px rgba(0,0,0,0.2);padding:10px;text-align:center;cursor:pointer;",
                        "style_icons"=>"float:right;top:5px;position:relative;",
                        "style_num"=>"width:30px; height:30px;border-radius:50%; border:2px solid #ffffff;",
                        "view"=>"fas fa-play");
                        $id_modulo = $models->idmodulo;
                        $sentences = array("titulo"=>$models->nombre, "idmodulo"=>$id_modulo,"objetivo"=>$models->objetivo,"descrip_material_apoyo"=>$models->material_apoyo,
                        'idcurso'=>$models->idcurso, 'video'=> $models->video);
                        array_push($prueba,$sentences);
                        array_push($arrays,$data);
                        $firts = false;
                    }
                // aca son los que no se encuentran
            }
            $profe = array("id"=>$models->idpersona,"primer_nombre"=>$models->primer_nombre,"segundo_nombre"=>$models->segundo_nombre,"primer_apellido"=>$models->primer_apellido,
            "correo"=>$models->correo_institucional);
        }
        array_push($arrays2, $profe);
        $arrayscontenido = Contenido::join('lectura','contenido.id_lectura','=','lectura.id')->where('id_modulo','=',$id_modulo)->select('lectura.*')->get();
        return ['cantidad_Modulo'=>$data_modulo_count,"modulos"=>$arrays, "profesor"=>$arrays2,"contenido"=>$arrayscontenido, 
        "prueba" =>$prueba,'parcial'=>$parcial,'typeCourse'=>$data_curso[0]->id_tipo_curso,'cursoName'=>$data_curso[0]->nombre_curso];
    }
    public function img($data_imagen){
        $baseFromJavascript = $data_imagen['imagen'];
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
        $filepath = '../public/img/cursos/'.$data_imagen['name'];
        file_put_contents($filepath,$data);
    }

    public function store(Request $request){
        $boolState = false;
        $modulo = new Modulo();
        $modulo->nombre = $request->nombre;
        $modulo->id_curso = $request->curso;
        $modulo->objetivo = $request->objetivo;
        $modulo->video = $request->video;
        $modulo->material_apoyo = $request->material_apoyo;
        $modulo->valor_mod = $request->valormod;
        $modulo->save();
        if($boolState){
            foreach ($list as $item) {
                $lectura = new Lectura();
                // no editable---
                if($item['extension']=="pdf"){
                    $lectura->url ="/"."pdf/". $item['archivo'];
                }else if($item['extension'] == "docx"){
                    $lectura->url ="/"."word/". $item['archivo'];
                }
                $lectura->name_file = $item['archivo'];
                $lectura->tipo_archivo = $item['extension'];
                $lectura->descargar = 1; // no editable
                $lectura->state = $item['state']; // no editable
                $lectura->tipo_enlace = 'local'; //para url extarnas (editable)
                $lectura->save();
    
                $contenido = new Contenido();
                $contenido->id_modulo = $modulo->id;
                $contenido->id_lectura = $lectura->id;
                $contenido->save();
            }
        }
        return ['guarda'=>'guardo correctamente'];
    }
    public function storeQuiz(Request $request){
        $list = $request->preguresp;
        $curso = $request->curso;
        $data_result = Curso::where('id','=',$curso)->select('id_categoria')->take(1)->get();
        $examen = new Examen();
        $examen->save();
        foreach ($list as $itemP) {
            $pregunta = new Preguntas();
            $pregunta->enunciado = $itemP["pregunta"];
            $pregunta->valor = $itemP["valorPregunta"];
            $pregunta->id_tipo_pregunta = 2;
            $pregunta->id_categoria_cursos = $data_result[0]->id_categoria;
            $pregunta->save();

            $examPreg = new ExamenPregunta();
            $examPreg->id_examen = $examen->id;
            $examPreg->id_pregunta = $pregunta->id;
            $examPreg->save();

            foreach ($itemP["listRespuesta"] as $itemR) {
                $respuesta = new Respuesta();
                $respuesta->respuesta = $itemR["respuesta"];
                $respuesta->valor = $itemR["valor"];
                $respuesta->save();

                $repPregun = new RespuestaPregunta();
                $repPregun->id_pregunta = $pregunta->id;
                $repPregun->id_respuesta = $respuesta->id;
                $repPregun->respuesta = 0;
                $repPregun->save();
            }
        }

        $modulo = Modulo::where('id','=',$request->modulo)->take(1)->get();
        $modulo[0]->id_examen = $examen->id;
        $modulo[0]->time_examen = $request->time;
        $modulo[0]->intro_examen = $request->intro;
        $modulo[0]->save();
        return ["state"=>"Se ha guardador correctamente"];
    }

    
    public function storeParcial(Request $request){
        $list = $request->preguresp;
        $curso = $request->curso;
        $data_result = Curso::where('id','=',$curso)->select('id_categoria')->take(1)->get();
        $examen = new Examen();
        $examen->save();
        foreach ($list as $itemP) {
            $pregunta = new Preguntas();
            $pregunta->enunciado = $itemP["pregunta"];
            $pregunta->valor = $itemP["valorPregunta"];
            $pregunta->id_tipo_pregunta = 2;
            $pregunta->id_categoria_cursos = $data_result[0]->id_categoria;
            $pregunta->save();

            $examPreg = new ExamenPregunta();
            $examPreg->id_examen = $examen->id;
            $examPreg->id_pregunta = $pregunta->id;
            $examPreg->save();

            foreach ($itemP["listRespuesta"] as $itemR) {
                $respuesta = new Respuesta();
                $respuesta->respuesta = $itemR["respuesta"];
                $respuesta->valor = $itemR["valor"];
                $respuesta->save();

                $repPregun = new RespuestaPregunta();
                $repPregun->id_pregunta = $pregunta->id;
                $repPregun->id_respuesta = $respuesta->id;
                $repPregun->respuesta = 0;
                $repPregun->save();
            }
        }

        $parcial = new Parcial();
        $parcial->id_curso = $curso;
        $parcial->id_examen = $examen->id;
        $parcial->valor_part = $request->valor;
        $parcial->time_parcial = $request->time;
        $parcial->intr_parcial = $request->intro;
        $parcial->save();
        return ["state"=>"Se ha guardador correctamente"];
    }
    public function Listmod(Request $request){
        $data_consult = Modulo::where('id_examen','=',null)->where('id_curso','=',$request->curso)->select('id','nombre')->get();
        return ["modulos"=>$data_consult];
    }
    public function listarModulosCursos(Request $request){
        // curso a consultar para traer los modulos
        $usuario = intval($request->p);
        $data_consult = Curso::where('id_creador','=',$usuario)->select('id','nombre_curso','estado_curso')->orderBy('created_at','desc')->paginate(10);
        $arrayCursosMod = array();
        
        foreach($data_consult as $data)
        {
            $modu = array();
            $data_consult2 = Modulo::where('id_curso','=',$data->id)->get();
            foreach($data_consult2 as $item){
                $data_consult3 = Contenido::join('lectura','contenido.id_lectura','=','lectura.id')
                ->select('lectura.url','lectura.tipo_archivo','lectura.descargar','lectura.state')
                ->where('contenido.id_modulo','=',$item->id)
                ->get();
                $ArrContLect = array('lectura'=>$data_consult3,'modulo'=>$item);
                array_push($modu,$ArrContLect);
            }
            $ArrMod = array('id'=>$data->id,'nombre_curso'=>$data->nombre_curso, 'estado_curso'=>$data->estado_curso,'modulos'=>$modu);
            array_push($arrayCursosMod,$ArrMod);
        }
        return [
            'pagination' => [
                'total'        => $data_consult->total(),
                'current_page' => $data_consult->currentPage(),
                'per_page'     => $data_consult->perPage(),
                'last_page'    => $data_consult->lastPage(),
                'from'         => $data_consult->firstItem(), 
                'to'           => $data_consult->lastItem(),
            ],
            'listaModulos'=>$arrayCursosMod
        ];
        
    }
    public function listarModRepaso(Request $request){
        $curso = $request->urlcurso;
        $estudiante = $request->estudiante;
        $mod = $request->mod;
        $data_consult4 = Curso::join('mis_cursos','cursos.id','=','mis_cursos.id_curso')
        ->select('mis_cursos.state')
        ->where('cursos.url_curso','=',$curso)
        ->where('mis_cursos.id_estudiante','=',$estudiante)
        ->get();
        $data_consult = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
                ->where('cursos.url_curso','=',$curso)
                ->select('modulo.id','modulo.nombre')
                ->get();
        if(isset($mod)){
            if(empty($mod)){
                // consulta 1 sin modulo
                $data_consult2 = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
                ->where('cursos.url_curso','=',$curso)
                ->select('modulo.*')
                ->orderBy('modulo.nombre','asc')
                ->take(1)
                ->get();
                $arrayfinsih = array();
                foreach($data_consult2 as $item){
                    $data_consult3 = Modulo::join('contenido','modulo.id','=','contenido.id_modulo')
                    ->join('lectura','contenido.id_lectura','=','lectura.id')
                    ->where('modulo.id','=', $item->id)
                    ->where('lectura.state','=', 1)
                    ->select('lectura.*')
                    ->get();
                    $ListModuloLect = array('modulo'=>$item, 'lectura'=>$data_consult3);
                    array_push($arrayfinsih, $ListModuloLect);
                }
                return ['modulos'=>$data_consult,'modulosContent'=>$arrayfinsih, 'curso'=>$data_consult4];
            }else{
                // consulta 2 con modulo especifico
                $data_consult2 = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
                ->where('cursos.url_curso','=',$curso)
                ->where('modulo.id','=',$mod)
                ->select('modulo.*')
                ->get();
                $arrayfinsih = array();
                foreach($data_consult2 as $item){
                    $data_consult3 = Modulo::join('contenido','modulo.id','=','contenido.id_modulo')
                    ->join('lectura','contenido.id_lectura','=','lectura.id')
                    ->where('modulo.id','=', $item->id)
                    ->where('lectura.state','=', 1)
                    ->select('lectura.id','lectura.tipo_archivo','lectura.url','lectura.descargar')
                    ->get();
                    $ListModuloLect = array('modulo'=>$item, 'lectura'=>$data_consult3);
                    array_push($arrayfinsih, $ListModuloLect);
                }
                return ['modulos'=>$data_consult,'modulosContent'=>$arrayfinsih, 'curso'=>$data_consult4];
             
            }
        }else{
            // consulta 1 sin modulo
            $data_consult2 = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
            ->where('cursos.url_curso','=',$curso)
            ->select('modulo.*')
            ->orderBy('modulo.nombre','asc')
            ->take(1)
            ->get();
            $arrayfinsih = array();
            foreach($data_consult2 as $item){
                $data_consult3 = Modulo::join('contenido','modulo.id','=','contenido.id_modulo')
                ->join('lectura','contenido.id_lectura','=','lectura.id')
                ->where('modulo.id','=', $item->id)
                ->where('lectura.state','=', 1)
                ->select('lectura.*')
                ->get();
                
                $ListModuloLect = array('modulo'=>$item, 'lectura'=>$data_consult3);
                    array_push($arrayfinsih, $ListModuloLect);
            }
            return ['modulos'=>$data_consult,'modulosContent'=>$arrayfinsih, 'curso'=>$data_consult4];
        }
       
        
    }
}
