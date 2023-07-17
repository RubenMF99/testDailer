<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaccion;
use App\DetalleExamCurso;
use App\MisCursos;
use App\Curso;
use App\Usuarios;
use App\Estudiantes;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail as Mail;
use App\Http\Controllers\CertificadoController;

class TransacionController extends Controller
{
    public function index(){
        // $parameter = $_POST['ref_payco'];
        // header('Location://localhost:8080/Epayco?ref_payco='.$parameter);
        return View('PasarelaDePago.index');
    }
    public function ViewTrans(){
        return View('PasarelaDePago.index');
    }
    public function detalleTransaccion(){

    }
    public function mistransacciones(Request $request){
        $persona = intval($request->cod_persona);
        $data_consult = Transaccion::join('cursos','transacciones.id_curso','=','cursos.id')->where('id_persona','=',$persona)->select('transacciones.*','cursos.url_curso as url')->get();
        return ['transaccion'=>$data_consult];
    }
    public function storeTransaccion(Request $request){
        $references = $request->referencia;
        $transaction_id = $request->n_recibo;
        $date_transaction = $request->fecha_pago;
        $response_code = $request->CodigoRespuesta;
        $response_state = $request->estado;
        $course = $request->Curso;
        $student = intval(session()->get('id_persona'));
        try{
            DB::beginTransaction();
            $consult_transaccion = Transaccion::where('recibo','=',$transaction_id)->take(1)->get();
            if(sizeof($consult_transaccion)<=0){
                $Transaccion = new Transaccion();
                $Transaccion->referencia = $references;
                $Transaccion->recibo = $transaction_id;
                $Transaccion->fecha_pago = $date_transaction;
                $Transaccion->id_curso = $course;
                $Transaccion->id_persona = $student;
                $Transaccion->state = $response_state;
                $Transaccion->save();
            }
            if($response_code==1){
                $consult_estudiante = Estudiantes::where('id_personas','=',$student)->take(1)->get();
                if(sizeof($consult_estudiante)<=0){
                    $estudiante = new Estudiantes();
                    $estudiante->id_personas = $student;
                    $estudiante->estado_registro = 0;
                    $estudiante->save();
                }
                $consult_estudiante = MisCursos::where('id_estudiante','=',$student)->where('id_curso','=',$course)->take(1)->get();
                if(sizeof($consult_estudiante)<=0){
                $miscursos = new MisCursos();
                $miscursos->id_estudiante = $student;
                $miscursos->id_curso = $course;
                $miscursos->state = 0;
                $miscursos->save();
                }
            }
            $response = 1;
            DB::commit();
        } catch (Exception $e){
            $response = 0;
            DB::rollBack();
        }
        return $response;
    }
    public function ExportarTransactionPDF(){

    }
    public function storeTransaccionCert(Request $request){
        $references = $request->referencia;
        $transaction_id = $request->n_recibo;
        $date_transaction = $request->fecha_pago;
        $response_code = $request->CodigoRespuesta;
        $response_state = $request->estado;
        $course = $request->Curso;
        $student = intval(session()->get('id_persona'));
        
        $certificado_ext = Curso::where('id_tipo_curso','=',4)->where('tipo_certificacion','<>',0)->where('id','=',$course)->get();
        if(sizeof($certificado_ext)>0)
        {
            //(generalmente) registramos el usuario que compro la certificacion para hacerla en certijoin
           
            if($response_code==1){
            $certificacion = new CertificadoController();
            $certificacion->savePayCertificacion($request);
            }
        }else{
            $certificado_int = Curso::where('id_tipo_curso','=',4)->where('tipo_certificacion','=',0)->where('id','=',$course)->get();
            if(sizeof($certificado_int)>0){
                //(generalmente) inscribimos en el curso y lo volvemos estudiante.
                
                if($response_code==1){
                    $consult_estudiante = Estudiantes::where('id_personas','=',$student)->take(1)->get();
                    if(sizeof($consult_estudiante)<=0){
                        $estudiante = new Estudiantes();
                        $estudiante->id_personas = $student;
                        $estudiante->estado_registro = 0;
                        $estudiante->save();
                    }
                    $consult_estudiante = MisCursos::where('id_estudiante','=',$student)->where('id_curso','=',$course)->take(1)->get();
                    if(sizeof($consult_estudiante)<=0){
                    $miscursos = new MisCursos();
                    $miscursos->id_estudiante = $student;
                    $miscursos->id_curso = $course;
                    $miscursos->state = 0;
                    $miscursos->save();
                    }
                    // guardar compra en certificaciones.
                    $certificacion = new CertificadoController();
                    $certificacion->savePayCertificacion($request);
                }
            }
        }
        // guadamos transaccion
            $consult_transaccion = Transaccion::where('recibo','=',$transaction_id)->take(1)->get();
            if(sizeof($consult_transaccion)<=0){
                $Transaccion = new Transaccion();
                $Transaccion->referencia = $references;
                $Transaccion->recibo = $transaction_id;
                $Transaccion->fecha_pago = $date_transaction;
                $Transaccion->id_curso = $course;
                $Transaccion->id_persona = $student;
                $Transaccion->state = $response_state;
                $Transaccion->save();
            }
        // retornamos 
            return $this->enviarcorreo($request);
    }
    public function enviarcorreo(Request $request){
        $usuario = session()->get('nombre');
        $course = $request->Curso;
        $userId = intval(session()->get('id_persona'));
        $data_consult = Usuarios::where('id_user','=',$userId)->take(1)->get();
        $data_consult2 = DetalleExamCurso::join('detalle_exam','detalleexam_curso.id_detalle_exam','=','detalle_exam.id')
        ->where('detalleexam_curso.id_curso','=',$course)
        ->select('detalle_exam.numero_preguntas','detalle_exam.puntaje_aprobacion')
        ->get();
        $porcentaje = $data_consult2[0]->puntaje_aprobacion;
        $cantidad = $data_consult2[0]->numero_preguntas;
        $destino = $data_consult[0]->email;
        $data = array('usuario'=>$usuario, 'cantidad'=>$cantidad, 'porcentaje'=>$porcentaje, 'curso'=>$course);
        Mail::send('Emails.certificacion',$data, function($msj) use ($destino, $usuario, $course){
            $msj->subject(''.$usuario.' estás a un paso de iniciar tu certificación en'.$course);
            $msj->to($destino);
            // $msj->attach(public_path('/pdf/parcial I calculo 3.pdf'));
        });
        return ['response'=>'se ha enviado el mensaje'];
    }
}
