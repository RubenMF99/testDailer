
@extends('layouts.intructor')
@section('contenido')
<br><br>
<div class="top_heading  style_heading_2_out">
<div class="container">
        <div class="container">
        <compra-certifi-component :compras = "{{$compras}}" ruta = {{asset('')}}></compra-certifi-component>
</div>
@endsection