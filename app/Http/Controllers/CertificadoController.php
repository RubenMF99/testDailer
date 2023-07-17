<?php

namespace App\Http\Controllers;

/*conection on database online*/
use Illuminate\Support\Facades\DB;
/* Request of url*/
use Illuminate\Http\Request;
/*Model datebase*/
use App\certificado;
use App\Estudiante;
use App\Persona;
use App\Curso;
use App\TipoCertificaciones;
use App\CertificacionActividad;
use App\PersonasCertificaciones;
use App\Modulo;
use App\Contenido;
use App\Lectura;
use App\DetalleExamen;
use App\DetalleExamCurso;
use App\Transaccion;
use App\Usuarios;

use Barryvdh\DomPDF\Facade as PDF;
/*class certificate controller*/
class CertificadoController extends Controller
{
    
  
    public function descargar_pdf(Request $request){
        $data = $request->codBarra;
        $resultado = str_replace(" ", "+", $data);
        $nombreCurso = $request->nombreCurso;
        $nombreEstudiante = $request->nombreEstudiante;
        $horas = $request->horas;
        $firma = "../public/certificado_estruct/firmas/Firma Mario Prada.png";
        $numero_cedula = $request->numero_cedula; $tipo_cedula=$request->tipo_cedula;
        $director = $request->director;
        $identificacion = $tipo_cedula;
        $dias = $request->dia;
        $mesesaños = $request->mesaño;
        $tipocurso = $request->tipocurso;
        // return view('Estudiantes.certificados',['codigobarra'=>$resultado,'curso'=>$nombreCurso,'estudiante'=>$nombreEstudiante,'horas'=>$horas,'firma'=>$firma]);
   
        $pdf = PDF::loadView('Estudiantes.certificados',['codigobarra'=>$resultado,'curso'=>$nombreCurso,'estudiante'=>$nombreEstudiante,'horas'=>$horas,'firma'=>$firma,'identificacion'=>$identificacion,'director'=>$director,'dia'=>$dias,'mesaño'=>$mesesaños,'tipocurso'=>$tipocurso,'numeroCedula'=>$numero_cedula])
        ->setOptions(['margin-top'=>'0cm'],['margin-bottom'=>'0cm'],['margin-right'=>'0cm'])->setPaper('A4','landscape');
      
        return $pdf->download('Certificado '.$nombreCurso.'.pdf');
    }
    public function miscertificados(Request $request){
        $data_Estudiante = intval($request->CodEstudiante);
        // certificados del estudiante
        $consult_Certificado = certificado::where('id_estudiante','=',$data_Estudiante)->get();
        // datos del estudiante
        if(sizeof($consult_Certificado)>0){
            $consult_estudiante = Persona::where('id','=',$data_Estudiante)
        ->select('n_documento','tipo_documento','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido')->get();
        $arrays_cursos = array();
        // datos de los cursos certificados
        foreach($consult_Certificado as $item){
            $consult_curso = Curso::join('tipo_duracions','cursos.id_tipo_duracion','=','tipo_duracions.id')->where('cursos.id','=',$item->id_cursos)->select('cursos.nombre_curso','cursos.imagen_destacada','cursos.duracion_numero','tipo_duracions.nombre_tipo_duracion','cursos.id_tipo_curso')->get();
            $data_profe = Persona::where('id','=',$item->id_profesor)->select('primer_nombre','segundo_nombre','primer_apellido','segundo_apellido')->get();
            $arraycurso_profe = array('instructor'=>$data_profe,'curso'=>$consult_curso,'codigoBarra'=>$item->cod_barras,'fecha'=>$item->updated_at);
            array_push($arrays_cursos, $arraycurso_profe);
        }
    //    datos del director 
        $consult_Direct = Persona::where('id','=',$consult_Certificado[0]->id_director)->select('primer_nombre','segundo_nombre','primer_apellido','segundo_apellido')->get();
        $arrayData = array('info_curso'=>$arrays_cursos,'director'=>$consult_Direct,'estudiante'=>$consult_estudiante);
        return ['certificados'=>$arrayData];    
    }else {
        return ['certificados'=>0];
    }
        
        
    }
    public function certificaciones(){
        $categoria = TipoCertificaciones::select('id', 'nombre')->get();
        $arraycursos=array();
        $estructura = array();
        $contenido = array();
        $maxWord = 87;
        foreach($categoria as $cate){
                    $cursos = Curso::join('personas','cursos.id_instructor','=','personas.id')
                                    ->join('apoyan','cursos.apoya','=','apoyan.id')
                                    ->where('cursos.id_tipo_certificado','=',$cate->id)
                                    ->where('cursos.estado_registro','=',1)
                                    ->where('cursos.id_tipo_curso','=',4)
                                    ->select('cursos.id as id','cursos.nombre_curso as curso',
                                    'cursos.descripcion as descripcion','cursos.duracion_numero as duracion','cursos.tipo_certificacion',
                                    'cursos.id_tipo_duracion as tiempo','cursos.id_tipo_curso as tipocategoria','cursos.imagen_destacada as imagen',
                                    'cursos.precio as precio', 'cursos.precio_venta as precioventa','apoyan.imagen_url as imgapoya','url_curso as url')
                                    ->orderBy('cursos.created_at','desc')->get();
                // recortando el texto largo que proviene de la descripcion del curso a un tamaño de 350 
                foreach($cursos as $cur)
                {
                    $cadena = trim(strip_tags($cur->descripcion));
                    if(strlen($cadena) > $maxWord){
                            $cur->descripcion = substr($cadena, 0 ,$maxWord)."...";
                    }
                }
                if(!is_null($cursos))
                {
                    $estructura = array('categoria'=>$cate,'contenido_cate'=>$cursos);
                    array_push($arraycursos, $estructura);
                }
        }
        return ['certificado' => $arraycursos];
    }
    public function detallecertifi($url){
        $data_consult = Curso::where('url_curso','=',$url)->take(1)->get();
        $data_consult2 = DetalleExamCurso::join('detalle_exam','detalleexam_curso.id_detalle_exam','=','detalle_exam.id')->where('detalleexam_curso.id_curso','=',$data_consult[0]->id)->select('detalle_exam.*')->get();
        // return [$data_consult];
        return view('Certificados.detalle.index',['detalle'=>$data_consult,'detalle_exam'=>$data_consult2]);
        
    }
    public function saveDownload(Request $request){
        $nombre_completo = $request->nombre_completo;
        $correo = $request->correo;
        $telefono = $request->telefono;
        $idCertificacion = $request->certificacion;
        // -----------------------------------------------------
        $PersonCertifi = new PersonasCertificaciones();
        $PersonCertifi->nombre_completo = $nombre_completo;
        $PersonCertifi->telefono = $telefono;
        $PersonCertifi->correo = $correo;
        $PersonCertifi->save();
        // -----------------------------------------------------
        $CertifiActivities = new CertificacionActividad();
        $CertifiActivities->id_person_download = $PersonCertifi->id;
        $CertifiActivities->id_certificacion = $idCertificacion;
        $CertifiActivities->save();
        return ['success'=>'guardado'];
    }
    public function listFilesCertificaciones(Request $request){
        $curso = $request->certificacion;
        $listFiles = Modulo::join('contenido','modulo.id','=','contenido.id_modulo')
        ->join('lectura','contenido.id_lectura','=','lectura.id')
        ->select('lectura.*')
        ->where('modulo.id_curso','=',$curso)
        ->orderBy('nombre')->get();
        return ['listFiles'=>$listFiles];
    }
    public function savePayCertificacion(Request $request){
        $idCertificacion = $request->Curso;
        $student = intval(session()->get('id_persona'));
        $CertifiActivities = new CertificacionActividad();
        $CertifiActivities->id_person_compra = $student;
        $CertifiActivities->id_certificacion = $idCertificacion;
        $CertifiActivities->save();
    }
    public function comprarcertifi(Request $request){
        $id_certificacion = $request->id_certifi;
        $persona = session()->get('id_persona');
        $data_consult = [];
        $default = false;
        if(isset($request->mes)){
            if(isset($id_certificacion)){
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->where('certifi_actividad.id_certificacion','=',$id_certificacion)
            ->whereMonth('certifi_actividad.created_at', $request->mes)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }else{
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->whereMonth('certifi_actividad.created_at', $request->mes)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }
            
        }else if(isset($request->year)){
            if(isset($id_certificacion)){
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->where('certifi_actividad.id_certificacion','=',$id_certificacion)
            ->whereYear('certifi_actividad.created_at', $request->year)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }else{
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->whereYear('certifi_actividad.created_at', $request->year)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }
            
        }else if(isset($request->fecha_ini) && isset($request->fecha_fin)){
            if(isset($id_certificacion)){
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->whereBetween('certifi_actividad.created_at',[$request->fecha_ini,$request->fecha_fin])
            ->where('cursos.id_instructor','=',$persona)
            ->where('certifi_actividad.id_certificacion','=',$id_certificacion)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }else{
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->whereBetween('certifi_actividad.created_at',[$request->fecha_ini,$request->fecha_fin])
            ->where('cursos.id_instructor','=',$persona)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }
            
        }else{
            $default = true;
            if(isset($id_certificacion)){
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->where('certifi_actividad.id_certificacion','=',$id_certificacion)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }else{
                $data_consult = CertificacionActividad::join('transacciones','certifi_actividad.id_person_compra','=','transacciones.id_persona')
            ->join('cursos','certifi_actividad.id_certificacion','=','cursos.id')
            ->join('personas','certifi_actividad.id_person_compra','=','personas.id')
            ->join('users','certifi_actividad.id_person_compra','=','users.id_user')
            ->where('cursos.id_instructor','=',$persona)
            ->select('personas.primer_nombre','personas.primer_apellido','cursos.nombre_curso','users.email')
            ->orderBy('certifi_actividad.created_at','desc')
            ->get();
            }
            
        }
        if($default){
            return view('Certificados.compra.index',['compras'=>$data_consult]);
        }else{
            return [['compras'=>$data_consult]];
        }
        
    }


}
