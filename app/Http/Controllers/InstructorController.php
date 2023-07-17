<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Persona;
use App\Instructor;
use App\Usuarios;

class InstructorController extends Controller
{
    public function detalleInstructor($slug){
        $instructor = Instructor::join('personas','instructors.id_persona','=','personas.id')
        ->where('instructors.slug','=',$slug)->get();
        return $instructor;
    }
    public function index(){
        return view('Instructores.index');
    }
    public function listarInstructores(Request $request){
        $criterio = $request->criterio;
        $buscar = $request->buscar;
    
        if ($buscar==''){
            $instructores = Instructor::join('personas','instructors.id_persona','=','personas.id')->paginate(3);
       
        }else{
            $instructores = Instructor::join('personas','instructors.id_persona','=','personas.id')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->paginate(3);
       
        }
        return [
            'pagination' => [
                'total'        => $instructores->total(),
                'current_page' => $instructores->currentPage(),
                'per_page'     => $instructores->perPage(),
                'last_page'    => $instructores->lastPage(),
                'from'         => $instructores->firstItem(), 
                'to'           => $instructores->lastItem(),
            ],
            'instructores' => $instructores
        ];
    }
    public function store(Request $request){
        if(isset($request->campos))
        {
            if(!is_null($request->campos))
            {
                $campos = $request->campos;
            }
        }
        if(isset($request))
        {
            if(!is_null($request))
            {
                $campos = $request;
            }
        }
        $texto = $campos['primer_nombre'] .' '. $campos['primer_apellido'];

        try{
            DB::beginTransaction();

            $persona = new Persona();
            $persona->n_documento = $campos['documento'];
            $persona->tipo_documento = $campos['tipo_documento'];
            $persona->primer_nombre = $campos['primer_nombre'];
            $persona->segundo_nombre = $campos['segundo_nombre'];
            $persona->primer_apellido = $campos['primer_apellido'];
            $persona->segundo_apellido = $campos['segundo_apellido'];
            $persona->ciudad = $campos["ciudad"];
            $persona->save();
            

            $instructor = new Instructor();
            $instructor->id_persona = $persona->id;
            $instructor->biografia = $campos['biografia'];   
            $instructor->slug = self::url($texto); 
            $instructor->ensenar = $campos['ensena_profe'];
            $instructor->video = $campos['video'];
            $instructor->ampliar=$campos['ampliar_conoci'];
            $instructor->save();

            $usuario = new Usuarios();
            $usuario->id_user = $persona->id;
            $usuario->email = $campos['usuario'];
            $usuario->password = bcrypt($campos['contrasena']);
            $usuario->estado_registro = 1;
            $usuario->idrol = 2;
            $usuario->save();
            var_dump("Guardo correctamente");
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        return $campos;
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

