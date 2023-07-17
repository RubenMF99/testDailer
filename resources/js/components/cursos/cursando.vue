<template>
<div class="container">
    <!-- empieza el curso -->
<div class="row" style="position:relative;top:60px;" v-if="view!=true">
    <div class="col-md-1 col-sm-12 menu-cursado">
        <!-- background:#337ab7 azul-->
        <!-- FF9821 amarillo -->
        <div class="row" style="color:#337ab7;border-radius:8px; margin-top:10px;">
            <!-- Modulos items -->
                      
    <div class="col-md-12 col-xs-12 content-actios-links" >
          <div class="row">
             <div class="col-md-12">
                 <p style="font-size:14.5px; text-align:left;" v-if="parcialfinals!=true">
                     <div class="row">
                         <div class="col-md-12 col-xs-3 actions-links-icons">
                             <div class="content-links" data-toggle="modal" data-target="#modalModule" style="cursor:pointer;">
                                 <i class="fas fa-database"> </i>   
                                <a href="#" style="color:#FF9821"><span style="color:#808080;">Modulos</span></a> 
                             </div>
                        </div>
                         <div class="col-md-12 col-xs-3 actions-links-icons">
                             <div class="content-links">
                                 <i class="fas fa-video"> </i>   
                                <a href="#video" style="color:#FF9821"><span style="color:#808080;">Video</span></a> 
                             </div>
                        </div>
                         <div class="col-md-12 col-xs-3 actions-links-icons">
                             <div class="content-links">
                                <i class="fas fa-book"></i>
                                <a href="#Material"><span style="color:#808080;">Material</span></a> 
                             </div>
                         </div>
                         <div class="col-md-12 col-xs-3 actions-links-icons">
                             <div class="content-links">
                                 <i  class="fas fa-pencil-alt"></i>
                                 <a href="#Material"><span style="color:#808080;">Examen </span></a> 
                             </div>
                         </div>
                    </div>
                 </p>
            </div>
        </div>
    </div>
   <br>
        </div>
    </div>
    <!-- --------------------------------------------------------------------------------------------------------------------------------- -->
    <!-- Titulo del curso -->

    <div class="col-md-11 col-sm-12 content-course" >
        <div class="row title-content-course">
        <div class="col-md-12">
            <p><strong>Curso: {{this.cursoName}} </strong></p>
        </div>
    </div>

    <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        <div class="row">
    <div class="col-md-12 content-course-two">
        <div class="row" style=" border-radius:8px;padding:10px;">
            <!-- Si ya terminaste los modulos y solamente te falta el parcial -->
            <div class="col-md-12 center" v-if="parcialfinals">
                <br>
                <p style="text-align:justify;">Estas a punto de terminar haz tu parcial para certificarte y aplicar todas las enseñanzas aprendidas en nuestros cursos...</p>
               
                <img style="margin-bottom:30px;" src="/img/cursos/parcial.jpg" alt="">
                <br>
                <p><button style="background:#FF9821!important;" @click="hacerparcial();" >Realizar Parcial <i style="float:right;top:8px;position:relative;left:10px;" class="fas fa-chevron-right"></i></button></p>
            </div>
            <!-- contenido del curso -->
            <div class="col-md-12"  v-else>
                <br>
                <section id="video">
                     <p style="border-bottom:2px solid #337ab7; color:#337ab7; "><strong>Objetivos {{this.moduloact}}</strong></p>
                    <p v-html="this.objetivo">
                   
                </p>
                </section>
            </div>
            <div class="col-md-12" 
            style="padding:0px !important;margin-top:15px;margin-bottom:50px; font-size:18px;-webkit-box-shadow:0px 0px 10px rgba(0,0,0,0.4); -moz-box-shadow:0px 0px 10px rgba(0,0,0,0.4); box-shadow:0px 0px 10px rgba(0,0,0,0.4);" 
            v-if="parcialfinals!=true"
            >
                <div v-html="this.video">
                </div>
               
                <section id="Material">
                <div class="row" style="margin-top: 15px; float:left; margin-bottom:8px;" v-for="(profe,index) in inicio.arrayprofesor" :key="index">
                    <div class="col-md-12"> 
                        <img  src="/img/cursos/placeholder.png" style="margin-right:5px; margin-left:35px;width:40px;height:40px;border-radius:50%;"  alt="">{{profe.primer_nombre+' '+profe.segundo_nombre+ ' '+profe.primer_apellido}}: 
                        <span style="font-size:14px;"><a :href="'mailto:'+profe.correo"><strong>{{profe.correo}}</strong></a></span></div>
                </div>
                </section>
                <br>
            </div>
            <div class="col-md-12" style="font-size:18px;" v-if="parcialfinals">
            </div>
            <div  class="col-md-12" style="font-size:18px;" v-else>
                <section id="">
                <p style="border-bottom:2px solid #337ab7; color:#337ab7;"><strong>Material de apoyo</strong></p>
                <p style="text-align:justify;">{{this.material_apoyo}}
                </p>
                <div class="row">
                    <div class="col-md-6">
                    <ul>
                        <li style="list-style: none;" v-for="(material,index) in inicio.arraymaterial" :key="index">
                            <a  :href="material.url+'.'+material.tipo_archivo" target="_blank" v-if="material.tipo_archivo === 'pdf'" style="cursor:pointer; margin-bottom:5px;"><span style="margin-right:5px;"><img style="width:35px; height:45px;" src="/img/Archivos/pdf.png" alt=""></span>{{material.name_file}}</a>
                            <a :href="material.url+'.'+material.tipo_archivo"  v-else-if="material.tipo_archivo === 'docx'" style="cursor:pointer;  margin-bottom:5px;"><span style="margin-right:5px;"><img  style="width:35px; height:35px;" src="/img/Archivos/word.png" alt=""></span>{{material.name_file}}</a>
                        </li>
                    </ul>
                    <br>
                    </div>
                    <div class="col-md-12" style="font-size:18px;" v-if="parcialfinals">
                        
                    </div>
                    <div class="col-md-6" style="font-size:16px; margin-top:15px;" v-else>
                        <div class="col-md-12" v-if="typeCourse==3">
                            <p><button style="color:#FF9821;background:#fff!important;border-left:4px solid #FF9821;box-shadow:0px 5px 5px rgba(0,0,0,0.4); font-size:20px; " @click="hacerparcial();">Realizar Parcial <i style="float:right;top:4px;position:relative;left:10px;" class="fas fa-chevron-right"></i></button></p>
                        </div>
                        <div class="col-md-12" v-else>
                            <p v-if="!bloqueado"><button style="color:#FF9821;background:#fff!important;border-left:4px solid #FF9821;box-shadow:0px 5px 5px rgba(0,0,0,0.4); font-size:20px; " @click="mostrardiv();">Realizar Quiz <i style="float:right;top:4px;position:relative;left:10px;" class="fas fa-chevron-right"></i></button></p>
                            <p>{{this.text}}</p>
                        </div>
                        
                        
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>
        </div>
    </div>
   
