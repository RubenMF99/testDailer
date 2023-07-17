<template>
     <div class="row">
        <div class="col-md-12 center">
            <h2>¡Vamos a crear la master class!</h2>
            <p>Los campos señalados con (*), son obligatorios.</p>
        </div>
        <div class="col-md-12">
            <input type="text" v-model="titulo" @input="Slug" :class="'form-control '+classError" placeholder="TITULO DEL MARTER CLASS  (*)"><br>
        </div>
            <div class="col-md-12">
                <input type="text" v-model="subtitulo" class="form-control" placeholder="Subtitulo de la Master Class"><br> 
            </div>
             
            <div class="col-md-5">
         
                <div   style="width:350px; height:250px;border-radius:8px;border:1px solid #808080;text-align:center; ">
                        <img style="width:60px; height:60px;position:relative; top:120px; " src="/img/cargando/carga.gif" alt="" v-if="cargar_img==1">
                            <p @click="abrir_img('cargar');" style="position:relative; top:45%; cursor:pointer;" v-if="cargar_img==0"><i style="font-size:20px;margin-right:10px;" class="fas fa-cloud-upload-alt"></i> Subir Foto</p> 
                        <img id="PreviewImg" style="width:100%; height:100%;border-radius:8px; " :src="imagen" alt="" v-if="cargar_img==3">
                </div>
                <div @click="limpiar('cargar');" style="color:red; position:relative;top:-240px;left:81%;font-size:35px;float:right;z-index:0;cursor:pointer;" v-if="cargar_img==3">
                        <i class="far fa-times-circle"></i>
                </div>
                <div @click="abrir_img('cargar');" style="position:relative;top:-150px;font-size:50px;left:35%;float:left;z-index:10;cursor:pointer;" v-if="cargar_img==3">
                        <i class="fas fa-camera"></i>
                </div>
               <br><input type="file"  style="display:none;" @change="uploadImage();" name="cargar" id="cargar">
            </div>
            <div class="col-md-7">
              <textarea class="form-control" cols="30" rows="12" v-model="intro" placeholder="Introduccion a la clase"></textarea>
            </div>
            <!-- Video a subir para la master class-->
                                    <div class="col-md-4 espacio-input ">
                                        <p><strong>¿Que video tienes para subir?</strong></p>
                                        <input type="radio" id="r1" name="video" @change="Visualizar(1)" v-model="r1"><label style="cursor:pointer;" for="r1">Tengo video de YouTube</label><br>
                                        <input type="radio" id="r2" name="video" @change="Visualizar(2)" v-model="r2"><label style="cursor:pointer;" for="r2">Tengo video externo</label><br>
                                        <input type="radio" id="r3" name="video" checked="true" @change="Visualizar(3)" v-model="r3"><label style="cursor:pointer;" for="r3">No tengo video</label>
                                        <input type="text" @input="loadVideo" class="form-control" :placeholder="placeholders" id="" v-model="urlvideo" v-if="viewinput">
                                    </div>
                                    <div class="col-md-8 espacio-input center">
                                        <div><p><strong>Preview del Video</strong></p></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8" v-html="preview">

                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="col-md-12">
                                      <br>  <textarea class="form-control" v-model="descripcion" cols="30" rows="10" placeholder="Descripcion del video"></textarea>
                                    </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <!-- inicio de clases -->
                    <p style="margin-bottom:-0.5px;">Inicio del curso</p>
                  <input type="date" name="" class="form-control" :min="fechaLimite" v-model="fecha" id="">
                </div>
            </div>
            <div class="col-md-6">
                <!-- categoria o industria -->
              <br>  <select class="form-control" v-model="industria" id="">
                            <option value="0">Escoge categoria o industria.</option>
                            <option :value="item.id" v-for="(item, index) in combocategoria" :key="index" v-text="item.nombre"></option>
                </select>
            </div>
            <div class="col-md-12 center">
              <br>  <button @click="guardar" class="guardar">Guardar</button>
            </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['tipoCurso','persona'],
    data: function(){
        return{
            preview:'<br> No hay video',
            viewinput:false,
            placeholders:'',
            titulo:'',
            subtitulo:'',
            intro:'',
            fechaLimite:'',
            fecha:'',
            industria:0,
            slug:'',
            typeImage:'',
            imagen:'',
            cargar_img:'',
            nombreImagen:'',
             loadIdvideo:'',
            combocategoria:[],
            classError:'',
            error:{
                errorTitulo:'',
            },
            r1:'',r2:'',r3:'',
            urlvideo:'',
            descripcion: '',
        }
    },
    methods:{
          Slug: function(){
            let _this = this;
            let campoSlug = _this.titulo.trim().toLowerCase();
            let textSlug = _this.remplazartildes(campoSlug);
            campoSlug = textSlug.split(' ').join('-');
            _this.slug = campoSlug;
        },
        remplazartildes: function(slug){
            // mayusculas
            slug.split('Ó').join('O');
            slug.split('Á').join('A');
            slug.split('É').join('E');
            slug.split('Í').join('I');
            slug.split('Ú').join('U');
            // minusculas
            slug.split('ó').join('o');
            slug.split('á').join('a');
            slug.split('é').join('e');
            slug.split('í').join('i');
            slug.split('ú').join('u');
            return slug;
        },
        validar: function(){
            let _this = this;
            if(_this.titulo===""){
                _this.classError = "is-invalid";
                _this.error.errorTitulo="Ingrese el titulo del curso, porfavor";
                return Boolean(0);
            }
            return Boolean(1);
        },
        abrir_img: function(inputname){
            let me = this;
            $('#'+inputname+'').click();
        },
        limpiar: function(inputname){
            let _this = this;
            _this.cargar_img = 0;
            $('#'+inputname+'').val('');
            let img  = document.getElementById("PreviewImg");
            img.src= "";
            _this.typeImage = "";
            _this.imagen="";
        },
         guardar: function(){
             let _this = this;
             if(_this.validar()){
                let url = "/cursos/registrar";
                let images = {'imagen':_this.imagen,'name':_this.nombreImagen};
                axios.post(url,{
                    'nombrecurso':_this.titulo,
                    'slug':_this.slug,
                    'descripcion':_this.intro,
                    'subtitulo' :_this.subtitulo,
                    'tipocurso':_this.tipoCurso,
                    'duracion':4,
                    'categoria':_this.industria,
                    'tipoduracion':2,
                    'fecha':_this.fecha,
                    'instructor':_this.persona,
                    'imagen':images,
                    'intro':_this.intro,
                    'introG':true,
                    'urlvideo':_this.urlvideo,
                    'descripcion_video':_this.descripcion,
                }).then(function(data){
                    let TextMessage ="Se ha guardado correctamente como borrador, hasta que se aprueben los datos para activar el curso";
                    localStorage.setItem('CMC', data.data.id);
                    _this.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','success');
                    _this.img.src= "";
                    _this.typeImage = "";
                    _this.imagen="";
                }).catch(function(data){
                    console.log();
                });
             }
        },
         uploadImage: function(val){
            let _this = this;
            _this.cargar_img = 1;
           let file =  $('#cargar');
           let file_data =  file.prop("files")[0];
           _this.nombreImagen = file_data.name;
           _this.cargar_img = 3;
           if (!(/\/(jpg|png|jpeg)$/i).test(file_data.type)) {
                let TextMessage = "El archivo a adjuntar no es una imagen";
                    _this.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','error');
            }else{
                if(file_data>2097152)
                {
                    let TextMessage = "El archivo esta muy pesado solo se aceptan 2 megabytes";
                    _this.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','error');
                }else{
                     // typeImage = file_data.
                        _this.typeImage = file_data.type;
                        var render = new FileReader();
                        render.readAsDataURL(file_data);
                        render.onload= function(){
                            var result=render.result;
                            _this.imagen = result;
                        };
                }
            }
        },
        NowDate: function(){
            let _this = this;
            let fecha = new Date();
            let mes = '';
            let dia = '';
            mes= fecha.getMonth()+1;
            dia = fecha.getDate()-1;
            if(fecha.getMonth()<=9){mes="0"+ (fecha.getMonth()+1);}
            if(fecha.getDate()<=9){dia = "0"+fecha.getDate();}
            _this.fechaLimite = fecha.getFullYear()+"-"+mes+"-"+dia;
        },
        listartipocurso: function(){
            let _this = this;
            let url = "/listarcombos?combo="+3;
            axios.get(url).then(function (response) {
                let data = response.data;
                _this.combocategoria = data.tipocategoria;
            }).catch();
        },
        Visualizar: function(value){
            let _this = this;
            _this.loadIdvideo = value;
            switch (value) {
                case 1:
                    _this.placeholders = '<iframe width="560" height="315" src="https://www.youtube.com/embed/1X_yQ8m0Q2o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=true;
                    _this.HtmlVideo = "";
                    _this.loadIdvideo = 1;
                    break;
                case 2:
                    _this.placeholders = 'http://D-academy/cursos/video.mp4';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=true;
                    _this.HtmlVideo = "";
                    _this.loadIdvideo = 2;
                    break;
                case 3:
                    _this.placeholders = 'No tengo video';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=false;
                    _this.HtmlVideo = "";

                    break;
                default:
                    break;
            }
        },
        loadVideo: function(){
            let _this = this;
            if(_this.loadIdvideo===1){
                let pVideo = _this.urlvideo;
                let sVideo = _this.urlvideo;
                pVideo = pVideo.split('width="560"').join('width="100%"');
                pVideo = pVideo.split('height="315"').join('height="150"');
                _this.preview = pVideo;
                sVideo = sVideo.split('width="560"').join('width="100%"');
                sVideo = sVideo.split('height="315"').join('height="450"');
                _this.HtmlVideo = sVideo;
            }else{
                _this.preview = '<video src="'+_this.urlvideo+'" width="100%" height="150" alt="" controls></video>';
                _this.HtmlVideo = '<video src="'+_this.urlvideo+'" width="100%" height="150" alt="" controls autoplay></video>';;
            }
        },
         MensajeAlert: function(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
        {
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                }).then((result) => {

                });
        }
    },
    mounted: function(){
        this.listartipocurso();
        this.NowDate();
    }
}
</script>