@extends('layouts.intructor')

@section('contenido')
<br><br>
<div class="top_heading  style_heading_2_out">
<div class="container">
        
        <div class="container">
        <modulo-curso idperson="{{session()->get('id_persona')}}" ></modulo-curso>
</div>
@endsection