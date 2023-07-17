@extends('layouts.app')
@section('contenido')
<br><br>
<div class="row">
    <div class="col-md-12 h-5002 fondo-home-banner" style="">
    </div>
</div>
<div class="container">

<div class="row" style="margin-bottom:-12px;">
    <div class="col-md-12" style="border-bottom:1px solid rgba(0, 0, 0, 0.2);border-top:1px solid rgba(0, 0, 0, 0.2);">
        <div class="col-md-6" >
        <p class="banner-left" >Home / Oferta academica</p>
        </div>
        <div class="col-md-6">
        <p class="banner-right" ><strong>¡Bienvenido {{session()->get('nombre')}}!</strong> </p>
        </div>
    </div>
    
</div>
</div>
<div class="container center" style="position:relative; margin-bottom:30px;">
<cursos-cate></cursos-cate>
</div>
<br><br>

@endsection
