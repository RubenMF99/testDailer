@extends('layouts.intructor')

@section('contenido')
<br><br>
<div class="top_heading  style_heading_2_out">
<div class="container">
        
        <div class="container">
    <view-instructor persona="{{session()->get('id_persona')}}" correo="{{session()->get('correo')}}" nombre="{{session()->get('nombre')}}"></view-instructor>
</div>



@endsection