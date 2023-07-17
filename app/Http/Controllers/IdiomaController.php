<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idioma;

class IdiomaController extends Controller
{
    public function selectIdioma(){
        $idiomas = Idioma::where('estado_registro','=',1)->get();
        return ['idiomas' => $idiomas];
    }
}
