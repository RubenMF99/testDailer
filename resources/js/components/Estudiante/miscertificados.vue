<template>
    <div class="row">
        <div class="col-md-12 col-sm-12" >
            <div class="row none-padding" style="padding-left:30px;padding-right:30px;">
                <div class="col-md-12" style="justify-content:center;">
                    <div style="margin-top:50px; margin-bottom:50px;text-align:center;" v-if="listCursos.length<=0">
                        <i style="font-size:80px; color:rgba(0,0,0,0.2);margin-bottom:20px;" class="far fa-times-circle"></i>
                        <p style="text-align:center;margin-left:auto; margin-right:auto;font-size:20px;">No hay Certificados Disponibles para ti</p>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-12 cuadroP" style="margin-left:15px;" v-for="(item, index) in listCursos" :key="index">
                    <div class="cuadrocert" > 
                        <img style="width:100%; height:200px;margin-top:15px;" v-if="item.curso[0].imagen_destacada" :src="'/img/cursos/'+item.curso[0].imagen_destacada" @click="abrir(item.curso[0].nombre_curso,item.codigoBarra,item.curso[0].duracion_numero,item.curso[0].nombre_tipo_duracion,item.fecha,item.curso[0].id_tipo_curso);" alt="">
                        <img style="width:100%; height:200px;margin-top:15px;" v-else src="/img/cursos/placeholder.png" @click="abrir(item.curso[0].nombre_curso,item.codigoBarra,item.curso[0].duracion_numero,item.curso[0].nombre_tipo_duracion,item.fecha,item.curso[0].id_tipo_curso);" alt="">
                        <p style="text-align:left;font-size:18px;padding-top:15px;padding-left:10;padding-right:10px;padding-bottom:0px;"> {{item.curso[0].nombre_curso}}</p>
                    </div>
                    <div class="col-md-12"><p style="margin-top:-5px;"> <strong>Referencia:</strong> {{item.codigoBarra}}</p></div>
                    <div class="col-md-12">
                        <div class="button-download">
                        <a id="verDiploma" @click="abrir(item.curso[0].nombre_curso,item.codigoBarra,item.curso[0].duracion_numero,item.curso[0].nombre_tipo_duracion,item.fecha,item.curso[0].id_tipo_curso);"> ver Certificado  <i class="fas fa-file-download"></i></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title center hide-certifi-movil" style="text-align:center;" id="exampleModalLongTitle"><strong> VISTA PREVIA DEL CERTIFICADO</strong> </h5>
        <h5 class="modal-title center show-certifi-movil" style="text-align:center;" id="exampleModalLongTitle"><strong> DESCARGA AHORA TU CERTIFICADO</strong> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body hide-certifi-movil">
        <div style="font-family:roboto;position:relative; height:670px; width:100%; background-image: url('/certificado_estruct/fondos/CERTIFICADO D-ACADEMY.png');background-repeat: no-repeat;background-size: 100%,cover;background-position:center center; color: #000;">
        <div style="text-aling:left; top:140px; position:relative; padding-left:48px;">
            <canvas  id="CodBarra" style="background:transparent;float:right; position:relative; margin-right:0.5%; margin-top:-110px;"></canvas>
            <p style="position:relative; font-size:20px; margin-bottom:15px;text-align:left;padding-top:50px; color:#337ab7;">Certifica que</p>
            <p style="position:relative;text-transform:uppercase; font-size:45px;margin-bottom:3px;text-align:left;color:#FF9700;"><strong style="font-weight:400;">{{this.nombre_estudiante}}</strong><br>
            </p>
            <p style="font-size:20px;text-align:left;color:#3490dc;margin-top:10px;">Identificado con {{this.tipo_documento}} <br> N° {{this.documento}}</p>
            <p style="position:relative;font-size:20px; text-align:left;margin-bottom:10px;color:#3490dc;margin-top:-8px;">Cursó y aprobó {{this.typecourse}}</p>
        <p style="position:relative; text-transform: uppercase; text-align:left; width:70%;"> <strong style="font-size:25px;color:#3490dc;font-weight:400;">{{this.nombre_curso}}</strong><br>
        <p style="text-align:left;font-size:20px;position:relative;margin-top:-3px;margin-bottom:-4px;color:#3490dc;">Con una duración de <strong>{{this.duracion}}</strong> se hace entrega</p>
        <p style="position:relative; font-size:20px; text-align:left; color:#3490dc;"> de esta constancia a los <strong>{{this.dia}}</strong> dias  del mes <br> de <strong>{{this.mesaño}}.</strong><br>
            </p>
            
    
</div>
</div>
      </div>
      <div class="modal-body center show-certifi-movil">
          <br>
          <img style=" width:150px; height:40px;" src="img/logo_d_academy.png" alt=""> 
          <br>
          <br>
        <p><strong>¿Deseas descargar certificado?</strong></p>
        
    </div>
      <div class="modal-footer hide-certifi-movil">
             <div class="row" style="width:100%;">
                  <div class="col-md-8">
                    <img style=" width:150px; height:40px;" src="img/logo_d_academy.png" alt="">
                </div>
                <div class="col-md-4">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" >
                        <a @click="convertir();">Descargar</a>
                        </button>
                </div>
             </div>
      </div>
       <div class="modal-footer center show-certifi-movil">
             <div class="row" style="width:100%;">
                  <div class="col-md-8">
                    <!-- <img style=" width:150px; height:40px;" src="img/logo_d_academy.png" alt=""> -->
                </div>
                <div class="col-md-4">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" >
                        <a @click="convertir();">Descargar</a>
                        </button>
                </div>
             </div>
      </div>
    </div>
  </div>
</div>
       
</div>
</template>

