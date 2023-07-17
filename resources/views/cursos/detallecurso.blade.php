@extends('layouts.app')

@section('contenido')

<br><br><br><br>
<div class="container" >
		<div class="row div-principal-detalle-curso" style="padding-left:40px; padding-right:40px;">
		
		<div class="col-md-9">
					@if($curso[0]->id_tipo_curso==3)
						<div class="ddco-float-div"  style="background:#337ab7;">Master Class</div>
                    @elseif ($curso[0]->id_tipo_curso==2)
					    <div class="ddco-float-div"  style="background:#015D52;">Curso</div>
					@elseif ($curso[0]->id_tipo_curso==4)
					    <div class="ddco-float-div"  style="background:#FF9700;">Certificacion</div>
					@elseif ($curso[0]->id_tipo_curso==1)
					    <div class="ddco-float-div"  style="background:#000;">Diplomado</div> 
					@endif
				
				@if(isset($curso[0]->imagen_destacada))
					<img width="100%" class="img-detalle-curso" style="height:550px;margin-top:-2.5em;" src="{{URL::asset('/img/cursos/' .$curso[0]->imagen_destacada)}}" alt="">
				@else
					<img width="100%" style="height:550px;margin-top:-2.5em;" src="{{URL::asset('/img/cursos/placeholder.png' )}}" alt="">
				@endif
				
		</div>
				
				<pagar-curso :curso ='{{$curso}}' persona="{{session()->get('id_persona')}}" ruta = {{asset('')}} ></pagar-curso>
		</div>
		<div class="row" style="padding-left:40px; padding-right:40px;margin-top:25px;">
				<div class="col-md-9">
				<strong>{!! $curso[0]->subtitulo_curso !!}</strong>
				</div>
				<div class="col-md-9 text-justificado">
				<h2>Descripcion del curso</h2>
				{!! $curso[0]->descripcion !!}
				</div>
				
		</div>
</div>
@endsection