<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MisCursos;
use App\Curso;
use App\tipo_curso;
use App\CategoriaCurso;
use App\Introduccion;
use App\viewcurso;
use App\Modulo;
use App\Contenido;
use App\Lectura;
use App\Persona;
use App\Parcial;
use App\Preguntas;
use App\Respuesta;
use App\RespuestaPregunta;
use App\ExamenPregunta;
use App\TipoDuracion;
use App\Transaccion;
use App\Profesion;
use App\Instructor;


class CursoController extends Controller
{
    public function index(){
        return view('cursos.cursos');
    }
    public function ViewCursoscategorias(Request $request){
        return view('cursos.cursosfiltro',['curso'=>$request->que_deseas_aprender]);
    }
    public function cursos(Request $request){
        
        if(!empty($request->curso))
        {
            $url = $request->curso;
            $curso = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->where('cursos.nombre_curso', 'like', '%'.$url.'%')->where('cursos.estado_registro','=',1)->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
            if(sizeof($curso)>0)
              {
                return ['curso'=>$curso,'error'=>false];
              }else{
                $curso2 = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->Where('cursos.subtitulo_curso', 'like', '%'.$url.'%')->where('cursos.estado_registro','=',1)->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
                if(sizeof($curso2)>0){
                    return ['curso'=>$curso2,'error'=>false];
                }else{
                    $curso3 = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->Where('cursos.descripcion', 'like', '%'.$url.'%')->where('cursos.estado_registro','=',1)->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
                    if(sizeof($curso3)>0){
                        return ['curso'=>$curso3,'error'=>false];
                    }else{
                        $data_curso = "/".$url;
                        $curso4 = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->join('categoria_cursos','cursos.id_categoria','=','categoria_cursos.id')->Where('categoria_cursos.slug', '=',$data_curso)->where('cursos.estado_registro','=',1)->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
                        if(sizeof($curso4)>0){
                            return ['curso'=>$curso4,'error'=>false];
                        }else{
                            $curso5 = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')->Where('tipo_curso.nombre', 'like','%'.$url.'%')->where('cursos.estado_registro','=',1)->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
                            if(sizeof($curso5)>0){
                                return ['curso'=>$curso5,'error'=>false];
                            }else{
                                $validate="No se ha encontrado lo que esta buscando";
                                return ['mensaje'=>$validate,'error'=>true];
                            }
                           
                        }
                        
                    }
                }
              }
        }else
        {
            $curso = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->select('cursos.*','tipo_duracions.nombre_tipo_duracion as duracion')->get();
            return ['curso'=>$curso,'error'=>false];
        }
    }
    public function Verifcar(Request $request){
        // yesornot
        $estudiante = intval($request->estudiante);
        $curso = $request->curso;
        $response=0;
        $data_consult = MisCursos::where('id_estudiante','=',$estudiante)->where('id_curso','=',$curso)->get();
        $data_consult2 = Transaccion::where('id_persona','=',$estudiante)->where('id_curso','=',$curso)->where('state','=','Pendiente')->get();
        if(sizeof($data_consult)>0){
            $response=1;
        }else if(sizeof($data_consult2)>0){
            $response=1;
        }
        
        return ['yesornot'=>$response];
    }
    public function listarCursos(Request $request){
            $data = $request->data;
            $criterio = $request->criterio;
            $buscar = $request->buscar;
            // $lengthpage = $request->$paginatelength;
            if($criterio!=""){
                if(is_numeric($criterio)){
                    $paginacion = $criterio;
                }
            }            
        $myArray = explode(',', $data);
        if($myArray == [''])
        {
            if ($buscar=='undefined' || empty($buscar)){
                if(!empty($paginacion))
                {
                    $cursos = Curso::join('instructors','cursos.id_instructor','=','instructors.id_persona')
                    ->join('personas','instructors.id_persona','=','personas.id')
                    ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                    ->select('cursos.*','personas.primer_nombre','tipo_curso.nombre as nombre',
                    'personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido',
                    'instructors.biografia','instructors.slug as slug_instructor')
                    ->where('cursos.estado_registro','=',1)->orderBy('cursos.id', 'desc')->paginate($paginacion);
                }
                else
                {
                    $cursos = Curso::join('instructors','cursos.id_instructor','=','instructors.id_persona')
                    ->join('personas','instructors.id_persona','=','personas.id')
                    ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                    ->select('cursos.*','personas.primer_nombre','tipo_curso.nombre as nombre',
                    'personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido',
                    'instructors.biografia','instructors.slug as slug_instructor')
                    ->where('cursos.estado_registro','=',1)->orderBy('cursos.id', 'desc')->paginate(6);
                }
            }
            else{
                echo 'esto no esta bien '.$buscar;
                exit();
            }
        }
        else if($myArray!=[''])
        {
            $cursos = Curso::join('instructors','cursos.id_instructor','=','instructors.id_persona')
            ->join('personas','instructors.id_persona','=','personas.id')
            ->join('categoria_cursos','cursos.id_categoria','=','categoria_cursos.id')
            ->select('cursos.*','personas.primer_nombre',
            'personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido',
            'instructors.biografia','instructors.slug as slug_instructor')
            ->where('cursos.estado_registro','=',1)
            ->where(function($cursos) use ($myArray){
                foreach($myArray as $value){
                    $cursos->orwhere('categoria_cursos.slug','=',$value);
                }
            })->where('cursos.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('cursos.id', 'desc')->paginate(6);
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
            'cursos' => $cursos,
        ];
    }
    
    public function CursoDetalles($url){
       
        $curso = Curso::leftjoin('categoria_cursos','cursos.id_categoria','categoria_cursos.id')
        ->leftjoin('instructors','cursos.id_instructor','=','instructors.id_persona')
        ->leftjoin('personas','instructors.id_persona','=','personas.id')
        ->leftjoin('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')
        ->leftjoin('nivels','cursos.id_nivel','=','nivels.id')
        ->select('cursos.*','categoria_cursos.nombre_categoria','categoria_cursos.slug as slug_categoria','personas.primer_nombre',
        'personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido','personas.imagen',
        'instructors.biografia','instructors.slug as slug_instructor','tipo_duracions.nombre_tipo_duracion','nivels.nombre_niveles')
        ->where('cursos.url_curso','=',$url)->get();
            return view('cursos.detallecurso',['curso'=> $curso]) ;
    }
    
    public function Cursando($url){
        return view('cursos.cursando.cursando',['curso'=> $url]) ;
    }
    public function CursoEditar($url){
        $curso = Curso::where('cursos.url_curso','=',$url)->take(1)->get();
        return view('cursos.edit',['curso'=> $curso]) ;
    }
    public function crearCurso(){
        return view('cursos.create');
    }

    public function introstore(Request $request, $curso,$route){
        try{
            if($route!=2)
            {
                DB::beginTransaction();
            }
            $data_imagen = $request->imagen;
            if(empty($curso)){
            $ruta = "../public/img/cursos/";
            $this->imgSaveDir($data_imagen, $ruta);
            }
            $intro = new Introduccion();
            $intro->imagen_contenido = $data_imagen['name'];
            $intro->contenido = $request->intro;
            $intro->urlvideo = $request->urlvideo;
            $intro->descripcion_video = $request->descripcion_video;
            if(!empty($curso)){
                $intro->id_curso = $curso;
            }else{
                $intro->id_curso = $request->curso;
            }
            $intro->view = 0;
            $intro->save();
            if($route!=2)
            {
                DB::commit();
            }
            
            } catch (Exception $e){
                $response = 0;
                DB::rollBack();
            }
    }

    public function imgSaveDir($data_imagen, $ruta){
        $baseFromJavascript = $data_imagen['imagen'];
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
        $filepath = $ruta.$data_imagen['name'];
        file_put_contents($filepath,$data);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
        // guardar la informacion del curso
        $curso = new Curso();
        $codigo = date('YmdGi');
        $curso->codigo = $codigo;
        $curso->nombre_curso = trim($request->nombrecurso);
        $curso->subtitulo_curso = trim($request->subtitulo);
        $curso->descripcion = $request->descripcion;
        $curso->id_categoria = $request->categoria;
        $curso->duracion_numero = $request->duracion;
        $curso->id_tipo_curso = $request->tipocurso;
        $curso->id_tipo_duracion = $request->tipoduracion;
        $data_consult = Curso::where('nombre_curso','=',$request->nombrecurso)->get();
        if(sizeof($data_consult)>0)
        {
            $id_now = sizeof($data_consult) + 1;
            $curso->url_curso = trim($request->slug).$id_now;
        }else{
            $curso->url_curso = trim($request->slug);
        }
        
        $curso->id_instructor = intval($request->instructor);
        $data_imagen = $request->imagen;
        if(isset($data_imagen['imagen']))
        {
            $ruta = "../public/img/cursos/";
            // guardar imagen en carpeta
            $this->imgSaveDir($data_imagen,$ruta);
            $curso->imagen_destacada = $data_imagen['name'];
        }
        $curso->id_creador = intval($request->instructor);
        $curso->fecha_inicial = $request->fecha;
        // default apoya dacademy
        $curso->apoya = 1;
        $curso->estado_registro = 0;
        $curso->save();
       if(!empty($request->introG)){
        $this->introstore($request,$curso->id,2);
       }
        DB::commit();
    } catch (Exception $e){
        $response = 0;
        DB::rollBack();
    }
    return $curso;
    }
    public function listarcursoProfe(Request $request){
        $curso = Curso::join('personas','personas.id','=','cursos.id_instructor')
        ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
        ->join('intro','cursos.id','=','intro.id_curso')
        ->where('cursos.id_creador','=',$request->persona)
        ->where('cursos.estado_registro','<>',2)
        ->select('cursos.*','intro.contenido','intro.urlvideo','intro.descripcion_video','personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido','tipo_curso.nombre as tipo_curso')
        ->orderBy('created_at','desc')
        ->paginate(5);
        $array = array();
        foreach ($curso as $item) {
            $alumnos = MisCursos::where('id_curso','=',$item->id)->get()->count();
            $alumData = array('alumnos'=>$alumnos, 'id_curso'=>$item->id);
            array_push($array, $alumData);
        }


       return [
           'paginate' => [
            'total'         => $curso->total(),
            'current_page'  => $curso->currentPage(),
            'per_page'      => $curso->perPage(),
            'last_page'     => $curso->lastPage(),
            'from'          => $curso->firstItem(),
            'to'            => $curso->lastPage(),
           ],
           'curso'=> $curso,
           'alumnos'=>$array
        ];
    }
    public function listarcursoProfeEliminado(Request $request){
        $curso = Curso::join('personas','personas.id','=','cursos.id_instructor')
        ->where('cursos.id_creador','=',$request->persona)
        ->where('cursos.estado_registro','<>',0)
        ->where('cursos.estado_registro','<>',1)
        ->select('cursos.*','personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido')
        ->get();
        
       return ['curso'=> $curso];
    }
 
