@extends('layouts.app')

@section('contenido')
<br><br><br>

        <div class="container">
        
            <estudiante-perfil  ruta = {{asset('')}} person="{{session()->get('id_persona')}}"></estudiante-perfil>
        
        
        </div>



@endsection