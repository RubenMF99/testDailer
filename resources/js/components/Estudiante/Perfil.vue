<template>
    <div class="row" style="padding:50px;">
        <div style="background-image:url('/img/cursos/portada.png'); background-size:100%;background-position:top center; width:100%; height:300px;background-repeat: no-repeat;">
    
        </div>
        <div class="col-md-12" style="float:left; position:relative; top:-110px;left:45px; ">
                    <div  style="background:#fff; width:210px; height:210px;border-radius:50%;border:1px solid #808080;text-align:center;">
                        <img  style="width:100%; height:100%;border-radius:50%; border:4px solid #fff;" :src="imagen2" alt="Foto de perfil" v-if="imagen2 !='/'">
                        <img  style="width:100%; height:100%;border-radius:50%; border:4px solid #fff;" src="/img/logo_d_academy.png" alt="Foto de perfil" v-else>
                    </div>
        </div>
      
                    <div class="col-md-12" style="position:relative; top:-190px; left:270px; ">
                        <p><strong style="font-size:28px;">{{this.campos.pnombre+" "+this.campos.papellido}}</strong><br>
                        {{this.campos.correo}}
                        </p>
                    </div>
        <div class="col-md-12 center" style="position:relative; top:-210px; ">
            <!--  -->
            <div class="row" style="float:right;position:relative; right:5px; width:50%;">
                <div class="col-md-4">
                 <p id="tab1" class="pointer" style="border-bottom:2px solid #FF9821; color:#FF9821; font-weight: bold;" @click="cambiartab(1);">Datos Personales </p>
                </div>
                <div class="col-md-4">
                    <p id="tab2" class="pointer" @click="cambiartab(2);">Editar Foto </p>
                </div>
                <div class="col-md-4">
                    <p id="tab3" class="pointer" @click="cambiartab(3);">Perfil Profesional</p>
                </div>
            </div>
        </div>
        <template v-if="tab===1">
        <div class="col-md-12" style="position:relative; top:-150px;">
            <div class="row form-cuadro" >
                <div class="col-md-12" style="margin-bottom:20px;">
                    <hr>
                    <p><strong><i class="fas fa-user-circle" style="font-size:25px;margin-left:15px;margin-right:10px;"></i>Datos Personales</strong> </p>
                    <hr>
            <p>Esta información que se encuentra aca es para 
                poder hacer de tus datos un exito en tus estudios,
                 y poder decirle a las empresas.
                 <span style="color:#FF9821;"><strong>Los campos con (*) son obligatorios por favor no se le olvide.</strong></span>
              </p>
                </div>
                <div class="col-md-6 margin-bottom">
                    <label for="">Documento <span style="color:#FF9821;">(*)</span></label><br>
                    <input v-model="campos.documento" id="documento_id" type="text" :disabled="vdocumento">
                    <br>
                </div>
                <div class="col-md-6 margin-bottom">
                    <label for="">Tipo de Documento <span style="color:#FF9821;">(*)</span></label><br>
                    <select name="" v-model="campos.TipoDocumento" id="tipoDocu" :disabled="vtipodocumento">
                        <option value="CC">Cedula de Ciudadania</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cedula de Extranjeria</option>
                        <option value="RC">Registro Civil</option>
                        <option value="">NN</option>
                    </select>
                </div>
                 <div class="col-md-6 margin-bottom">
                    <label for="">Primer Nombre <span style="color:#FF9821;">(*)</span></label><br>
                    <input v-model="campos.pnombre" type="text">
                    <br>
                </div>
                <div class="col-md-6 margin-bottom">
                    <label for="">Segundo Nombre </label><br>
                    <input  v-model="campos.snombre" type="text">
                </div>
                <div class="col-md-6 margin-bottom">
                    <label for="">Primer Apellido <span style="color:#FF9821;">(*)</span></label><br>
                    <input  v-model="campos.papellido" type="text">
                </div>
                <div class="col-md-6 margin-bottom">
                    <label for="">Segundo Apellido</label><br>
                    <input  v-model="campos.sapellido" type="text">
                </div>
                 <div class="col-md-12 margin-bottom">
                     <div class="row">
                         <div class="col-md-6 margin-bottom">
                             <label for="">Telefono Celular</label><br>
                            <input id="TipoDocumento" v-model="campos.telefono" type="text">
                         </div>
                         <div class="col-md-6 margin-bottom">
                            <label for="">Direccion</label><br>
                            <input id="Documento" v-model="campos.direccion" type="text">
                        </div>
                        <div class="col-md-6 margin-bottom">
                            <label for="">Correo Institucional</label><br>
                            <input id="Documento" v-model="campos.correo" type="text">
                        </div>
                        <div class="col-md-6 margin-bottom">
                            <label for="">Fecha Nacimiento (Año-mes-dia) <span style="color:#FF9821;">(*)</span></label><br>
                            <input id="Documento" v-model="campos.fecha" type="text">
                        </div>
                         <div class="col-md-6 margin-bottom">
                            <button @click="guardar_img(1)">Guardar </button>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        </template>
        <template v-if="tab===2">
            <div class="col-md-12 ">
                 
                <div class="col-md-4" style="float:left; position:relative; top:-110px;">
                    <hr>
                   <p style="font-size:20px; font-weight: bold;"><i class="fas fa-photo-video"></i> Foto de perfil</p>
                         <hr>
                            <br>
                    <div   style="width:350px; height:250px;border-radius:8px;border:1px solid #808080;text-align:center; ">
                        <img style="width:60px; height:60px;position:relative; top:120px; " src="/img/cargando/carga.gif" alt="" v-if="cargar_img==1">
                         <p @click="abrir_img();" style="position:relative; top:45%; cursor:pointer;" v-if="cargar_img==0"><i style="font-size:20px;margin-right:10px;" class="fas fa-cloud-upload-alt"></i> Subir Foto</p> 
                        <img id="PreviewImg" style="width:100%; height:100%;border-radius:8px; " :src="imagen" alt="" v-if="cargar_img==3">
                    </div>
                     <div @click="limpiar();" style="color:red; position:relative;top:-240px;right:15px;font-size:35px;float:right;z-index:10;cursor:pointer;" v-if="cargar_img==3">
                        <i class="far fa-times-circle"></i>
                </div>
                <div @click="abrir_img();" style="position:relative;top:-150px;font-size:50px;left:45%;float:left;z-index:10;cursor:pointer;" v-if="cargar_img==3">
                        <i class="fas fa-camera"></i>
                </div>
                    <input type="file"  style="display:none;" @change="upload();" name="cargar" id="cargar">
                     <div class="row" style="padding:10px;">
                        <div class="col-md-6 margin-bottom center" v-if="retroceder">
                            <button @click="refresh"><i class="fas fa-arrow-left"></i></button>
                        </div>
                         <div class="col-md-6 margin-bottom center">
                            <!-- <button @click="guardar_img(2)" :disabled="guardar2">Guardar</button> -->
                        </div>
                        
                     </div>
                     
                </div>
                <div class="col-md-8" style="position:relative; top:-110px; border-left:0.5px solid rgba(0,0,0,0.4);height:500px;overflow:auto; ">
                    <div class="row" >
                        <div class="col-md-12">
                            <hr>
                            <p style="font-size:20px; font-weight: bold;"><i class="fas fa-folder"></i> Perfil / {{this.campos.pnombre+" "+this.campos.papellido}} / mis fotos</p>
                            <hr>
                            <br>

                        </div>
                        <div class="col-md-6" v-for="(item, index) in imagenes" :key="index">
                            <img style="height:250px; width:100%; border-radius:8px; margin-bottom:15px;" :src="item.imagen" alt="">
                        </div>
                    </div>
                </div>
            </div>
           
        
        </template>
        <template v-if="tab===3">
            <div class="col-md-12" style="position:relative; top:-150px;">
                 <hr>
                     <p style="text-align:left;"><strong><i class="fas fa-globe" style="font-size:25px;margin-left:15px;margin-right:10px;"></i>Datos Laborales</strong></p>
                      <p>La información suministrada se enviara a las empresas siempre y cuando nos des el permiso de utilizar tus datos
                          para ayudarte a buscar empleo cuanto antes por favor llena toda la información asi tendras mas posibilidades de 
                          ingresar a una empresa .
                 <span style="color:#FF9821;"><strong>Los campos con (*) son obligatorios por favor no se le olvide.</strong></span>
                     <hr>
                     <div class="row" style=" padding:10px;">
                         <div class="col-md-12 margin-bottom">
                            <label for="">Perfil Profesional </label><br>
                            <textarea  v-model="campos.perfilprofesional"  cols="62" rows="5">
                                </textarea>
                        </div>
                         <div class="col-md-6 margin-bottom">
                             <div class="col-md-6"><label for="">Estudios Realizados </label></div>
                             <div class="col-md-6" style="cursor:pointer;color:#FF9821;"><i class="fas fa-plus-circle" style="font-size:28px;"></i> <strong>Nuevo Estudio</strong> </div>
                            <br>
                            <br>
                            <div class="col-md-6"><input type="text" placeholder="Carrera que estudio"></div>
                            <div class="col-md-6"><input type="text" placeholder="Universidad"></div>
                          
                            
                        </div>
                        <div class="col-md-6 margin-bottom">
                             <div class="col-md-6"><label for="">Experiencia laboral </label></div>
                             <div class="col-md-6" style="cursor:pointer;color:#FF9821;"><i class="fas fa-plus-circle" style="font-size:28px;"></i> <strong>Nueva Experiencia</strong> </div>
                            <br>
                            <br>
                            <div class="col-md-6"><input type="text" placeholder="Carrera que estudio"></div>
                            <div class="col-md-6"><input type="text" placeholder="Universidad"></div>
                          
                            
                        </div>
                         <div class="col-md-6 margin-bottom">
                             <div class="col-md-6"><label for="">Referencias Familiares </label></div>
                             <div class="col-md-6" style="cursor:pointer;color:#FF9821;"><i class="fas fa-plus-circle" style="font-size:28px;"></i> <strong>Nueva Referencia</strong> </div>
                            <br>
                            <br>
                            <div class="col-md-6" style="margin-bottom:10px;"><input type="text" placeholder="Carrera que estudio"></div>
                            <div class="col-md-6" style="margin-bottom:10px;"><input type="text" placeholder="Universidad"></div><br>
                            <div class="col-md-6" style="margin-bottom:10px;"><input type="text" placeholder="Carrera que estudio"></div>
                            <div class="col-md-6" style="margin-bottom:10px;"><input type="text" placeholder="Universidad"></div>
                          
                            
                        </div>
                         <div class="col-md-6 margin-bottom">
                             <div class="col-md-6"><label for="">Referencias Laborales </label></div>
                             <div class="col-md-6" style="cursor:pointer;color:#FF9821;"><i class="fas fa-plus-circle" style="font-size:28px;"></i> <strong>Nueva Referencia</strong> </div>
                            <br>
                            <br>
                            <div class="col-md-6"><input type="text" placeholder="Carrera que estudio"></div>
                            <div class="col-md-6"><input type="text" placeholder="Universidad"></div>
                          
                            
                        </div>
                        
                     </div>
                     <div class="row" style="padding:10px;">
                         <div class="col-md-6 margin-bottom">
                            <!-- <button @click="guardar_img(3)">Guardar</button> -->
                        </div>
                     </div>
            </div>
           
        </template>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['person','ruta'],
    data: function(){
        return{
            cargar_img:0,
            imagen:'',
            imagen2:'',
            typeImage:'',
            tab:1,
            campos:{
                pnombre:'',
                snombre:'',
                papellido:'',
                sapellido:'',
                documento:'',
                TipoDocumento:'',
                direccion:'',
                correo:'',
                fecha:'',
                telefono:'',
                perfilprofesional:'',
                estudios:'',
            },
            guardar2:Boolean(0),
            vdocumento:Boolean(0),
            vtipodocumento:Boolean(0),
            imagenes:[],
            retroceder:Boolean(0),
        }
    },
    mounted: function(){
        this.ListarDatos();
    },
    methods:{
        abrir_img: function(){
            let me = this;
            $('#cargar').click();
        },
        upload: function(){
            let me = this;
            me.cargar_img = 1;
           let file =  $('#cargar');
           let file_data =  file.prop("files")[0];
           me.cargar_img = 3;
           if (!(/\.(jpg|png|gif)$/i).test(file_data.name)) {
                alert('El archivo a adjuntar no es una imagen');
            }else{
                // typeImage = file_data.
                me.typeImage = file_data.type;
                var render = new FileReader();
                render.readAsDataURL(file_data);
                render.onload= function(){
                    var result=render.result;
                    me.imagen = result;
                    me.guardar2 = Boolean(1);
                };
            }
        //    console.log(file);
        },
        cambiartab: function(value){
            let me = this;
            document.getElementById("tab1").removeAttribute("style");
            document.getElementById("tab2").removeAttribute("style");
            document.getElementById("tab3").removeAttribute("style");
            document.getElementById("tab"+value).setAttribute("style","border-bottom:2px solid #FF9821; color:#FF9821; font-weight: bold;");
            if(value===1){
                if(me.campos.documento!==''){
                    me.vdocumento = Boolean(1);
                }
                if(me.campos.TipoDocumento!==''){
                    me.vtipodocumento = Boolean(1);
                }
            }
            if(value===2){
                me.cargarFotos();
            }
            me.tab = value;
        },
        guardar_img: function(tab){
            let me = this;
            let images = {'imagen':me.imagen,'type':me.typeImage};
             axios.post('perfilStore',{
                    'campos': me.campos,
                    'estudiante':me.person,
                    'imagen':images,
                    'guardar':tab,
                }).then(function (response) {
                    var respuesta = response.data;
                    let respuesta_data = '';
                    let url ='';
                     if(Boolean(parseInt(localStorage.getItem('primera_ves')))){
                        url = "/mis-cursos";
                        }else{
                            url="/perfil";
                        }
                 me.MensajeAlert('D - Academy Información',respuesta.guardado,'warning',false,'Ok', '','success',url);
                }).catch(function (error) {
                    console.log(error);
                });
        },
        refresh: function(){
            let me = this;
            me.imagen = me.imagen2;
            me.cargar_img = 3;
            me.retroceder = Boolean(0);
        },
        limpiar: function(){
            let me = this;
            me.cargar_img = 0;
            $('#cargar').val('');
            let img  = document.getElementById("PreviewImg");
            img.src= "";
            me.typeImage = "";
            me.imagen="";
            me.retroceder = Boolean(1);
            me.guardar2 = Boolean(1);
        },
        ListarDatos: function(){
            let me = this;
            let url = "/ListarPerfil?estudiante="+me.person;
            axios.get(url).then(function (response) {
                    
                    var respuesta = response.data;
                    console.log(respuesta);
                    me.campos.pnombre = respuesta.dataPerson[0].primer_nombre;
                    me.campos.snombre = respuesta.dataPerson[0].segundo_nombre;
                    me.campos.papellido = respuesta.dataPerson[0].primer_apellido;
                    me.campos.sapellido = respuesta.dataPerson[0].segundo_apellido;
                    me.campos.direccion = respuesta.dataPerson[0].direccion;
                    me.campos.correo = respuesta.dataPerson[0].correo_institucional;
                    if(respuesta.dataPerson[0].n_documento!==0)
                    {
                        me.vdocumento = true;
                        me.campos.documento = respuesta.dataPerson[0].n_documento;
                    }
                    if(respuesta.dataPerson[0].tipo_documento!==null)
                    {
                        me.vtipodocumento = true;
                        me.campos.TipoDocumento = respuesta.dataPerson[0].tipo_documento;
                    }
                    me.campos.sapellido = respuesta.dataPerson[0].segundo_apellido;
                    
                    me.campos.telefono = respuesta.dataPerson[0].telefono;
                    me.campos.fecha = respuesta.dataPerson[0].fecha_nacimiento;
                    if(respuesta.dataPerson[0].imagen!==null){
                        me.cargar_img = 3;
                        me.imagen ="/"+respuesta.dataPerson[0].imagen;
                        me.imagen2 = "/"+respuesta.dataPerson[0].imagen;
                    }else{
                        me.imagen ="/";
                        me.imagen2 = "/";
                    }
                     console.log(respuesta);
                }).catch(function (error) {
                    console.log(error);
                });
        },
        MensajeAlert: function(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage,url)
        {
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }else{
                    if(iconsMessage==="error"){
                        return false;
                    }else{
                       window.location.href = url;
                    }
                    
                }
                });
        },
        cargarFotos: function(){
            var url = "/imagenes?carpeta="+this.campos.documento;
            let me = this;
             axios.get(url).then(function(response){
                 let result = response.data;
                me.imagenes = result.Fotos;
           }).catch(function(error){
               console.log(error);
           });
        }
    },
    computed:{
    },

}
</script>