    public function location(Request $request){
        $data_consult = MisCursos::join('cursos','cursos.id','=','mis_cursos.id_curso')
        ->where('cursos.url_curso','=',$request->course)
        ->where('mis_cursos.id_estudiante','=',session()->get('id_persona'))
        ->select('cursos.id_tipo_curso','cursos.id')
        ->get();
        $datos="ninguno";
        if(sizeof($data_consult)>0)
        {
            return ['datos'=>$data_consult];
        }else{
            return ['datos'=>$datos];
        }
        
    }
    public function filtroscursos($url){
        $curso = Curso::where('cursos.url_curso','=',$url)->take(1)->get();
       return view('cursos.cursos',['curso'=> $curso]);
    }
    public function intro($url){
        return view('cursos.cursando.intro',['curso'=>$url]);
    }
    public function detalleintro($url){
        $intro = Introduccion::join('cursos','intro.id_curso','=','cursos.id')
        ->select('intro.id','intro.contenido','cursos.nombre_curso','intro.id_curso','intro.urlvideo','intro.imagen_contenido','intro.descripcion_video','cursos.id_tipo_curso')
        ->where('cursos.url_curso','=',$url)->get();
        $lectura = '';
        if($intro[0]->id_tipo_curso==3){
            $lectura = Modulo::join('cursos','modulo.id_curso','=','cursos.id')
            ->join('contenido','modulo.id','=','contenido.id_modulo')
            ->join('lectura','contenido.id_lectura','=','lectura.id')
            ->where('cursos.id','=',$intro[0]->id_curso)
            ->where('lectura.state','=',1)
            ->select('lectura.url','lectura.name_file','tipo_archivo','lectura.tipo_enlace')
            ->get();
        }
        return ['curso'=>$intro,'lectura'=>$lectura];
    }
    
