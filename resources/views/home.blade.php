@extends('layouts.app')
@section('contenido')
<br><br>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner center">
    <div class="carousel-item active">
      <img class="d-block w-100 h-500" src="/img/banner/1-1.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
          <h5>Prepárate <br> para el futuro</h5>
          <p style="margin-top:-20px;font-size:25px;">Potencia y certifica tus capacidades  mientras<br> aumentas tus oportunidades en las principales <br> industrias del mundo.</p>
          <p id="btn" class="show " style="margin-top:-2px;"><button-component tourl="1" text="Quiero Registrarme"></button-component></p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-500" src="/img/banner/2-1.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block ">
          <h5>Certifica tus <br> capacidades</h5>
          <p style="margin-top:-20px;font-size:25px;">Somos Certified Education Center de  Certjoin, una <br> de las principales certificadoras internacionales<br>  en habilidades  digitales y tecnológicas.</p>
          <p id="btn" class="show "  style="margin-top:-2px;"><button-component tourl="2" text="Ver Certificaciones"></button-component></p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-500" src="/img/banner/3-1.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
          <h5>Emprende a tu ritmo <br> con profesionales</h5>
          <p style="margin-top:-20px;font-size:25px;">Contamos con facilitadores que poseen  un valor <br> importante en cada uno de los  sectores  de  la <br>industria, aprende desde su experiencia y habilidades.</p>
          <p id="btn" class="show "  style="margin-top:-2px;"><button-component tourl="3" text="Ver Cursos"></button-component></p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- ------------------------------------------------------------------------------------------------------ -->
<!--<div class="container center padding-lef-right" style="position:relative; margin-bottom:50px; ">
<div class="row" style="padding-left:20px; padding-right:20px;">
    <div class="col-md-6 col-xs-12 img-p-home">
        <img src="/img/persona/pregunta.png" alt="">
    </div>
    <div class="col-md-6">
        <br>
        <br>
        <br>
        <br><br>
        <h2 style="font-size:35px;font-weight:800;" >Bienvenidos a D-Academy </h2>
        <h4 style="color:#000;"></h4>
        <p style="color:#000;font-size:16px;text-align:center;" class="text-justificado">Diseñada para brindar una experiencia de estudio ágil 
          y sin complicaciones,<br> D-Academy es la academia que te ayudará a potencializar 
          y certificar tus conocimientos en las áreas específicas donde laboras día a día.
<br>
        </p>
        <button >Seguir Leyendo</button>
         <button >Seguir Leyendo</button> 
    </div>
</div>-->

<!-- ------------------------------------------------------------------------------------------------------------- -->
<div id="endacademy" class="container bg-1 center padding-lef-right" style="position:relative; margin-bottom:40px;padding-bottom:80px;padding-top:80px; ">
  <div class="row">
    <div class="col-md-1 col-sm-12"></div>
    <div class="col-md-10 col-sm-12">
        <div class="row">
          <div class="col-md-4 col-sm-12">
              <div class="card mb-3" style="max-width: 540px; height:250px;">
                <div class="row no-gutters">
                  <div class="col-md-4 col-xs-4">
                    <img style="width:100%; height:250px;" src="/img/fondos/preparate para el futuro.png" alt="...">
                  </div>
                  <div class="col-md-8 col-xs-8">
                    <div class="card-body">
                      <h5 class="card-title" style="font-size:25px;padding-left:20px; padding-right:20px;">Preparate para el futuro</h5>
                      <p class="card-text">Aprende las habilidades más recientes</p>
                      <p class="card-text"><small class="text-muted">Periodos de 3 a 6 meses</small></p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-12">
          <div class="card mb-3" style="max-width: 540px; height:250px;">
                <div class="row no-gutters">
                  <div class="col-md-4 col-xs-4">
                    <img style="width:100%; height:250px;" src="/img/fondos/obten tu titulo profesional.png" alt="...">
                  </div>
                  <div class="col-md-8 col-xs-8">
                    <div class="card-body">
                      <h5 class="card-title" style="font-size:25px;padding-left:20px; padding-right:20px;">Obten tu titulo profesional</h5>
                      <p class="card-text">líderes en negocios, ciencias informáticas y mucho más.</p>
                      <p class="card-text"><small class="text-muted">!00% Profesional.</small></p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-12">
          <div class="card mb-3" style="max-width: 540px; height:250px;">
                <div class="row no-gutters">
                  <div class="col-md-4 col-xs-4">
                    <img style="width:100%; height:250px;" src="/img/fondos/mejora tu organizacion.png" alt="...">
                  </div>
                  <div class="col-md-8 col-xs-8">
                    <div class="card-body">
                      <h5 class="card-title" style="font-size:25px;padding-left:20px; padding-right:20px;">Mejora tu Organización</h5>
                      <p class="card-text">Con programas de desarrollo y capacitación.</p>
                      <p class="card-text"><small class="text-muted">Actualiza los certificados.</small></p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-1 col-sm-12"></div>
  </div>
