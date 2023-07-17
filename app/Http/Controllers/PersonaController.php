<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Ciudad;
use App\Pais;
class PersonaController extends Controller
{
    public function Listarpersonas(Request $request)
    {
        $criterio = $request->criterio;
        $buscar = $request->buscar;
        $personas = Persona::select('id','primer_nombre')->where('personas.'.$criterio, 'like', '%'. $buscar . '%');
        return['persona'=>$personas];
    }
    public function ListarPais(){
        $data_consult = Pais::orderBy('nombre')->get();
        return ['paises'=>$data_consult];
    }
    public function ListarCiudad(Request $request){
        $data_consult = Ciudad::where('id_pais','=',$request->pais)->get();
        return ['ciudades'=>$data_consult];
    }
}
