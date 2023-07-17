<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail as Mail;

class MailController extends Controller
{
    public function store(){
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject();
            $msj->to();
        });
        Session::flash('');
    }
    public function feedback(Request $request){
        switch($request->feedback){
            case 1:
                $this->soporte_tecnico($request);
                return ['response'=>'se ha enviado el mensaje'];
            break;
            case 2:
                $this->reportar_problema($request);
                return ['response'=>'se ha enviado el mensaje'];
            break;
            case 3:
                $this->sugerencia($request);
                return ['response'=>'se ha enviado el mensaje'];
            break;
        }
    }
    private function reportar_problema(Request $request){
        $destino = "andresg9602@hotmail.com";
        $copia = "mario@digitaldreams.co";
        $destino2 = $request->correo;
        $nombre = $request->nombre;
        $data = array("nombre"=>$request->nombre,"codSoporte"=>$request->codSoporte,"asunto"=>$request->asunto,"correo"=>$request->correo);
        Mail::send('Emails.reportarproblema',$data, function($msj) use ($destino,$nombre,$copia){
            $msj->subject('Usuario: '.$nombre.', Tiene problema, resolver con urgencia.');
            $msj->to($destino);
            $msj->cc($copia);
        });
        
        Mail::send('Emails.reportarproblemacliente',$data, function($msj) use ($destino2){
            $msj->subject('Soporte D-Academy.co Academia Digital');
            $msj->to($destino2);
            
        });
    }
    private function soporte_tecnico(Request $request){
        $destino = "andresg9602@hotmail.com";
        $copia = "mario@digitaldreams.co";
        $destino2 = $request->correo;
        $nombre = $request->nombre;
        $data = array("nombre"=>$request->nombre,"codSoporte"=>$request->codSoporte,"asunto"=>$request->asunto,"correo"=>$request->correo);
        Mail::send('Emails.soporte',$data, function($msj) use ($destino,$nombre,$copia){
            $msj->subject('Usuario: '.$nombre.', Necesita un soporte técnico');
            $msj->to($destino);
            $msj->cc($copia);
        });
        
        Mail::send('Emails.soportecliente',$data, function($msj) use ($destino2){
            $msj->subject('Soporte D-Academy.co Academia Digital');
            $msj->to($destino2);
            
        });
       
    }
    private function sugerencia(Request $request){
        $destino = 
        $destino = "andresg9602@hotmail.com";
        $copia = "mario@digitaldreams.co";
        $destino2 = $request->correo;
        $nombre = $request->nombre;
        $data = array("nombre"=>$request->nombre,"asunto"=>$request->asunto,"correo"=>$request->correo);
        Mail::send('Emails.sugerencia',$data, function($msj) use ($destino,$nombre,$copia){
            $msj->subject('Usuario: '.$nombre.',nos dio su opinión sobre la app.');
            $msj->to($destino);
            $msj->cc($copia);
        });
        
        Mail::send('Emails.sugerenciacliente',$data, function($msj) use ($destino2){
            $msj->subject('Sugerencia D-Academy.co Academia Digital');
            $msj->to($destino2);
            
        });
    }
}