</div>

<div class="container center padding-lef-right" style="position:relative; margin-bottom:10px; ">
<div class="row" style="padding-left:20px; padding-right:20px;">
                        <div class="col-md-12 espacio" style="margin-bottom:60px;">
                            <h2 style="color:#000; font-size:35px; font-weight: 500;">La Primera Academia Pensada 100% En La Industria</h2>
                            <p>Diseñada para brindar una experiencia de estudio ágil 
          y sin complicaciones,<br> D-Academy es la academia que te ayudará a potencializar 
          y certificar tus conocimientos en las áreas específicas donde laboras día a día.</p>
                        </div>
                        <div class="col-md-3 espacio" style="cursor:pointer;">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:200px;"  src="/img/cursos/curso-digital.jpg" alt="Card image cap">
                                    <div class="card-body" style="z-index:10;padding-bottom:30px;">
                                        <h5 class="card-title" style="font-size:27px;">Cursos</h5>
                                        <p class="card-text" style="text-align:justify;">Aprovecha nuestra oferta académica de cursos especializados por industria, acompañado de sus habilidades y experiencias.</p>
                                        <a style="font-size:16px;" href="/Busqueda?que_deseas_aprender=Cursos"><strong>Ver Cursos</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 espacio" style="cursor:pointer;">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:200px;"  src="/img/cursos/diplomados.jpg" alt="Card image cap">
                                    <div class="card-body" style="z-index:10;padding-bottom:30px;">
                                        <h5 class="card-title" style="font-size:27px;">Diplomados</h5>
                                        <p class="card-text" style="text-align:justify;" >Teniendo en cuenta el contínuo cambio de las diferentes necesidades de las industrias, nuestros diplomados te ayudarán a fortalecer y crear...</p>
                                        <a style="font-size:16px;" href="/Busqueda?que_deseas_aprender=Diplomados"><strong>Ver Diplomados</strong></a>
                                    <!-- esas nuevas capacidades que son requeridas actualmente en el mundo laboral.-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 espacio" style="cursor:pointer;">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:200px;"  src="/img/cursos/master-class.jpg" alt="Card image cap">
                                    <div class="card-body" style="z-index:10;padding-bottom:30px;">
                                        <h5 class="card-title" style="font-size:27px;">Master Class</h5>
                                        <p class="card-text" style="text-align:justify;">Accede a miles de lecciones de profesionales prominentes mientras comparten sus historias, habilidades, atajos, fracasos y éxitos.</p>
                                        <a style="font-size:16px;" href="/Busqueda?que_deseas_aprender=Master Class"><strong>Ver Master Class</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 espacio" style="cursor:pointer;">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:200px;"  src="/img/cursos/certificaciones.jpg" alt="Card image cap">
                                    <div class="card-body" style="z-index:10;padding-bottom:30px;">
                                        <h5 class="card-title" style="font-size:27px;">Certificaciones</h5>
                                        <p class="card-text" style="text-align:justify;">Aprovecha la alianza D-Academy – Certjoin y accede a las mejores certificaciones online, con simuladores y 2 oportunidades...</p>
                                        <!-- para presentar los examenes. -->
                                        <a style="font-size:16px;" href="/Busqueda?que_deseas_aprender=Certificaciones"><strong>Ver Certificaciones</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
</div>

<!-- ------------------------------------------------------------------------------------------------------ -->
<br><br>
</div>
<!-- Ofertas academicas -->
<!-- ------------------------------------------------------------------------------------------------------ -->
<!--<div class="center oferta-academy">
  <h2 style="font-size:35px;font-weight:800;"><strong>Oferta <span style="color:#FF9700;">Académica</span></strong></h2>
  <hr>
</div>
<div class="container center padding-lef-right fondo-textura" style="position:relative; margin-bottom:30px;">
<cursoscate-component></cursoscate-component>
</div>-->
<!-- Certificaciones  -->
<!-- ------------------------------------------------------------------------------------------------------- -->
<div class="container center ddco-certif-container">
    <div class="row" style="padding-left:20px; padding-right:20px;padding-bottom:40px;">
    
        <div class="col-md-1 col-sm-1 col-xs-1 spacing-top center "></div>
        <div class="col-md-6 col-sm-12 col-xs-12 spacing-top center  spacing-bottom div-editable">
              <h2>¡Obtén Credenciales Reconocidas Por La Industria! </h2>
              <!-- <h4>Te ofrecemos los mejores cursos, diplomados, master clases, etc. para tu empresa</h4> -->
              <p 
              >Brindamos acceso conveniente donde y cuando lo necesites,
              así como también brindamos facilidad para tomar nuestros exámenes (24 × 7) en 
           cualquier momento en cualquier parte del mundo.  
              </p>
              <button onclick="modal();" style="background:#fff;float:left;font-size:20px;padding:25px;text-transform:capitalize;color:#337ab7!important;">Quiero Registrarme</button>
              <!-- , nuestra plataforma tecnológica 
              permite tomar y volver a tomar exámenes 
              de certificación de acuerdo con las políticas establecidas -->
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1 spacing-top center"></div>
        
    
  
  </div>