<script>
// import Vuesax from 'vuesax'

import jsPDF from 'jspdf'
export default {
    props:['idperson'],
    data(){
        return{
            titulo_curso:'',
            img:{
                img1:'../public/',
            },
            listCursos:[],
            dataEstudiante:[],
            dataDirector:[],
            nombre_curso:'',
            tipo_documento:'',
            documento:'',
            director:'',
            nombre_estudiante:'',
            duracion:'',
            dia:'',
            mesaño:'',
            typecourse:'',
        }
    },
    computed:{},
    mounted(){
        this.listarCertificados();
    },
    methods:{
        listarCertificados: function()
        {
            let me=this;
                
                var url=  '/miscertificados?CodEstudiante='+me.idperson;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    let data = respuesta.certificados;
                        if(data!==0)
                        {
                            me.dataEstudiante = data.estudiante;
                            me.dataDirector = data.director;
                            me.listCursos = data.info_curso;
                            if(localStorage.getItem('dataperson')===null||localStorage.getItem('dataperson')===undefined||localStorage.getItem('dataperson')===''){

                            }else{
                                localStorage.removeItem('dataperson');
                                $('#verDiploma').click();
                            }
                        }
                        
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        abrir: function(curso, codigo, duracion, tipoduracion,fecha,typeCourse){
            let me = this;
            if(me.dataEstudiante[0].n_documento===null||me.dataEstudiante[0].n_documento===undefined||me.dataEstudiante[0].n_documento===""){
                localStorage.setItem('dataperson','si');
                $('#datospersonales').modal("show");
            }else{
            // alert(me.dataDirector[0].segundo_nombre);
            me.titulo_curso = curso;
            me.nombre_curso = curso;
            let directorName = " ";
            let directorLastName = " ";
            if(me.dataDirector[0].segundo_nombre===null||me.dataDirector[0].segundo_nombre===undefined||me.dataDirector[0].segundo_nombre===""){
            }else{
                 directorName = " "+me.dataDirector[0].segundo_nombre+" ";
            }
            if(me.dataDirector[0].segundo_apellido===null||me.dataDirector[0].segundo_apellido===undefined||me.dataDirector[0].segundo_apellido===""){
            }else{
                 directorLastName = " "+me.dataDirector[0].segundo_apellido+" ";
            }
            
            me.director = me.dataDirector[0].primer_nombre+directorName+me.dataDirector[0].primer_apellido+directorLastName;
            me.nombre_estudiante = me.dataEstudiante[0].primer_nombre+" "+me.dataEstudiante[0].primer_apellido;
            me.tipo_documento =  me.tipodoc(me.dataEstudiante[0].tipo_documento);
            me.documento = me.dataEstudiante[0].n_documento;
            me.duracion = duracion+" "+tipoduracion;
            let fecha_act = fecha.substring(10,0);
            me.dia = fecha_act.substring(10,8);
            let mes = fecha_act.substring(7,5);
            let mesletter = me.convertirdeNaL(parseInt(mes));
            let año = fecha_act.substring(4,0);
            me.mesaño = mesletter+ " del "+ año;
            me.typecourse = me.typeC(parseInt(typeCourse));
            JsBarcode("#CodBarra", codigo,{height:40, background:'transparent'});
            $('#exampleModalCenter').modal('show');
            }
        },
        typeC:function(val){
            switch(val){
                case 1:
                    return 'el Diplomado';
                break;
                case 2:
                    return 'el Curso';
                break;
                case 3:
                    return 'la Master Class';
                break;
                case 4:
                    return 'la Certificación';
                break;
                default:
                    return 'ultimo'+val;
                    break;

            }
        },
        tipodoc: function(doc){
            switch(doc){
                case 'CC':
                    return 'cedula de ciudadania';
                break;
                case 'TI':
                    return 'tarjeta de identidad';
                break;
                case 'CE': 
                    return 'cedula de extranjeria';
                break;
                case 'RC':
                    return 'registro civil';
                break;
                    default:
                        return '';
                    break;
            }
        },
        convertir:function(){
            // convertir 
            let me = this;
            
                            let url2 = "/request-data";
                            axios.get(url2).then(function(response){
                                let data = response.data;
                                if(data.state)
                                {
                                    let cod =  document.getElementById("CodBarra");
                                    window.location.href = "/Dpdf?codBarra="+cod.toDataURL()+"&nombreCurso="+me.nombre_curso+"&nombreEstudiante="+me.nombre_estudiante+
                                    "&horas="+me.duracion+"&director="+me.director+"&numero_cedula="+me.documento+"&tipo_cedula="+me.tipo_documento+"&dia="+me.dia+"&mesaño="+me.mesaño+"&tipocurso="+me.typecourse;
     
                                }else{
                                    // localStorage.setItem('button','comprar');
                                    $('#datospersonales').modal("show");
                                }
                            }).catch(function(error){
                                console.log(error);
                            });
            
            
              },
        convertirdeNaL:function (numeric_month) {
            switch(numeric_month){
                case 1:
                    return 'enero';
                    break;
                case 2:
                    return 'febrero';
                    break;
                case 3:
                    return 'Marzo';
                    break;
                case 4:
                    return 'Abril';
                    break;
                case 5:
                    return 'Mayo';
                    break;
                case 6:
                    return 'Junio';
                    break;
                case 7:
                    return 'Julio';
                    break;
                case 8:
                    return 'Agosto';
                    break;
                case 9:
                    return 'Septiembre';
                    break;
                case 10:
                    return 'Octubre';
                    break;
                case 11:
                    return 'Noviembre';
                    break;
                case 12:
                    return 'Diciembra';
                    break;
                    default:
                        return 'no hay mes';
                        break;
            }
        }
        
    }
}
</script>