</div>
<!-- termina el curso -->
<!-- ------------------------------------------------------------------------------------------------------------ -->
<!-- empieza quiz --> 
<div class="row" style="position:relative;top:130px; width:70%;left:17%;padding:30px;box-shadow:0px 0px 20px 0.5px;
background-image:url('/img/Logo_Blanco_d_academy.png');background-size:50% cover; background-repeat: no-repeat; background-position: center, center; margin-bottom:100px;" v-else>
    <div class="col-md-12">
       <p style="float:right;">Tiempo Estimado: {{this.timerestimado}}
       <strong>- Tiempo: {{this.formattedTimer}}</strong></p> 
    </div>
    <div class="col-md-12" style="text-align:center;margin-bottom:20px;margin-top:20px;">
        <p><strong>Quiz {{this.moduloact}}</strong></p>
        <p style="text-align:justify; margin-top:30px;">{{this.introQuiz}} 
        </p>
    </div>
    <div class="col-md-12">
        <strong>Preguntas.</strong> 
    </div>
    <div class="col-md-12" style="margin-top:15px;" v-for="(exam,index_q) in inicio.arrayexamen" :key="index_q">
            <p>{{index_q+1 +')  '+ exam.title +'  ('+ exam.valor+').' }} <br>
                <span v-for="(res,indexs) in exam.listData" :key="indexs">  
                        <input type="radio" :name="'input_'+index_q" :id="res.id" :value="res.valor">{{res.respuesta}}<br>
                </span>
            </p>
    </div>
    <div class="col-md-12" style="margin-top:20px;" v-if="enviarRespuesta">
        <button style="float:right;" @click="guardarExam();">Enviar Respuesta <i style="float:right;top:8px;position:relative;left:10px;" class="fas fa-chevron-right"></i></button>
    </div>
     <div class="col-md-12" style="margin-top:20px; text-align:center; background:red; color:#fff;" v-else>
        <p>Se ha Terminado tu tiempo!!!</p>
    </div>
    <div>
    </div>
