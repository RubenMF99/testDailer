<template>
<div class="modal fade bd-example-modal-lg" z-index="100" :id="'myModal_'+idCurso" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header theme-dark">
            <div class="col-md-3">
                <img src="/img/Logo_Blanco_d_academy.png" alt="">
            </div>
            <div class="col-md-2">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          
          
        </div>
        <div class="modal-body center" style="padding:10px;">
            <div class="col-md-12">
                <h2 class="modal-title">¡Ayudanos a editar 
                     <span v-if="this.typeCursos == 1">el Diplomado</span>
                     <span v-if="this.typeCursos == 2">el curso</span>
                     <span v-if="this.typeCursos == 3">la Master Class</span>
                     <span v-if="this.typeCursos == 4">la Certiticación</span>
                     !<br><strong>{{this.name}}</strong></h2>
                <br>
            </div>
            <div class="col-md-12 text-justificado">
                <p style="line-height: 20px;">Llena todos los campos para aprobarte el curso y los estudiantes de D-Academy, puedan verte. </p>
            </div>
            <div class="col-md-12 center">
                <div class="col-md-12">
                    <br>
                    <p class="text-derecha"><strong>1) Información del curso</strong></p>
                    <hr>
                </div>
                
                    <div class="col-md-6 espacio-div" >
                        <input v type="text" class="form-control" @input="Slug" v-model="dataCourse['nombre_curso']" placeholder="Titulo ">
                    </div>
                    <div class="col-md-6 espacio-div">
                        
                        <input type="text" class="form-control" v-model="dataCourse['subtitulo_curso']" placeholder="Subtitulo ">
                    </div>
               
                
               
                 <div class="col-md-8 espacio-div">
                   
                    <textarea class="form-control" v-model="dataCourse['descripcion']" placeholder="Descripcion" cols="30" rows="10"></textarea>
                </div>
                 <div class="col-md-4 espacio-div">
                     <div v-if="!editImg">
                         <img style="width:226px; height:130px;" v-if="dataCourse['imagen_destacada']" :src="'/img/cursos/'+dataCourse['imagen_destacada']" alt="">
                         <img style="width:226px; height:130px;" v-else src="/img/cursos/placeholder.png" alt="">
                     </div>
                     <div v-else>
                         <img style="width:226px; height:130px;" v-if="imagen" :src="imagen" alt="">
                         <img style="width:226px; height:130px;" v-else src="/img/cursos/placeholder.png" alt="">
                     </div>
                    <button @click="cambiarImg" style="margin-top:12px;">Cambiar Imagen</button>
                </div>
                <div class="col-md-12">
                    <br>
                    <p class="text-derecha"><strong>2) Información de la introduciión a la clase</strong></p>
                    <hr>
                </div>
                 <div class="col-md-12 espacio-div">
                    <textarea class="form-control" v-model="dataCourse['contenido']" placeholder="Introducción a la clase" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 espacio-div" v-if="!editVideo">
                    <div class="col-md-12 center" v-if="dataCourse['urlvideo']">
                        <p >Video subido<br>¿deseas cambiarlo?</p>
                    </div>
                    <div class="col-md-12 center" v-else>
                        <p >Actualmente no tienes video introductorio <br> ¿deseas cambiarlo?</p>
                    </div>
                    <div class="col-md-6" v-if="dataCourse['urlvideo']" v-html="dataCourse['urlvideo']">                       
                    </div>
                    <div class="col-md-6" v-if="dataCourse['urlvideo']" >  
                        <br>
                        <textarea class="form-control" placeholder="descripcion del video." v-model="dataCourse['descripcion_video']" id="" cols="30" rows="10"></textarea>                     
                    </div>
                    <div class="col-md-12 center" style="margin-top:10px;">
                        <button @click="subirVideo" v-if="dataCourse['urlvideo']">Cambiar video</button>
                        <button @click="subirVideo" v-else>Subir video</button>
                    </div>
                </div>
               <div class="col-md-12 espacio-div" v-else>
                    <div class="col-md-12 center" v-if="urlvideo">
                        <p >Video subido <br>¿deseas subirlo?</p>
                    </div>
                    <div class="col-md-12 center" v-else>
                        <p>Actualmente no tienes video introductorio <br> ¿deseas subirlo?</p>
                    </div>
                    <div class="col-md-6" v-if="urlvideo" v-html="urlvideo">                       
                    </div>
                    <div class="col-md-6" v-if="desrViewVideo">
                        <br>
                        <textarea class="form-control" placeholder="descripcion del video." v-model="dataCourse['descripcion_video']" id="" cols="30" rows="10"></textarea>
                    </div>
                     <div class="col-md-12 center">
                        <br>
                        <button @click="subirVideo(meVue)" v-if="urlvideo">Cambiar video</button>
                        <button @click="subirVideo(meVue)" v-else>Subir video</button>
                        <br>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="text-derecha">
                     <strong>
                         3) Configuremos 
                     <span v-if="this.typeCursos == 1">el Diplomado</span>
                     <span v-if="this.typeCursos == 2">el curso</span>
                     <span v-if="this.typeCursos == 3">la Master Class</span>
                     <span v-if="this.typeCursos == 4">la Certiticación</span>
                     </strong></p>
                    <hr>
                    <div class="col-md-4">
                        <p style="margin-bottom:-1px;margin-top:-10px;">Duración: 1,2,3.</p>
                        <input type="number" v-model="dataCourse['duracion_numero']" class="form-control" placeholder="Duración">
                    </div>
                    <div class="col-md-4">
                        <p style="margin-bottom:-1px;margin-top:-10px;">tipo de duracion: Horas,  etc.</p>
                        <select class="form-control" v-model="dataCourse['id_tipo_duracion']">
                            <option value="0">Escoge tipo de duración</option>
                            <option :value="iten.id" v-for="(iten, index) in comboDuracion" :key="index">{{iten.nombre}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <p style="margin-bottom:-1px;margin-top:-10px;">Inicio {{this.tituloCurso}}</p>
                        <input class="form-control" type="date" v-model="dataCourse['fecha_inicial']">
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <select class="form-control" v-model="dataCourse['id_categoria']">
                            <option value="0">Escoge categoria o industria</option>
                            <option :value="iten.id" v-for="(iten, index) in typeDuracion" :key="index">{{iten.nombre}}</option>
                        </select>
                </div>
                <div class="col-md-12 center">
                    <br>
                    <button v-if="Preloaders"  class="guardar">Guardando...</button>
                    <button v-else @click="guardar" class="guardar">Guardar</button>
                    <br>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="margin-top:20px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['idCurso','name','typeCursos','dataCourse','comboDuracion','typeDuracion'],
    data: function() {
        return{
            meVue: this,
            editImg:Boolean(0),
            editVideo:Boolean(0),
            checked:'SI',
            tituloCurso:null,
            typeduracion:0,
            typeIndustria:0,
            swVideo:Boolean(0),
            urlvideo:null,
            imagen:null,
            nameImage:null,
            showUrlVideo:Boolean(0),
            valInputSelectVideo:'',
            Preloaders:Boolean(0),
            desrViewVideo:Boolean(0),
        }
    },
    
    methods:{
        
        showVideo: function(yesOrnot){
            let _this = this;
            _this.swVideo = Boolean(yesOrnot);
            yesOrnot == 0 ? _this.descripVideo="": null;
            yesOrnot == 0 ? _this.showUrlVideo=Boolean(0): _this.showUrlVideo = Boolean(0);
        },
        ShowVideos: function(val){
            let _this = this;
            val == 0 ? _this.showUrlVideo=Boolean(0): _this.showUrlVideo = Boolean(1);
           val == 1 ? _this.placeHtml = '<iframe width="560" height="315" src="https://www.youtube.com/embed/b81kOviE7EI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>':
           _this.placeHtml = "https://video.com/EfeeI10%20&u=1";
        },
        preview: function(){
             let _this = this;
             const Preview = Swal.mixin({
                 customClass:'width-video-preview'
             })
            Preview.fire({
                title: '¡Video que haz subido!',
                text: 'Preview del video',
                html: _this.urlvideo,
                
            })
        },
        
         cambiarImg:  async function (){
           let _this = this;
             _this.editImg = Boolean(1);
                const { value: file } = await Swal.fire({
                title: 'Select image',
                input: 'file',
                inputAttributes: {
                    'accept': ['image/png','image/jpg','image/jpeg'],
                    'aria-label': 'Upload your profile picture'
                },
                 customClass: 'picture-image-change'
                })
                
                if (file) {
                    console.log(file);
                    if ((/\/(jpg|png|jpeg)$/i).test(file.type)) {
                    const reader = new FileReader()
                    reader.onload = (e) => {
                        Swal.fire({
                        title: file.name,
                        imageUrl: e.target.result,
                        imageAlt: file.name,
                        }).then(function(data){
                            _this.imagen = e.target.result;
                            _this.nameImage = file.name;
                        })
                    }
                    reader.readAsDataURL(file)
                    }else{
                         Swal.fire({
                        title: 'Error al cargar la imagen',
                        icon:'error',
                        text:'Solo se permite cargar la imagen con extension: PNG, JPG ,JPEG.'
                        })
                    }
                }
        },
        subirVideo:function(){
            let _this = this;
           const alerts=Swal.mixin({
            
            confirmButtonText: 'Siguiente &rarr;',
            cancelButtonText:'Salir',
            showCancelButton: true,
            progressSteps: ['1'],
            customClass:{
                    text: 'text-modif'
                }
            })
            const {value: data} =alerts.queue([
            {
                input: 'radio',
                inputOptions:{
                    'youtube': 'Tengo video de youtube',
                    'independiente': 'Tengo video independiente',
                },
                title: '¡Ayudanos a subir el video!',
                text: '¿Que tipo de video tienes?',
                
                inputValidator: (value)=>{
                    if(!value){
                        return 'Escoge el video a montar'
                    }
                },
               
            },
            {
                title: '¡Ayudanos a subir el video!',
                html: '<p style="text-align:justify;"><strong>Si escogiste video de youtube utiliza</strong> <br> <span style="font-size:14px;">(< iframe width="500" height="315" src="https://www.youtube.com/...)</span> <span style="color:#FF9700" ><a href="/subir-video-youtube"  target="_blank">¡Como hago!</a></span></p><p style="text-align:justify;"><strong>Si escogiste video independiente</strong><span style="font-size:14px;"> (htttp://video/v=OkppL2-LslperwqcC&v=1)</span></p>',
                // (<iframe width="500" height="315" src="https://www.youtube.com/...). 
                input:'text',
                 inputValidator: (value)=>{
                    if(!value){
                        return 'ingresa la url o el iframe'
                    }
                },
                
                
            }
            ]).then((result) => {
            if (result.value) {
                const answers = JSON.stringify(result.value);
                
                Swal.fire({
                title: 'Correcto haz montado este video!',
                html: `
                   <div>${result.value[1]}</div>
                `,
                confirmButtonText: 'Listo!',
                customClass:'width-video-preview'
                }).then(function(){
                    _this.urlvideo = result.value[1];
                    _this.editVideo = Boolean(1);
                    _this.desrViewVideo = Boolean(1);
                });
            }
            });
        },
        
        Slug: function(){
            let _this = this;
            let campoSlug = _this.dataCourse['nombre_curso'].trim().toLowerCase();
            _this.dataCourse['url_curso'] = campoSlug.split(' ').join('-');
        },
        guardar: function(){
            let _this = this;
            _this.Preloaders = Boolean(1);
            let dataimagen = {'imagens': _this.imagen, 'nombreImagens': _this.nameImage};
            let url = '/update/curso';
            let videoHtml = '';
            (_this.urlvideo==='')? videoHtml = dataCourse['urlvideo']:videoHtml = _this.urlvideo;
            
            axios.post(url,{
                'titulo': _this.dataCourse['nombre_curso'],
                'subtitulo':_this.dataCourse['subtitulo_curso'],
                'idcurso': _this.dataCourse['id'],
                'descripcion': _this.dataCourse['descripcion'],
                'duracion': _this.dataCourse['duracion_numero'],
                'tipoDuracion': _this.dataCourse['id_tipo_duracion'],
                'fecha':_this.dataCourse['fecha_inicial'],
                'categoria':_this.dataCourse['id_categoria'],
                'imagenact':_this.dataCourse['imagen_destacada'],
                'imagen': dataimagen,
                'slug_curso':_this.dataCourse['url_curso'],
                'intro': _this.dataCourse['contenido'],
                'urlvideo':videoHtml,
                'descripcion_video':_this.dataCourse['descripcion_video'],
            }).then(function(result){
                // console.log(result);
                _this.Preloaders = Boolean(0);
                 Swal.fire({
                position: 'center',
                icon: 'success',
                title: ''+result.data,
                showConfirmButton: false,
                timer: 5000
                })
            }).catch(function(error){
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Lo sentimos hay un error:'+error,
                showConfirmButton: false,
                timer: 5000
                })
            });
            
        
        },
        //    const Toast = Swal.mixin({
        //     toast: true,
        //     position: 'center',
        //     showConfirmButton: false,
        //     timer: 3000,
        //     timerProgressBar: true,
        //     onOpen: (toast) => {
        //         toast.addEventListener('mouseenter', Swal.stopTimer)
        //         toast.addEventListener('mouseleave', Swal.resumeTimer)
        //     }
        //     })

        //     Toast.fire({
        //     icon: 'success',
        //     title: 'Se ha guardado exitosamente.'
        //     })
    },
    mounted: function(){
        
    }
}
</script>