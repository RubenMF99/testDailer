@extends('layouts.app')
@section('contenido')
<br>
<br>

<div class="top_heading  style_heading_2_out">
<div class="container">
        <div class="row fondo-banner-two">
        <div class="col-md-4">
            <!-- <div class="breadcrumbs-wrapper">
                    <div class="container">
                        <ul itemprop="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs"><li  itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href=" {{asset('')}}" title="Inicio"><span itemprop="name">Inicio</span></a></li><li  itemscope="" itemtype="http://schema.org/ListItem"><span itemprop="name" title="Empresa"> Mis Cursos</span></li></ul>			</div>
                    </div>
	            </div>
            </div> -->
            <div class="col-md-12 ">
            <div class="thim-widget-heading thim-widget-heading-base template-base">
                <div class="sc_heading clone_title text-center ">
                    <h2 style="font-size:28px;font-weight:normal;font-style:inherit;" class="title">Mis Notas</h2><div class="clone">Mis Notas</div></div></div>
            </div>
           
        </div>
    </div>
<div class="container">
    <br>
    <mis-notas idperson = "{{session()->get('id_persona')}}"></mis-notas>
</div>
@endsection