</div>
<!-- termina quiz -->
<!-- ------------------------------------------------------------------------------------------ -->
<!--modal modulos-->
<div class="modal fade" id="modalModule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modulos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-bottom:30px;">
        
         <!--contenido--> 
         <br>
                <div class="col-md-1"></div>
                 <div class="col-md-10" :style="item.style_div_principal+'margin-left:0px;'" v-for="(item, index) in inicio.arraylistado" :key="index">
                    <div class="row">
                        <div class="col-md-2 col-xs-2">
                        <div :style="item.style_num" v-if="item.view"><i style="margin-top:5px;margin-left:2px;font-size:16px;" :class="item.view"></i></div>
                        <div :style="item.style_num" v-else><i style="margin-top:5px;margin-left:1px;font-size:16px;" :class=" item.icons"></i></div>
                        </div>
                        <div class="col-md-10 col-xs-10" style="text-align:left;" @click="iniciarcurso();"  v-if="item.view">
                            <p>{{item.nombre}}   <span style="float:right; font-size:13px;">--Estas viendo--</span></p>
                        </div>
                        <div class="col-md-10 col-xs-10" style="text-align:left;" @click="repasar(item.id);" v-else>
                            <p>
                                {{item.nombre}} <span style="float:right; font-size:13px;">--Visto--</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 




</div>



