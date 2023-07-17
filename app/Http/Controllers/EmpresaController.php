<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;

class EmpresaController extends Controller
{
    public function index(){
        return view('Empresa.index');
    }
    public function listarEmpresa(){

        $empresa = Empresa::paginate(3);
        return [
            'pagination' => [
                'total'        => $empresa->total(),
                'current_page' => $empresa->currentPage(),
                'per_page'     => $empresa->perPage(),
                'last_page'    => $empresa->lastPage(),
                'from'         => $empresa->firstItem(), 
                'to'           => $empresa->lastItem(),
            ],
            'empresa' => $empresa
        ];
    }
    public function store(Request $request){
        $campos=  $request->campos;
       
        
        try{
            DB::beginTransaction();
+
            $empresa = new Empresa();
            $empresa->nit = $campos['nit'];
            $empresa->razon_social = $campos['razon_social'];
            $empresa->direccion = $campos['direccion'];
            $empresa->telefono = $campos['telefono'];
            $empresa->numero_empleados = $campos['num_empleado'];
            $empresa->save();

            $user = new User();
            $user->id_user = $empresa->id;
            $user->email =  $campos['correo_electronico']; 
            $user->idrol = 3;
            $user->password = bcrypt(self::url($campos['razon_social']));
            $user->save();
            Mail::send(['text'=>'hola como estas'], function($msj){
                $msj->subject('codigo');
                $msj->from('hello@app.com', 'Your Application');
                $msj->to('luis.viloria.ordonez@gmail.com');
            });
            DB::commit();
        } catch (Exception $e){
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
