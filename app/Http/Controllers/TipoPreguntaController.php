<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TipoPregunta;

class TipoPreguntaController extends Controller
{
    public function selectTipoPregunta(){
        $tipopregunta = TipoPregunta::where('estado_registro','=','1')->get();
        return ['tipopregunta'=> $tipopregunta];

    }
}