</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['curso','idperson'],
    data(){
        return{
            inicio:{
                arraylistado:[],
                arrayprofesor:[],
                arraymaterial:[],
                arrayexamen:[],
            },
            introQuiz:'',
            intro:Boolean(1),
            num: 2,
            buscar:'',
            criterio:'',
            modulostotal:'',
            view:Boolean(0),
            moduloact:'',
            idmodulo:'',
            input:String.isNullOrEmpty,
            enviarRespuesta:Boolean(1),
            // timer for exam 
            formattedTimer:'00:00:00',
            currentTimer:0,
            ticker:String.isNullOrEmpty,
            timerestimado:'00:01:00',
            parcialfinals:'',
            material_apoyo:'',
            objetivo:'',
            idcurso:'',
            bloqueado:Boolean(0),
            text:'El tiempo determinado para realizar el Quiz es de 1 minuto.',
            video:'',
            typeCourse:'',
            cursoName:'',
        }
    },
    computed:{},
    methods:{
       
        guardarExam(){
            let me = this;
            let md = Boolean(1);
            me.detener(md);
            me.nota();
        },
        nota(){
            let notafinal = 0;
            let me = this;
            let listaCont = this.inicio.arrayexamen;
            let countListparcial = listaCont.length;
            var i =0; var j=0;
            for(i =0; i < countListparcial; i++){
                let countListparcialItem = listaCont[i].listData.length;
                 let input = 'input_'+ String(i);
                 let inputs = document.getElementsByName(input);
                for(j=0; j<countListparcialItem; j++){
                    if(inputs[j].checked)
                    {
                        notafinal = notafinal + parseFloat(inputs[j].value);
                    }
                }
            }
                if(notafinal<3){
                    me.MensajeAlert('D - Academy Información','Perdiste el Examen en: '+notafinal+', estudia mas, para volver hacerlo dentro de 12 horas','warning',false,'Ok', '','error');
                    me.text ='El Examen puede hacerce dentro de 12 horas';
                    localStorage.removeItem('timers'+me.idperson+'_'+me.idcurso);
                    let hoy = new Date();
                    let mañana = new Date(hoy.getTime() + 1000 * 60 * 60 * 12);
                    localStorage.setItem('curso_'+me.idperson, me.idcurso);
                    localStorage.setItem('Bloqueado',Boolean(1)); 
                    localStorage.setItem('fecha', mañana); 
                    me.bloqueado=Boolean(1);
                    return this.view = Boolean(0);
                }else if(notafinal>=3){
                    me.enviarnota(notafinal);
                }
            
        },
        enviarnota(notafinal)
        {
            let me = this;
            axios.post('/notas/registrar',{
                    'nota': notafinal,
                    'idmodulo': me.idmodulo,
                    'estudiante': me.idperson,
                    'curso':me.idcurso,
                    'vparcial':false
                }).then(function (response) {
                    var respuesta = response.data;
                     if(me.MensajeAlert('D - Academy Información',respuesta.guardado,'warning',false,'Ok', '','success')){
                         this.iniciarcurso();
                     }
                    
                }).catch(function (error) {
                    console.log(error);
                });
        },
        MensajeAlert(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
        {
            let me = this;
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                }).then(function(response){
                    if(iconsMessage=="success"){
                        return this.view = Boolean(0);
                         me.iniciarcurso();
                    }
                }).catch(function(error){
                    console.log(error);
                });
        },
       iniciarconteo(){
           let valor = 0;
           let me = this;
           let newmin =0;
           if(localStorage.getItem('timers'+me.idperson+'_'+me.idcurso))
           {
                let min = localStorage.getItem('timers'+me.idperson+'_'+me.idcurso).substring(5,3);
                let seg = localStorage.getItem('timers'+me.idperson+'_'+me.idcurso).substring(8,6);
                let pmin = min.substring(0, 1);
                if(pmin===0)
                {
                    newmin = min.substring(2, 1);
                   
                }else{
                    newmin = min * 60;
                }
                let mintotal = newmin * 60;
                seg =  (mintotal + (+ parseInt(seg)));
                valor = seg;
           }
           me.tick(valor);
       },
       tick(valor){
            let me = this;
            me.ticker = setInterval(()=>{if(valor>0){me.currentTimer = valor; valor = 0; }  me.currentTimer++; me.formattedTimer = me.formatTime(me.currentTimer);}, 1000)
       },
       formatTime(seconds){
           let me = this;
           let datenew = new Date(null);
           datenew.setSeconds(seconds);
           let responsedate = datenew.toISOString().substring(19, 11);
           if(responsedate === me.timerestimado)
           {
               let md = Boolean(0);
            return responsedate = me.detener(md);
           }else{
               localStorage.setItem('timers'+me.idperson+'_'+me.idcurso,responsedate);
               return responsedate;
           }
       },
       detener(md){
           let me = this;
           window.clearInterval(this.ticker);
           me.currentTimer = 0;
           me.enviarRespuesta = md;
           if(!md){
               me.nota();
               return '00:00:00';
           }
       },
        mostrardiv(){
            this.input = "checkbox";
             let me=this;
                var url = '/quizmodulo?modulo='+me.idmodulo+'&curso='+me.idcurso;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.inicio.arrayexamen = respuesta.arrayquiz;
                     me.timerestimado = respuesta.timer;
                     me.introQuiz = respuesta.intro_examen;
                     me.iniciarconteo();
                })
                .catch(function (error) {
                    console.log(error);
                });
                return this.view = Boolean(1);
        },
        iniciarcurso(){
             let me=this;
                var url = '/listarmodulo?idcurso='+me.curso+'&student='+me.idperson;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    // console.log(respuesta);
                      me.modulostotal = respuesta.cantidad_Modulo;
                      me.inicio.arraylistado = respuesta.modulos;
                      me.parcialfinals = respuesta.parcial;
                      me.inicio.arraymaterial = respuesta.contenido;
                      me.inicio.arrayprofesor = respuesta.profesor;
                      me.moduloact = respuesta.prueba[0].titulo;
                      me.idmodulo = respuesta.prueba[0].idmodulo;
                      me.material_apoyo = respuesta.prueba[0].descrip_material_apoyo;
                      me.objetivo = respuesta.prueba[0].objetivo;
                      me.video = respuesta.prueba[0].video;
                      me.typeCourse = respuesta.typeCourse;
                    let curso = localStorage.getItem('curso_' + me.idperson);
                    me.idcurso = respuesta.prueba[0].idcurso;
                     me.cursoName = respuesta.cursoName;
                    
                   if(localStorage.getItem('Bloqueado')===String(Boolean(1))  && curso  === String(me.idcurso))
                      {
                           let hoy = new Date();
                           let fecha = new Date(localStorage.getItem('fecha'));
                           let verificar = fecha.getTime()- hoy.getTime();
                           let horastranscurrida = verificar / 1000 / 60 / 60;
                           let faltan = Math.round(horastranscurrida);
                           let msjfaltan = '';
                           if(faltan>0)
                           { 
                               if(faltan ===1){msjfaltan = "Ya te falta poco: "+faltan +" hora,";}else{msjfaltan = "Te faltan: "+faltan +" horas.";}
                           }
                          if(horastranscurrida <=0)
                          {
                              me.bloqueado = Boolean(0);
                              localStorage.removeItem('curso_'+me.idperson);
                              localStorage.removeItem('Bloqueado'); 
                              localStorage.removeItem('fecha'); 
                          }
                          else
                          {
                              me.bloqueado = Boolean(1);
                              me.text = 'El Examen puede hacerce dentro de 12 horas, espere el tiempo asignado por favor!!! \n'+ msjfaltan;
                          }
                      }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        repasar(id){
            let me = this;
             window.location.href = "/Repasar/?c="+ me.curso+"&m="+id; 
        },
        hacerparcial(){
            let me = this;
            window.location.href = "/parcial/"+ me.curso; 
        }
    },
    mounted(){
        this.iniciarcurso();
    }
}
</script>