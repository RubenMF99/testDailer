<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;

class NivelController extends Controller
{
    public function selectNivel(){
        $niveles = Nivel::where('estado_registro','=',1)->get();
        return ['niveles' => $niveles];
    }
}
