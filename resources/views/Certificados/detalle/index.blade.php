@extends('layouts.app')

@section('contenido')
<br><br>
<div class="container" style="padding:0!important;overflow-x: hidden;">
		<div class="row div-principal-detalle-curso" style="">
		<div class="col-md-12">
                    <div width="100%" class="img-detalle-curso" style="{{'padding:20px;height:270px;background:#337ab7;'}}">
                        <h2 class="title-detalle-curso">{!! $detalle[0]->nombre_curso  !!}</h2>
                    </div>
                    <!-- <img  class="logo-dcademy-detalle"  src="{{URL::asset('/img/cropped-favicon_dacademy-32x32.png')}}" alt=""> -->
                    
		</div>
		</div>
		<div class="row" style="padding-left:40px; padding-right:40px;margin-top:25px;">
				<div class="col-md-8 text-justificado">
                <strong style="font-size:18px;">{!! $detalle[0]->subtitulo_curso !!}</strong>
				<h2>Resumen</h2>
                {!! $detalle[0]->descripcion !!}
                <h2>Temas principales</h2>
				{!! $detalle[0]->TTemas_a_ver !!}
				</div>
                <div class="col-md-4 center">
                @if(isset($detalle[0]->imagen_destacada))
                <img width="60%" style="height:200px;margin-bottom:40px;" src="{{URL::asset('/img/cursos/'.$detalle[0]->imagen_destacada)}}" alt="">
                @else
                <img width="100%" style="height:250px;margin-bottom:40px;" src="{{URL::asset('/img/cursos/placeholder.png')}}" alt="">
                @endif
                <certifi-cards-detalle :curso="{{$detalle}}" persona="{{session()->get('id_persona')}}" ruta="{{asset('')}}"></certifi-cards-detalle>
                </div>
        </div>
        <descargarpdf-certificaciones :curso="{{$detalle}}"></descargarpdf-certificaciones>
        <div class="row" style="margin-top:50px;margin-bottom:30px;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 center">
                        <h2>Detalle de examen</h2>
                        <br>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="fas fa-file-signature icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Nombre del examen:</h2>
                                    <p>{!! $detalle_exam[0]->nombre  !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="fab fa-pied-piper icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Formato del examen:</h2>
                                    <p>{!! $detalle_exam[0]->formato  !!}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <!-- item 2 -->
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                    <i class="fas fa-paper-plane icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Entrega del examen:</h2>
                                    <p>{!! $detalle_exam[0]->entrega  !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="far fa-clock icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Duración del examen:</h2>
                                    <p>{!! $detalle_exam[0]->duracion  !!}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <!-- item 3 -->
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2"> 
                                <i class="fab fa-buffer icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Numero de preguntas:</h2>
                                    <p>{!! $detalle_exam[0]->numero_preguntas  !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="fas fa-chart-line icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Puntaje de aprobación</h2>
                                    <p>{!! $detalle_exam[0]->puntaje_aprobacion  !!}%</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <!-- item 4 -->
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card-exam-details">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="fas fa-globe icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Idiomas disponible:</h2>
                                    <p>{!! $detalle_exam[0]->idioma  !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-exam-details2">
                            <a href="{{asset('/certificaciones/')}}">
                        <div class="row">
                                <div class="col-md-2">
                                <i class="fas fa-file-alt icons-details"></i>
                                </div>
                                <div class="col-md-10">
                                    <h2>Otras certificaciones</h2>
                                    <p>VE AHORA</p>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    
                </div>
            </div>
        </div>
</div>
@endsection