    public function indexparcial($url)
    {
        return view('Estudiantes.parcial',['curso'=>$url]);
    }
    public function parcial(Request $request)
    {
        $data_curso = $request->curso;
        $data_estu = intval($request->estudiante);
        $response = Parcial::join('examen','parcial.id_examen','=','examen.id')
        ->join('examne_pregunta','examen.id','=','examne_pregunta.id_examen')
        ->join('pregunta','examne_pregunta.id_pregunta','=','pregunta.id')
        ->join('cursos','parcial.id_curso','=','cursos.id')
        ->select('parcial.id as parcial','intr_parcial','cursos.nombre_curso','parcial.time_parcial','cursos.id as curso','pregunta.id','pregunta.enunciado','pregunta.id_tipo_pregunta','pregunta.valor')
        ->where('cursos.url_curso','=',$data_curso)
        ->orderByRaw('RAND()')
        ->get();
      
        // --------------------------------------------------
        $curso_estudiante = 0;
        $responseEstu = Persona::where('personas.id','=',$data_estu)
        ->select('personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido','personas.n_documento')->take(1)->get();
        $answers = array();
        $contenido = array();
        $responseInst = Persona::join('cursos','personas.id','=','cursos.id_instructor')->where('cursos.id','=',$response[0]->curso)
        ->select('personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido')->take(1)->get();
        $cursoName = $response[0]->nombre_curso;
        foreach($response as $dt){
            $responsedt = RespuestaPregunta::join('pregunta','respuesta_pregunta.id_pregunta','=','pregunta.id')
            ->join('respuestas','respuesta_pregunta.id_respuesta','=','respuestas.id')
            ->select('respuestas.id','respuestas.respuesta','respuestas.valor')
            ->where('pregunta.id','=',$dt->id)
            ->orderByRaw('RAND()')
            ->get();
            $curso_estudiante = $dt->curso;
            $parcial = $dt->parcial;
            if(strlen((string)$dt->valor)===1){
                $valor = $dt->valor. '.0';
            }else{
                $valor = $dt->valor;
            }
            $newdt = array('id'=>$dt->id,'title'=>$dt->enunciado,'listData'=>$responsedt,'type'=>$dt->id_tipo_pregunta,'valor'=>$valor);
            array_push($answers,$newdt);
        }
        $newarray=array('estudiante'=>$responseEstu,'Profesor'=>$responseInst,'contenido'=>$answers, 'curso' =>$curso_estudiante,'parcial'=>$parcial,'time'=>$response[0]->time_parcial,'introParcial'=>$response[0]->intr_parcial,
    'CursoName'=>$cursoName);
        array_push($contenido,$newarray);
        return ['arrayparcial'=>$contenido];
    }

