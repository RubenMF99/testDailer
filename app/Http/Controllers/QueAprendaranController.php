<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoAprederan;
use App\QueAprendiste;
use Illuminate\Support\Facades\DB;

class QueAprendaranController extends Controller
{
    public function listarQueAprenderan(){
    
        $queaprendiste = CursoAprederan::join('cursos','cursos_aprederan.id_cursos','=','cursos.id')
        ->join('que_aprendistes','cursos_aprederan.id_que_aprederan','=','que_aprendistes.id')
        
        ->where('cursos.id','=',1)->select('que_aprendistes.*')->get();
        return ['queaprendiste'=>$queaprendiste];
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $queaprendiste = new QueAprendiste();
            $queaprendiste->descripcion = $request->descripcion;
            $queaprendiste->slug =  self::slug($request->descripcion);
            $queaprendiste->conteo =  1;
            $queaprendiste->estado_registro =  1;
                  
            $queaprendiste->save();

            $cursoaprenderan = new CursoAprederan();
            $cursoaprenderan->id_cursos = 1;
            $cursoaprenderan->id_que_aprederan = $queaprendiste->id;
            $cursoaprenderan->save();

        

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        return $queaprendiste;
    }
    public function edit($url){

    }
    public static function slug($text)
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
