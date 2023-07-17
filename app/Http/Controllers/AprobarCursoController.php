<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AprobarCursoController extends Controller
{
    public function index(){
        return view('Cursos.Aprobar.index');
    }
}
