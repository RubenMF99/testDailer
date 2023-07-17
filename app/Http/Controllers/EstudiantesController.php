<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Persona;
use App\Estudiantes;
use App\MisCursos;
use App\instructor;
use App\viewcurso;
use App\Modulo;
use App\Examen;
use App\ExamenPregunta;
use App\Preguntas;
use App\Respuesta;
use App\RespuestaPregunta;
use App\Notas;
use App\Parcial;
use App\certificado;
use App\Curso;
use App\Director;


class EstudiantesController extends Controller
{
    public function index(){
        return view('Estudiantes.index');
    }
    //Buscar Estudiante 
    public function listarEstudiantes(Request $request){
        $criterio = $request->criterio;
        $buscar = $request->buscar;
        if ($buscar==''){
            $estudiantes = Estudiantes::join('personas','estudiante.id_personas','=','personas.id')
            ->select('personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido','personas.telefono',
            'personas.direccion','personas.fecha_nacimiento','estudiante.estado_registro','estudiante.id_personas')->paginate(3);
        }else{
            $estudiantes = Estudiantes::join('personas','estudiante.id_personas','=','personas.id')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $estudiantes->total(),
                'current_page' => $estudiantes->currentPage(),
                'per_page'     => $estudiantes->perPage(),
                'last_page'    => $estudiantes->lastPage(),
                'from'         => $estudiantes->firstItem(), 
                'to'           => $estudiantes->lastItem(),
            ],
            'estudiantes' => $estudiantes
        ];
    }
    //Guardar Estudiante
    public function store(Request $request){
        $campos = $request->campos;
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->primer_nombre = $campos['primer_nombre'];
            $persona->segundo_nombre = $campos['segundo_nombre'];
            $persona->primer_apellido = $campos['primer_apellido'];
            $persona->segundo_apellido = $campos['segundo_apellido'];
            $persona->telefono = $campos['telefono'];
            $persona->direccion = $campos['direccion'];
            $persona->fecha_nacimiento = $campos['fecha_nacimiento'];
            $persona->save();
            $estudiante = new Estudiantes();
            $estudiante->id_personas = $persona->id;
            $estudiante->id_estudiante = $persona->id;          
            $estudiante->save();
            $User = new User();
            $User->id_user = $persona->id;
            $User->email = $campos['email'];
            $User->password = $campos['password'];
            $User->estado_registro = '1';
            $User->idrol = '3';
            $User->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        return $campos;
    }
    //Desactivar estudiante y cambiar su estado a 0
    public function desactivarEstudiante(Request $request){
     
        $curso = Estudiantes::findOrFail($request->id);
       $curso->estado_registro = 0;
       $curso->save();
    }
    //Desactivar estudiante y cambiar su estado a 1
    public function activarEstudiante(Request $request){
     
        $curso = Estudiantes::findOrFail($request->id);
       $curso->estado_registro = 1;
       $curso->save();
    }
    //Buscar mis cursos y listarlos por estudiante
   
    public function viewintrobool(Request $request){
        $sql = viewcurso::where('id_curso','=',$request->idcurso)->where('id_estudiante','=', $request->estudiante)->take(1)->get()->count();
        $sentences = MisCursos::where('id_estudiante','=',$request->estudiante)->where('id_curso','=',$request->idcurso)->take(1)->get();
        if($sentences[0]->state==0){
            $sentences[0]->state = 1;
            $sentences[0]->save(); 
        }
        if($sql>0)
        {
            return ['visto'=>1];
        }else{
            return ['visto'=>0];
        }
    }
    public function viewintro(Request $request)
    {
        $idintro = $request->intro;
        $idcurso = $request->curso;
        $estudiante = intval($request->estudiante);
        try {
            DB::beginTransaction();
            $intro = new viewcurso();
            $intro->id_curso = $idcurso;
            $intro->id_estudiante = $estudiante;
            $intro->id_introduccion = $idintro;
            $intro->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    public function exam(Request $request){
        $data_modulo = $request->modulo;
        $data_curso = $request->curso;
        $response = Modulo::join('examen','modulo.id_examen','=','examen.id')
        ->join('examne_pregunta','examen.id','=','examne_pregunta.id_examen')
        ->join('pregunta','examne_pregunta.id_pregunta','=','pregunta.id')
        ->select('pregunta.id','pregunta.enunciado','pregunta.id_tipo_pregunta','pregunta.valor','modulo.time_examen','modulo.intro_examen')
        ->where('modulo.id','=',$data_modulo)
        ->where('modulo.id_curso','=',$data_curso)
        // ->orderBy('pregunta.id','asc')
        ->orderByRaw('RAND()')
        ->get();
        $answers = array();
        foreach($response as $dt){
            $responsedt = RespuestaPregunta::join('pregunta','respuesta_pregunta.id_pregunta','=','pregunta.id')
            ->join('respuestas','respuesta_pregunta.id_respuesta','=','respuestas.id')
            ->select('respuestas.id','respuestas.respuesta','respuestas.valor')
            ->where('pregunta.id','=',$dt->id)
            ->orderByRaw('RAND()')
            ->get();
            if(strlen((string)$dt->valor)===1){
                $valor = $dt->valor. '.0';
            }else{
                $valor = $dt->valor;
            }
            $newdt = array('id'=>$dt->id,'title'=>$dt->enunciado,'listData'=>$responsedt,'type'=>$dt->id_tipo_pregunta,'valor'=>$valor);
            array_push($answers,$newdt);
        }

        return ['arrayquiz'=>$answers,'timer'=>$response[0]->time_examen];
    }
    public function gQuiz(Request $request)
    {
        date_default_timezone_set('UTC');
        $data_nota = $request->nota;
        $data_curso = $request->curso;
        $data_Estudiante = intval($request->estudiante);
        $data_QoP='';
        try {
            DB::beginTransaction();
            $nota = new Notas();
            $nota->nota = $data_nota;
            $nota->id_estudiante = $data_Estudiante;
            if($request->vparcial)
            {
                // guardar parcial
                $data_modulo = $request->parcial;
                $nota->id_parcial = $data_modulo;
                $nota->id_modulo = 0;
                $nota->save();
                $sqlmis_cursos = MisCursos::where('id_curso','=',$data_curso)->where('id_estudiante','=',$data_Estudiante)->take(1)->get();
                $sqlmis_cursos[0]->state = 2;
                $sqlmis_cursos[0]->save();

                // guardar certificado
                $consult_profe = Curso::where('id','=',$data_curso)->select('id_instructor')->take(1)->get();
                $consult_Direct = Director::select('id_persona')->take(1)->get();
                $certificado = new  certificado();
                $certificado->id_estudiante = $data_Estudiante;
                $date_now = date('Y');
                $hora = date('hi');
                $mes = date('n');
                $certificado->cod_barras =  $date_now.$data_Estudiante.$data_curso."-".$mes;
                $certificado->id_cursos = $data_curso;
                $certificado->id_profesor = $consult_profe[0]->id_instructor;
                $certificado->id_director = $consult_Direct[0]->id_persona;
                $certificado->save();
                $data_QoP='parcial';

            }else{
                $data_modulo = $request->idmodulo;
                $nota->id_modulo = $data_modulo;
                $nota->id_parcial = 0;
                $nota->save();
                $intro = new viewcurso();
                $intro->id_curso = $data_curso;
                $intro->id_estudiante = $data_Estudiante;
                $intro->id_modulo = $data_modulo;
                $intro->save();
                $data_QoP='quiz';
            }
            DB::commit();
            return ['guardado'=>'Felicidades haz ganado tu '.$data_QoP.', tu nota es: '.$data_nota];

        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    public function notas(Request $request)
    {
        $data_curso = $request->idcurso;
        $data_Estudiante = intval($request->estudiante);
        $data_consult = Modulo::select('modulo.*')->where('modulo.id_curso','=',$data_curso)->get();
        $data_parcials = Parcial::select('parcial.*')->where('parcial.id_curso','=',$data_curso)->get();
        $arraynotas = array();
        $arraythead = array();
        $suma_notas = 0;
        $total_notas = 0;
        foreach($data_consult as $items)
        {
            $data_head = array('thmodulo'=>$items->nombre."  (".$items->valor_mod."%)");
            array_push($arraythead,$data_head);
            $data_consult2 = Notas::select('notas.nota')->where('notas.id_modulo','=',$items->id)
            ->where('notas.id_estudiante','=',$data_Estudiante)->get();
            if(count($data_consult2)>0)
            {
                $data_new = array('modulo'=>$data_consult2[0]->nota);
                $suma_notas = ($data_consult2[0]->nota * $items->valor_mod)/100 + $suma_notas;
                array_push($arraynotas,$data_new);
            }else{
                $data_new = array('modulo'=>'---');
                $suma_notas = 0 + $suma_notas;
                array_push($arraynotas,$data_new);
            }
        }
        $data_parcial = Notas::join('parcial','notas.id_parcial','=','parcial.id')
        ->select('notas.*','parcial.valor_part')->where('parcial.id_curso','=',$data_curso)
        ->where('notas.id_estudiante','=',$data_Estudiante)->get();
        if(count($data_parcial)>0){
            $data_new = array('modulo'=>$data_parcial[0]->nota);
            $suma_notas = ($data_parcial[0]->nota * $data_parcial[0]->valor_part)/100 + $suma_notas;
            $data_head = array('thmodulo'=>'parcial  ('.$data_parcial[0]->valor_part.'%)');
            array_push($arraynotas,$data_new);
        }else{
            $data_new = array('modulo'=>'---');
            $suma_notas = 0 + $suma_notas;
            $data_head = array('thmodulo'=>'parcial 40%');
            array_push($arraynotas,$data_new);
        }
        array_push($arraythead,$data_head);
        if($suma_notas == 0 && $total_notas == 0)
        {
            $promedio = '0.0';
        }else{
            $promedio = $suma_notas ;
        }
        return ['mod_par_curso'=>$arraythead,'notas_curso'=>$arraynotas,'promedio'=>$promedio];
    }
    public function serEstudiante(Request $request){
        if(!is_int($request->estudiante))
        {
            $estudiante = intval($request->estudiante);
        }else{
            $estudiante = $request->estudiante;
        }
        
        $curso = $request->curso;
        $data_consult = Estudiantes::where('id_personas','=',$estudiante)->get();
        try{
            DB::beginTransaction();
        if(sizeof($data_consult)>0){
            if($data_consult[0]->estado_registro == 1)
            {
                $response = 0;
            }else{
                $data_consult = MisCursos::where('id_estudiante','=',$estudiante)->where('id_curso','=',$curso)->get();
                if(sizeof($data_consult)<=0){
                    $miscursos = new MisCursos();
                    $miscursos->id_estudiante = $estudiante;
                    $miscursos->id_curso = $curso;
                    $miscursos->state = 0;
                    $miscursos->save();
                    $response = 1;
                }else{
                    $response = 1;
                }
            }
        }else{
            $estudiantes = new Estudiantes();
            $estudiantes->id_personas = $estudiante;
            $estudiantes->estado_registro = 0;
            $estudiantes->save();
            $miscursos = new MisCursos();
            $miscursos->id_estudiante = $estudiante;
            $miscursos->id_curso = $curso;
            $miscursos->state = 0;
            $miscursos->save();
            $response = 1;
        }
        DB::commit();
    } catch (Exception $e){
        $response = 0;
        DB::rollBack();
    }
        return ['yesornot'=>$response];
        
        
    }
    public function perfil(Request $request){
        $estudiante = intval($request->estudiante);
        $dataConsult = Persona::where('id','=',$estudiante)->get();
        return ['dataPerson'=>$dataConsult];

    }
    public function perfilStore(Request $request){
        $data_person = $request->campos;
        $data_imagen = $request->imagen;
        if(!is_int($request->estudiante))
        {
            $estudiante = intval($request->estudiante);
        }else{
            $estudiante = $request->estudiante;
        }

        $guardar = $request->guardar;
        $student = Persona::findOrFail($estudiante);
        if($guardar == 1){// datos personales
            $student->n_documento = $data_person['documento'];
            $student->tipo_documento = $data_person['TipoDocumento'];
            $student->primer_nombre = $data_person['pnombre'];
            $student->segundo_nombre = $data_person['snombre'];
            $student->primer_apellido = $data_person['papellido'];
            $student->segundo_apellido = $data_person['sapellido'];
            $student->telefono = $data_person['telefono'];
            $student->direccion = $data_person['direccion'];
            $student->correo_institucional = $data_person['correo'];
            $student->fecha_nacimiento = $data_person['fecha'];
            $student->estado_registro = 0; 
            $student->save();
            return ['guardado'=>'Se ha guardado correctamente'];

        }elseif ($guardar==2){// imagen de perfil
            $urlImage = '';
            if(!file_exists("../public/img/Archivos/usuarios/".$data_person['documento']."/")){
                mkdir("../public/img/Archivos/usuarios/".$data_person['documento']."/", 0700,true);
            }
            if($data_imagen['type']!=null){
                $baseFromJavascript = $data_imagen['imagen'];
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
                $extension = substr($data_imagen['type'],6);
                if(file_exists("../public/img/Archivos/usuarios/".$data_person['documento']."/Foto.".$extension)){
                    // recorrer la carptea y asignarle un nuevo nombre;
                    $countFile = $this->verificarImgC('../public/img/Archivos/usuarios/'.$data_person['documento'].'/', $extension);
                    if($countFile>=1){
                        $new_id = $countFile + 1;
                        $filepath = "../public/img/Archivos/usuarios/".$data_person['documento']."/Foto(".$new_id.").".$extension;
                }else{
                    $filepath = "../public/img/Archivos/usuarios/".$data_person['documento']."/Foto.".$extension;
                }
                    $urlImage = substr($filepath,10);
                    file_put_contents($filepath,$data);
                    if($request->session()->exists('imagen')){
                        $request->session()->forget('imagen');
                    }
                    $request->session()->put('imagen', $urlImage);
                    
                // Finalmente guarda la imágen en el directorio especificado y con la informacion dada
                $student->imagen = $urlImage;
                $student->save();
                return ['guardado'=>'Se ha guardado correctamente'];

            }
        }elseif($guardar==3){ //datos profesionales

        }

        }
    }
    public function repasar(Request $request){
        
        return view('Estudiantes.repasar',['url'=>$request->c,'modulo'=>$request->m]);
    }
    public function verificarImgC($valor,$extension){
        $url_new = glob($valor."*.".$extension);
        $numero =0;
        if($url_new){
            $numero = count($url_new);
        }
        return $numero;
    }
    
}
