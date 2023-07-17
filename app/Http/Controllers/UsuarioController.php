<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Persona;
use App\Usuarios;
use App\Profesion;
use App\Ciudad;
use Illuminate\Support\Facades\Mail as Mail;

class UsuarioController extends Controller
{

    public function index()
    {
        return view('administradores.index');

    }
    public function listarAdminitrador(Request $request)
    {
        $criterio = $request->criterio;
        $buscar = $request->buscar;
 
        if ($buscar==''){
            // busqueda sin filtro 
            $administradores = Usuarios::join('personas','Users.id_user','=','personas.id')
            ->select('personas.primer_nombre','personas.segundo_nombre','personas.primer_apellido','personas.segundo_apellido','personas.telefono',
            'personas.direccion','personas.fecha_nacimiento','Users.email','Users.password','Users.estado_registro','Users.id_user','Users.idrol')->where('Users.idrol','=','1')->paginate(3);
       
        }else{
            // busqueda con filtro
            $administradores = Usuarios::join('personas','Users.id_user','=','personas.id')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->paginate(3);
            
        }
        return [
            'pagination' => [
                'total'        => $administradores->total(),
                'current_page' => $administradores->currentPage(),
                'per_page'     => $administradores->perPage(),
                'last_page'    => $administradores->lastPage(),
                'from'         => $administradores->firstItem(), 
                'to'           => $administradores->lastItem(),
            ],
            'administradores' => $administradores
        ];
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
            array('ç', 'Ç'),
            array('c', 'C'),
            $cadena
        );
    