    public function viewcursos(){
        return view('Estudiantes.miscursos',['tipocurso'=>'Cursos']);
    }
    public function viewmasterclass(){
        return view('Estudiantes.miscursos',['tipocurso'=>'Master Class']);
    }
    public function viewdiplomados(){
        return view('Estudiantes.miscursos',['tipocurso'=>'Diplomados']);
    }
    public function viewcertificaciones(){
        return view('Estudiantes.miscursos',['tipocurso'=>'Certificados']);
    }

    public function listarMisCursos(Request $request)
    {
        
        if(!empty($request->criterio))
        {
            $data_criterio = intval($request->criterio);
            if($data_criterio == 1)
            {
                $miscursos = MisCursos::join('cursos','mis_cursos.id_curso','=','cursos.id')
                ->join('instructors','cursos.id_instructor','=','instructors.id_persona')
                ->join('personas','instructors.id_persona','=','personas.id')
                ->select('cursos.nombre_curso','cursos.url_curso','cursos.id','cursos.imagen_destacada','personas.primer_nombre','personas.primer_apellido','mis_cursos.state')
                ->where('mis_cursos.id_estudiante','=',$request->buscar)
                ->paginate(6);
                $data_estudiante = "";

                foreach ($miscursos as $data) {
                    
                    if(strlen($data->nombre_curso)>=63)
                    {
                        $nombre = substr($data->nombre_curso, 0, 63);
                        $data->nombre_curso = trim($nombre);
                    }
                    
                }

            }else if($data_criterio == 2)
            {
                $miscursos = MisCursos::join('cursos','mis_cursos.id_curso','=','cursos.id')
                ->join('instructors','cursos.id_instructor','=','instructors.id_persona')
                ->join('personas','instructors.id_persona','=','personas.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->select('cursos.nombre_curso','cursos.url_curso','cursos.id','cursos.imagen_destacada','personas.primer_nombre','personas.primer_apellido','mis_cursos.state')
                ->where('tipo_curso.nombre','=',$request->tipo_curso)
                ->where('mis_cursos.id_estudiante','=',$request->buscar)
                ->paginate(6);
                $data_estudiante = Persona::where('id','=',$request->buscar)->select('n_documento')->take(1)->get();
                foreach ($miscursos as $data) {
                    
                    if(strlen($data->nombre_curso)>=63)
                    {
                        $nombre = substr($data->nombre_curso, 0, 63)."...";
                        $data->nombre_curso = trim($nombre);
                    }
                    
                }
            }
        }
        return [
            'pagination' => [
                'total'        => $miscursos->total(),
                'current_page' => $miscursos->currentPage(),
                'per_page'     => $miscursos->perPage(),
                'last_page'    => $miscursos->lastPage(),
                'from'         => $miscursos->firstItem(), 
                'to'           => $miscursos->lastItem(),
            ],
            'miscursos' => $miscursos,
            'estudiante' => $data_estudiante
        ];
    }
    public function profesiones(){
        $data_consult = Profesion::where('state_public','=',1)->orderBy('nombre','ASC')->get();
        $array = array();
        foreach($data_consult as $item){
            $string = $this->eliminarTildes($item->nombre);
            $var = array('nombre'=>strtoupper($string),'id'=>$item->id);
            array_push($array,$var);
        }
        return ['profesion'=> $array];
    }
    public function eliminarTildes($cadena)
    {

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        // $cadena = utf8_encode($cadena);
    
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena );
    
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
    
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
    
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
    
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
    
        $cadena = str_replace(
            array('ñ','ç', 'Ç'),
            array('Ñ','c', 'C'),
            $cadena
        );
    
        return $cadena;
    }
    public function listartipocurso(Request $request){
        $data = $request->combo;
        switch ($data) {
            case 1:
                $data_consult = tipo_curso::select('id','nombre')->orderBy('nombre','asc')->get();
                return ['tiposcurso'=>$data_consult];
                break;
            case 2:
                $data_consult2 = TipoDuracion::where('estado_registro','=',1)->select('id','nombre_tipo_duracion as nombre')->get();
                return ['tipoduracion' => $data_consult2];
            break;
            case 3:
                $data_consult3 = CategoriaCurso::where('estado_registro','=',1)->select('id','nombre_categoria as nombre')->get();
                return ['tipocategoria'=>$data_consult3];
            break;
            default:
                $data_consult = tipo_curso::select('id','nombre')->get();
                $data_consult2 = TipoDuracion::where('estado_registro','=',1)->select('id','nombre_tipo_duracion as nombre')->get();
                $data_consult3 = CategoriaCurso::where('estado_registro','=',1)->select('id','nombre_categoria as nombre')->get();
                return ['tiposcurso'=>$data_consult, 'tipoduracion' => $data_consult2, 'tipocategoria'=>$data_consult3];
                break;
        }
    }
    public function updateCurso(Request $request){
        try{
            DB::beginTransaction();
        $curso = Curso::findOrFail($request->idcurso);
        $curso->nombre_curso=$request->titulo;
        $curso->subtitulo_curso=$request->subtitulo;
        $curso->descripcion=$request->descripcion;
        $curso->url_curso = $request->slug_curso;
        $curso->duracion_numero= $request->duracion;
        $curso->id_tipo_duracion=$request->tipoDuracion;
        
        $curso->id_categoria=$request->categoria;
        $curso->fecha_inicial=$request->fecha;
        if(!empty($request->imagen['imagens']))
        {
            unlink("../public/img/cursos/",$request->imagenact);
            $data_imagen = $request->imagen['imagens'];
            $ruta = "../public/img/cursos/";
            $this->imgSaveDir($data_imagen, $ruta);
            $dataImgName = $request->imagen['nombreImagens'];
            $curso->imagen_descatada=$dataImgName;
        }
        $curso->save();
        $intro = Introduccion::where('id_curso','=',$request->idcurso)->take(1)->get();
        if(!empty($request->imagen['imagens']))
        {
        $intro[0]->imagen_contenido = $request->imagen['nombreImagens'];
        }
        $intro[0]->contenido = $request->intro;
        $intro[0]->urlvideo = $request->urlvideo;
        $intro[0]->descripcion_video = $request->descripcion_video;
        $intro[0]->save();
        DB::commit();
        return 'Se ha guardado correctamente';
        } catch (Exception $e){
        $response = 0;
        DB::rollBack();
        }
    }

    public static function url($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}
}
