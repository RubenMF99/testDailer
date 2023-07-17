@extends('layouts.app')
@section('contenido')


<cursando-curso curso ="{{$curso}}" idperson = "{{session()->get('id_persona')}}"></cursando-curso>


@endsection