        return $cadena;
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        if(isset($request->campos))
        {
            if(!is_null($request->campos))
            {
                $data = $request->campos;
            }
        }
        if(isset($request))
        {
            if(!is_null($request))
            {
                $data = $request;
            }
        }
        $dataProfesions = '';
        try{
            DB::beginTransaction();
           
            // Ingresar nueva persona
            $persona = new Persona();
            $persona->primer_nombre = $data["primer_nombre"];
            $persona->segundo_nombre = $data["segundo_nombre"];
            $persona->primer_apellido = $data["primer_apellido"];
            $persona->segundo_apellido = $data["segundo_apellido"];
            $persona->save();
            //  ingresar nuevo usuario a la aplicacion
            $user = new Usuarios();
            $user->id_user = $persona->id;
            $user->email = $data["usuario"];
            if(!empty($data["contrasena"]))
            {
                // encriptamos la contraseña que ingresa ek ciente.
                $user->password = bcrypt($data["contrasena"]);
            }else{
                $user->password =  $data["password"];
            }
            $user->estado_registro = '1';
            $user->idrol=$data["ir"]; 
            $user->save();
            // mensaje 
            var_dump("Guardo correctamente");
            DB::commit();
        } catch (Exception $e){
            var_dump($e);
            DB::rollBack();
        }
    }

        // nueva accion pedida por el (socio de Dacademy)
        // --------------------------------------------------
    public function savealldate(Request $request){
        try{
            DB::beginTransaction();
            
            DB::commit();
        }catch (Exception $e){
            var_dump($e);
            DB:rollBack();
        }
    }
    
    public function verificarcorreo(Request $request){
        $data_consult = Usuarios::where('email','=',$request->correo)->take(1)->get();
        $state =1;
        $data_consult2='';
        $response_text='';
        if(sizeof($data_consult)>0){
            $response_text = "El correo ya existe, intente con otro";
            $state = 0;
            if(isset($request->recuperar)){
                $data_consult2 = Persona::where('id','=',$data_consult[0]->id_user)->select('primer_nombre','primer_apellido','id')->take(1)->get();
            }
        }
       
        return ['answer'=>$response_text,'state'=>$state,"Rdatos"=>$data_consult2];
    }
    public function verImg(Request $request){
        $directory="../public/img/Archivos/usuarios/".$request->carpeta."/";
        $directory_new = "/img/Archivos/usuarios/".$request->carpeta;
        $dirint = dir($directory);
        $array_Img = array();
            while (($archivo = $dirint->read()) != false)
            {
                $orden = array(".",'..');
                $new_string = str_replace($orden,'',$archivo);
                if($new_string != '')
                {
                    $html = $directory_new."/".$archivo;
                    $data = array('imagen'=>$html);
                    array_push($array_Img, $data);
                }else{
                   
                }
                
            }
        $dirint->close();
       
        return ['Fotos'=>$array_Img];
    }
    public function cambiarcontra(Request $request){
        $user_id = $request->usuario_id;
        $new_password = $request->password;
        $user = Usuarios::where('id_user','=',$user_id)->take(1)->get();
        $user[0]->password = bcrypt($new_password);
        $user[0]->save();
        return ["result"=>"Se ha cambiado la contraseña, ya puedes ingresar normal mente"];
    }
    public function cambiarcontra2(Request $request){
        $user_id = $request->usuario_id;
        $new_password = $request->password;
        $user = Usuarios::where('id_user','=',$user_id)->take(1)->get();
        $user[0]->password = bcrypt($new_password);
        $user[0]->save();
        return ["result"=>"Se ha cambiado la contraseña, ya puedes ingresar normal mente"];
    }
    public function enviarcorreo(Request $request){
        $destino = $request->correo;
        $usuario = $request->usuario;
        $mensaje = $request->mensaje;
        $data = array('mensaje' => $mensaje, 'usuario'=>$usuario);
        Mail::send('Emails.recuperar',$data, function($msj) use ($destino){
            $msj->subject('codigo');
            $msj->to($destino);
        });
        return ['response'=>'se ha enviado el mensaje'];
       
    }

    public function dataPersona(Request $request){
        if (!$request->ajax()) return redirect('/');

        if(isset($request->campos))
        {
            if(!is_null($request->campos))
            {
                $data = $request->campos;
            }
        }
        if(isset($request))
        {
            if(!is_null($request))
            {
                $data = $request;
            }
        }
        $dataProfesions = '';
         // ingresando nuevo oficio o profesion 
            if(is_numeric($data["profesion"])){
                $dataProfesions =  $data["profesion"];
            }else if(is_string($data["profesion"])){
                $data_profesion = $this->eliminarTildes($data["profesion"]);
                $data_profesion = strtolower($data_profesion);
                $data_consult = Profesion::where('nombre','like','%'.$data_profesion.'%')->where('state_public','=',0)->where('state_private','=',1)->take(1)->get();
                if(sizeof($data_consult)<=0){
                    $data_consult2 = Profesion::where('nombre','like','%'.$data_profesion.'%')->where('state_public','=',1)->where('state_private','=',0)->take(1)->get();
                    if(sizeof($data_consult2)>0){
                        $dataProfesions = $data_consult2[0]->id;
                    }else{
                        $profesion = new Profesion();
                        $profesion->nombre = strtolower($data_profesion);
                        $profesion->state_private = 1;
                        $profesion->state_public = 0;
                        $profesion->save();
                        $dataProfesions = $profesion->id;
                    }
                }else{
                    $data_consult3 = Persona::where('profesion','=', $data_consult[0]->id)->get();
                    $dataProfesions = $data_consult[0]->id;
                    $count = sizeof($data_consult3) + 1;
                    if($count>=5){
                        $data_consult[0]->state_public = 1;
                        $data_consult[0]->state_private = 0;
                        $data_consult[0]->save();
                    }
                }
            }
            // cliente ingresa ciudad o registra ciudad.
            if(is_numeric($data["ciudad"])){
                $dataCiudads =  $data["ciudad"];
            }else if(is_string($data["ciudad"])){
                $data_ciudad = $this->eliminarTildes($data["ciudad"]);
                $data_ciudad = strtolower($data_ciudad);
                $data_consult = Ciudad::where('nombre','like','%'.$data_ciudad.'%')->where('state_public','=',0)->where('state_private','=',1)->take(1)->get();
                if(sizeof($data_consult)<=0){
                    $data_consult2 = Ciudad::where('nombre','like','%'.$data_ciudad.'%')->where('state_public','=',1)->where('state_private','=',0)->take(1)->get();
                    if(sizeof($data_consult2)>0){
                        $dataCiudads = $data_consult2[0]->id;
                    }else{
                        $ciudad = new Ciudad();
                        $ciudad->nombre = strtolower($data_ciudad);
                        $ciudad->state_private = 1;
                        $ciudad->state_public = 0;
                        $ciudad->save();
                        $dataCiudads = $ciudad->id;
                    }
                }else{
                    $data_consult3 = Persona::where('ciudad','=', $data_consult[0]->id)->get();
                    $dataCiudads = $data_consult[0]->id;
                    $count = sizeof($data_consult3) + 1;
                    if($count>=5){
                        $data_consult[0]->state_public = 1;
                        $data_consult[0]->state_private = 0;
                        $data_consult[0]->save();
                    }
                }
            }
            $persona = Persona::findOrFail(intval(session()->get('id_persona')));
            $persona->n_documento = $data["documento"];
            $persona->tipo_documento = $data["tipo_documento"];
            $persona->trabajo = $data["trabajo"];
            $persona->ciudad = $dataCiudads;
            $persona->perfeccionar = $data["perfeccionar"];
            $persona->autorizacion = $data["autorizacion"];
            $persona->estudiando = $data["estudiando"];
            if($data["buscando_empleo"]=="Sia"){
                $persona->buscando_empleo = "si";
                $persona->ayuda = "si";
            }else if($data["buscando_empleo"]=="Sin"){
                $persona->buscando_empleo = "si";
                $persona->ayuda = "no";
            }else if($data["buscando_empleo"]=="No"){
                $persona->buscando_empleo = "no";
                $persona->ayuda = "no";
            }
             $persona->profesion = $dataProfesions;
             $persona->save();
             return ['success'=>'Se ha guardado correctamente'];





            //  copia de seguridad por si acaso
            // $persona->fecha_nacimiento = $data["fecha_nacimiento"];
            // $persona->direccion = $data["direccion"];
            // $persona->telefono = $data["telefono"];
            // $persona->ciudad = $dataCiudads;
            // // $persona->pais = $data["pais"];
            // $persona->trabajo = $data["trabajo"];
            // $persona->perfeccionar = $data["perfeccionar"];
            // $persona->buscando_empleo = $data["buscando_empleo"];
            // $persona->autorizacion = $data["autorizacion"];
            // $persona->ayuda = $data["ayuda"];
            // $persona->estudiando = $data["estudiando"];
            // $persona->profesion = $dataProfesions;
    }

    public function showDataPeople(){
        $data_consult_data_person = Persona::findOrFail(intval(session()->get('id_persona')));
        if(is_null($data_consult_data_person->n_documento) || is_null($data_consult_data_person->tipo_documento))
        {
            return ['state'=>false];
        }else{
            return ['state'=>true];
        }
    }
}
