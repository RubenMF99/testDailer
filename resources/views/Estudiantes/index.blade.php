@extends('layouts.admin')

@section('contenido')
<div class="top_heading  style_heading_2_out">
<div class="container">
        <div class="row">
        <div class="col-md-4">
            <div class="breadcrumbs-wrapper">
                    <div class="container">
                        <ul itemprop="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs"><li  itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href=" {{asset('')}}" title="Inicio"><span itemprop="name">Inicio</span></a></li><li  itemscope="" itemtype="http://schema.org/ListItem"><span itemprop="name" title="Aprobar Curso"> Estudiante</span></li></ul>			</div>
                    </div>
	            </div>
            </div>
            <div class="col-md-8">
            <div class="thim-widget-heading thim-widget-heading-base template-base">
                <div class="sc_heading clone_title  text-center">
                    <h2 style="text-transform: uppercase;font-size:28px;font-weight:normal;font-style:inherit;" class="title">Estudiante</h2><div class="clone">Estudiante</div></div></div>
            </div>
           
        </div>
    </div>
        <div class="container">
        <estudiante-component  ruta = {{asset('')}}></estudiante-component>
</div>



@endsection