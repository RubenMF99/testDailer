@extends('layouts.app')
@section('contenido')

<div class="container" style="position:relative;top:100px;">
<intro-cursos curso="{{$curso}}" person_name="{{session()->get('nombre')}}" person="{{session()->get('id_persona')}}"></intro-cursos>
</div>


 

@endsection