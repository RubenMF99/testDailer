<template>
    <div class="row">
        <div class="col-md-12 center">
            <h2>¡Vamos a crear el certificación!</h2>
            <p>Los campos señalados con (*), son obligatorios.</p>
        </div>
        <div class="col-md-12">
            <input type="text" v-model="titulo" @input="Slug" :class="'form-control '+classError" placeholder="TITULO DEL CERTIFICACION (*)"><br>
        </div>
            <div class="col-md-12">
                <input type="text" v-model="subtitulo" class="form-control" placeholder="Subtitulo del certificación"> 
                <br>
            </div>
             <!-- <div class="col-md-12">
                <br><textarea  class="form-control" cols="30" rows="10" v-model="descripcion" placeholder="Descripción del certificado"></textarea><br>
            </div> -->
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
              <textarea class="form-control" cols="30" rows="12" v-model="descripcion" placeholder="Descripción del certificado"></textarea>
            </div>
            <div class="col-md-12">
                <div class="col-md-12 center">
                    <p><strong>¿Tienes video introductorio?</strong></p>
                </div>
                <div class="col-md-4">
                   
                </div>
                <div class="col-md-2 center">
                    <input type="radio" name="radioV" @change="AgregarVI" v-model="r1"> Si <br>
                </div>
                <div class="col-md-2 center">
                    <input type="radio" name="radioV" @change="BorrarVI" checked v-model="r2"> No <br>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
            <div class="col-md-12" v-if="viewVI">
             
               <div class="row" style="margin-top:20px;margin-bottom:5px;">
                   <div class="col-md-12">
                       <p>Escoge el video a montar para mostrarte el preview del video</p>
                   </div>
                   <div class="col-md-4">
                       <input type="radio" name="videos" @change="video(1)" id="V1"  class="form-control"><label for="V1">Tengo video de youtube</label> <br>
                       <input type="radio" name="videos" @change="video(2)" id="V2" class="form-control"><label for="V2">Tengo video de mi sitio web</label> <br>
                       <input type="radio" name="videos" @change="video(3)" id="V3" class="form-control"><label for="V3">Tengo video de independiente</label> <br>
                       
                   </div>
                   <div class="col-md-4">
                       <div class="col-md-12" v-html="preview"></div>
                       <input class="form-control" @input="previewV" type="text" v-model="urlVideo" :placeholder="link">
                   </div>
                   <div class="col-md-4">
                       <textarea class="form-control" placeholder="Descripción breve del video" v-model="descripcion_video" cols="30" rows="10"></textarea>
                   </div>
               </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                   <br> <input type="number" v-model="duracion" class="form-control" placeholder="Duracion del certificado">
                </div>
                <div class="col-md-4">
                    <!-- tipo de duracion  -->
                    <br> <select class="form-control" v-model="Typeduracion" id="">
                            <option value="0">Escoge tipo de duracion.</option>
                            <option :value="item.id" v-for="(item, index) in comboduracion" :key="index" v-text="item.nombre"></option>
                    </select>
                    
                </div>
                <div class="col-md-4">
                    <!-- inicio de clases -->
                    <p style="margin-bottom:-0.5px;">Inicio del certificado</p>
                  <input type="date" name="" class="form-control" :min="fechaLimite" v-model="fecha" id="">
                </div>
            </div>
            <div class="col-md-12">
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
    props:['persona','tipoCurso'],
    data:function(){
        return{
            viewVI:Boolean(0),
            cargar_img:'',
            titulo:'',
            subtitulo:'',
            intro:'',
            duracion:'',
            Typeduracion:0,
            industria:0,
            imagen:'',
            nombreImagen:'',
            combocategoria:[],
            comboduracion:[],
            fechaLimite:'',
            fecha:'',
            slug:'',
            descripcion:'',
            urlVideo:'',
            descripcion_video:'',
            r1:'',
            r2:'',
            typeImage:'',
            link:'Escoge el video que tienes primero',
            preview:'',
            lCount:'',
            classError:'',
        }
    },
    methods:{
        video: function(value){
            switch (value) {
                case 1:
                    this.link = '<iframe width="560" height="315" src="https://www.youtube.com/embed/b81kOviE7EI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    this.lCount = value;
                    this.urlVideo = "";
                     this.preview = "";
                    break;
                case 2:
                    this.link = 'http://v2v.cc/~j/theora_testsuite/ComunicacionHD.mp4';
                    this.lCount = value;
                    this.urlVideo = "";
                     this.preview = "";
                    break;
                case 3:
                    this.link = 'https://develope/video/intro.mp4';
                    this.lCount = value;
                    this.urlVideo = "";
                     this.preview = "";
                    break;
                default:
                    break;
            }
            
        },
        previewV: function(){
            if(this.lCount===1){
                let linkv = this.urlVideo;
                linkv = linkv.split('width="560"').join('width="100%"');
                linkv = linkv.split('height="315"').join('height="150"');
                this.preview = linkv;
            }else{
             this.preview = '<video width="100%" height="150" src='+this.urlVideo+' controls>Tu navegador no implementa el elemento <code>video</code>.</video>';
            }
        },
        AgregarVI: function(){
            let _this = this;
            _this.viewVI = Boolean(1);
        },
        BorrarVI: function(){
            let _this = this;
            _this.viewVI = Boolean(0);
            _this.urlVideo = "";
            _this.descripcion_video = "";
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
         limpiar: function(inputname){
            let me = this;
            me.cargar_img = 0;
            $('#'+inputname+'').val('');
            let img  = document.getElementById("PreviewImg");
            img.src= "";
            me.typeImage = "";
            me.imagen="";
        },
        guardar: function(){
             let _this = this;
             if(_this.validar()){
                let url = "/cursos/registrar";
                let images = {'imagen':_this.imagen,'name':_this.nombreImagen};
                axios.post(url,{
                    'nombrecurso':_this.titulo,
                    'slug':_this.slug,
                    'descripcion':_this.descripcion,
                    'subtitulo' :_this.subtitulo,
                    'tipocurso':_this.tipoCurso,
                    'duracion':_this.duracion,
                    'categoria':_this.industria,
                    'tipoduracion':_this.Typeduracion,
                    'fecha':_this.fecha,
                    'instructor':_this.persona,
                    'imagen':images,
                    'intro':_this.descripcion,
                    'introG':true,
                    'urlvideo':_this.urlVideo,
                    'descripcion_video':_this.descripcion_video,
                }).then(function(data){
                    let TextMessage ="Se ha guardado correctamente como borrador, hasta que se aprueben los datos para activar el curso";
                    localStorage.setItem('CCertif', data.data.id);
                    _this.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','success');
                    _this.img.src= "";
                    _this.typeImage = "";
                    _this.imagen="";
                }).catch(function(data){
                    console.log();
                });
             }
        },
        
         abrir_img: function(inputname){
            let me = this;
            $('#'+inputname+'').click();
        },
        uploadImage: function(val){
            let me = this;
            me.cargar_img = 1;
           let file =  $('#cargar');
           let file_data =  file.prop("files")[0];
           me.nombreImagen = file_data.name;
           me.cargar_img = 3;
           if (!(/\/(jpg|png|jpeg)$/i).test(file_data.type)) {
                alert('El archivo a adjuntar no es una imagen');
            }else{
                if(file_data>2097152)
                {
                    alert('El archivo esta muy pesado solo se aceptan 2 megabytes');
                }else{
                     // typeImage = file_data.
                        me.typeImage = file_data.type;
                        var render = new FileReader();
                        render.readAsDataURL(file_data);
                        render.onload= function(){
                            var result=render.result;
                            me.imagen = result;
                        };
                }
            }
        },
        listartipocurso: function(){
            let _this = this;
            let url = "/listarcombos?combo="+0;
            axios.get(url).then(function (response) {
                let data = response.data;
                _this.combocategoria = data.tipocategoria;
                _this.comboduracion = data.tipoduracion;
            }).catch();
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
         MensajeAlert: function(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
        {
            let me = this;
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
    computed:{},
    mounted(){
        this.listartipocurso();
        this.NowDate();
        
    },
    
}
</script>