</div>
<!-- Certijoin -->
<!-- ------------------------------------------------------------------------------------------------------- -->
<div class="container center padding-lef-right" style="position:relative; margin-bottom:70px;">
    <div class="row" style="padding-left:20px; padding-right:20px;">
    <div class="col-md-1">
        </div>
    <div class="col-md-5 movil-col">
          <img style="height:430px; width:95%;" src="/img/persona/certifi.jpg" alt="">
          <!--<img style="height:230px; width:90%;" src="/img/Socios/6.png" alt="">
          <img style="height:100px; width:70%;" src="/img/Socios/insignias.png" alt=""> -->
        </div>
        <div class="col-md-5 spacing-top movil-col2 ">
        <img style="height:60px; width:30%;" src="/img/Socios/Logo-Cerjoin.png" alt="">
          <h2 style="font-size:35px;font-weight:500;">Somos Centro Certificador Internacional </h2>
          <!-- <h4>Te ofrecemos los mejores cursos, diplomados, master clases, etc. para tu empresa</h4> -->
          <p style="font-size:18px;color#000;" class="text-justificado">Nos enorgullece mencionar que somos un Certified  
            Education Center de la empresa certificadora internacional Certjoin, 
            miembro de Corporativo de la Agile Alliance.  <br>
          </p>
        <button style=" text-transform:Capitalize;font-size:18px;padding:10px;font-weight:400;" onclick="enviarCErtijoin();" >Seguir Leyendo</button>
        </div>
        
        <div class="col-md-1">
        </div>
    </div>
</div>
<!-- Redireccionar a certijoin -->
<!-- habilidades -->
<!-- ------------------------------------------------------------------------------------------- -->
<section id="habilidades">
<div class="container">
<div class="row">
<div class="col-md-12">
  <h2 style="color:rgba(0,0,0,1);text-align:center;text-transform:capitalize;font-weight:500;font-size:35px;">en d-academy te ofrecemos</h2>
</div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-2">
        <i class="far fa-bookmark"></i>
        </div>
        <div class="col-md-10">
            <h2>Aprende a tu ritmo</h2>
            <p>Disfruta de los cursos desde casa, sin horarios ni entregas. Tú marcas tu propia agenda.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <i class="far fa-thumbs-up"></i>
        </div>
        <div class="col-md-10">
            <h2>De la mano del profesor</h2>
            <p>Aprende técnicas y métodos de gran valor explicados por los grandes expertos del sector creativo.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
        <i class="fas fa-chalkboard"></i>
        </div>
        <div class="col-md-10">
            <h2>Profesores expertos</h2>
            <p>Cada profesor imparte solo lo que mejor sabe hacer, asegurando transmitir la pasión y la excelencia en cada lección.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
        <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="col-md-10">
            <h2>Certificate</h2>
            <p>Certificados en todos los cursos: cuando completes un curso obtendrás un certificado personalizado firmado por el profesor para que lo puedas compartir.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-2">
        <i class="fas fa-laptop"></i>
        </div>
        <div class="col-md-10">
            <h2>En primera fila</h2>
            <p>Vídeos de máxima calidad para que no pierdas detalle. Y como el acceso es ilimitado, puedes verlos una y otra vez.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
        <i class="fas fa-users"></i>
        </div>
        <div class="col-md-10">
            <h2>Comparte conocimiento</h2>
            <p>Expón tus dudas, pide feedback, aporta soluciones. Comparte el aprendizaje con el resto de los alumnos de la comunidad.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
        <i class="far fa-lightbulb"></i>
        </div>
        <div class="col-md-10">
            <h2>Comunidad creativa</h2>
            <p>Más de 5M creativos y creciendo. Domestika es el entorno ideal para compartir y aprender lo que te apasiona.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
        <i class="far fa-id-badge"></i>
        </div>
        <div class="col-md-10">
            <h2>Cursos producidos profesionalmente</h2>
            <p>Seleccionamos a los mejores creativos y un equipo profesional produce el curso con ellos. El resultado: sentirás que trabajas mano a mano con los mejores.</p>
        </div>
      </div>
    </div>
</div>
  
  </div>
</section>
<script>
function enviarCErtijoin(){
  // windown.location.href = "https://certjoin.com/about-us/#whycertijoin";
  window.open('https://certjoin.com/about-us/#whycertijoin');
}
function Certificacion(){
  window.location.href = "/certificaciones/";
}

function modal(){
  document.getElementById('R').click();
}
</script>
<br>
</div>
@endsection
