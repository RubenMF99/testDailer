<template>
<div style="display:block;">
        <ul class="not-show-movil">
            <li id="login-popup-3" class="widget widget_login-popup">
                <div class="thim-widget-login-popup thim-widget-login-popup-base template-base">
                    <div class="thim-link-login thim-login-popup" >
                        <a id="L" class="login action-link style-btn-segundary" tabindex="-1" @click="showCreateClientForm(1,1)" data-dismiss="modal" data-backdrop="false">Iniciar Sesion</a>
                        <a id="R" class="login action-link style-btn" @click="showCreateClientForm(0,1)">Registrate Gratis</a>
                    </div>
                </div>
            </li>
        </ul>
         <nav class="menu-responsive">
                    <ul>
                        <!-- <li><a href="">Inicio</a></li> -->
                        <li><a id="L"  tabindex="-1" @click="showCreateClientForm(1,2)" data-dismiss="modal" data-backdrop="false"><i style="font-size:20px;" class="fas fa-user-shield"></i> Iniciar Sesion</a></li> 
                        <li><a id="R"  @click="showCreateClientForm(0,2)"><i style="font-size:20px;" class="fas fa-user-edit"></i> <strong>Registrarme Gratis</strong></a></li>
                    </ul>
        </nav>
        <!-- --------------------------------------------------------------------------------------- -->
<div class="modal fade" id="modal-edit-client" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index:100000000; background:rgba(0, 0, 0, 0.90);">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-image:url('/img/fondos/fondo_login.jpg'); top:60px;">
                    <div class="modal-header" style="background:#fffffff; height: 40px;">
                        <div></div>
                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true"  @click="verificar();">&times;</button>
                    </div>

                    <div class="modal-body">
                        
                        <div class="col-md-12 center" style="padding:12px; color:#808080;margin-top:15px;">
                            <p style="font-size:25px;"> 
                             <img style=" position:relative; width:180px; height:70px;" src="/img/LOGO.png" alt="">
                             </p>
                             <p style="width:100%;">Aprende habilidades de las principales <br> universidades de manera gratuita.</p>
                        </div>
                     <div class="col-md-12 center" style="margin-top:20px;">

                          <div style="margin-bottom:30px; padding-left:15%; padding-right:15%;" class="col-md-12" v-if="sw">
                                 <div class="row">
                                     <div class="col-md-6">
                                          <div style="border-bottom:2px solid #FF9821;cursor:pointer;color:#FF9821; font-size:20px;" @click="cambiar(1);"><strong>Iniciar Sesión</strong></div>
                                     </div>
                                      <div class="col-md-6">
                                          <div style="background:#fffff; color:#808080;cursor:pointer;" @click="cambiar(0);">Registrarme</div>
                                     </div>
                                 </div>
                            </div>
                            <div style="margin-bottom:30px; padding-left:15%; padding-right:15%;" class="col-md-12" v-else>
                                 <div class="row">
                                     <div class="col-md-6">
                                          <div style="background:#fffff; color:#808080;cursor:pointer;" @click="cambiar(1);">Iniciar Sesión</div>
                                     </div>
                                      <div class="col-md-6">
                                          <div style="border-bottom:2px solid #FF9821;cursor:pointer;color:#FF9821;font-size:20px;" @click="cambiar(0);"><strong>Registrarme</strong></div>
                                     </div>
                                 </div>
                            </div>

                         <template v-if="sw" >
                         <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"> Iniciar Sesión</p>
                      
                    <div class="input-group mb-3 input-group-lg" style="padding-left:15%; padding-right:15%;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg input required" @input="borrar(this);" style="height: calc(1.5em + 2rem + 2px);font-size:14px;" placeholder="Usuario" v-model="inicarsesion.usuario"><br>

                    </div>
                    <p  style="color:red;"  v-text="errorusuario"></p>
                    <div class="input-group mb-3 input-group-lg" style="padding-left:15%; padding-right:15%;">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password"  class="form-control input-lg" @input="borrar(this);" style="height: calc(1.5em + 2rem + 2px); font-size:14px;" @keyup.enter="iniciarSeccion()" placeholder="Contraseña" v-model="inicarsesion.contrasena"><br>
                    </div>
                    <p  style="color:red;" v-text="errorcontrasena"></p>
                    <div v-if="button_view">
                        <button style="text-align: center;" ><span><img style="width:25px;margin-right:12px;" src="/img/cargando/carga.gif" alt=""></span> Cargando...</button><br><br>
                        
                    </div>
                    <div v-else-if="!button_view" style="margin-bottom:15px;">
                        <button style="text-align: center; background:#FF9700 !important;"  @click="iniciarSeccion()" >Iniciar Sesión</button><br>
                    </div>
                    <a style="text-align: center; margin-top:15px; color:#FF9821;" href="/recuperar-contraseña" >¡Olvide mi contraseña!</a>
                    <br>
                    <div v-show="show"  class="alert alert-danger" role="alert" v-html="errors">
                    </div>
                      <!-- --------------------------------------------------------------------------------------------------------------------- -->
                         </template>
                         <template v-else>
                             <!-- primer template Registrate-->
                             <template v-if="tabindex==1">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Primer Paso:</strong> Crear Usuario</p>
                                     <p>Todos los campos requeridos</p>
                                 <div class="form-group col-md-12">
                   <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                       <input placeholder="Correo (*)."  class="form-control" type="email" @input="borrar(this);" v-model="registrame.tab1.usuario_two">
                       <p  style="color:red; font-size:14px;" v-text="errorusuario_two"></p>
                    </div>
        </div>
             <div class="form-group col-md-12">
                   <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                       <input type="password" placeholder="Contraseña (*)." @input="borrar(this);" class="form-control" v-model="registrame.tab1.contrasena_two">
                       <p  style="color:red; font-size:14px;" v-text="errorcontrasena_two"></p>
        </div>
        </div>
                             <div class="form-group col-md-12">
                                <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                    <input type="password" placeholder="Confrimar Contraseña (*)." @input="confirmar(this);" class="form-control" v-model="registrame.tab1.confirmar_contrasena">
                                    <p  style="color:red; font-size:14px;" v-text="errorconfirmar_contrasena"></p>
                                    <p  style="color:red; font-size:14px;" v-text="errorconfirmar_contrasena_true"></p>
                                </div>
                                </div>
                                <div class="col-md-12" style="text-align: center;  ">
                                        <button style="background:#FF9700 !important;" @click="tab(2,1)">Siguiente</button><br><br>
                                    </div>
                             </template>
                             <!-- segundo template -->
                             <template v-if="tabindex==2">
                                                <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Segundo Paso:</strong> Datos Personales</p>
                                                                    <p>al ingresar el nombre completo asi aparecera en el certificado.</p>
                                                <div class="form-group col-md-12">
                                                <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Primer Nombre (*)."  class="form-control" @input="borrar(this);" v-model="registrame.tab2.primer_nombre">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprimer_nombre"></p>
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Segundo Nombre."  class="form-control" v-model="registrame.tab2.segundo_nombre">
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Primer Apellido (*)."  class="form-control" @input="borrar(this);" v-model="registrame.tab2.primer_apellido">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprimer_apellido"></p>
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Segundo Apellido."  class="form-control"  v-model="registrame.tab2.segundo_apellido">
                                                </div></div>
                                                <div class="col-md-6" style="text-align: center;">
                                                     <a @click="back(1);">Atras</a>
                                                </div>    
                                                <div class="col-md-6" style="text-align: center; ">
                                                    <button style="background:#FF9700 !important;" @click="tab(3,2)">Registrarme</button><br><br>
                                                </div>
                             </template>
                         </template>
                     </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer" style="margin-top:25px;">
                        <div class="row" style="width: 100% !important;">
                            <div class="col-md-12">
                                 <div class="col-md-7">
                            www.d-academy.co
                            </div>
                            <div class="col-md-5">
                                <button type="button" style="float:right;background:#2F89B6;" class="btn btn-secondary" data-dismiss="modal" @click="verificar();">Cerrar</button>
                            </div>
                            </div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
import VeeValidate from 'vee-validate';
    export default {
          props: ['ruta'],
        data(){
            return{
                inicarsesion:{
                    usuario: '',
                    contrasena: '',
                },
                registrame:{
                    tab1:{
                        usuario_two: '',
                        contrasena_two: '',
                        confirmar_contrasena: '',
                    },
                    tab2:{
                        documento:'',
                        tipodocumento:'',
                        primer_nombre: '',
                        segundo_nombre: '',
                        primer_apellido: '',
                        segundo_apellido: '',
                    },
                    
                },
                inputcheck1:'',
                inputcheck2:'',
                inputcheck3:'',
                inputcheck4:'',
                button_view:'',
                sw: 1,
                ir:3,
                errorusuario:'',
                errorcontrasena:'',
                show:Boolean(0),
                errors:'',
                errorprimer_nombre:'',
                errorprimer_apellido:'',
                errorusuario_two:'',
                errorcontrasena_two:'',
                errorconfirmar_contrasena:'',
                errorconfirmar_contrasena_true:'',
                tabindex:1,
                
            }
        },
        computed:{
                borrar(input){
                    return function(){
                            if(input.inicarsesion.usuario != ""){
                                 if(this.errorusuario != "")
                                {
                                    this.errorusuario = "";
                                }
                            }
                            if(input.inicarsesion.contrasena != ""){
                                if(this.errorcontrasena != "")
                                {
                                    this.errorcontrasena = "";
                                }
                            }
                            if(input.registrame.tab1.usuario_two != "")
                            {
                                if(this.errorusuario_two != "")
                                {
                                    this.errorusuario_two = "";
                                }
                            }
                            if(input.registrame.tab1.contrasena_two != "")
                            {
                                if(this.errorcontrasena_two != "")
                                {
                                    this.errorcontrasena_two = "";
                                }
                            }
                           
                           
                            if(input.registrame.tab2.primer_nombre != "")                          
                            {
                                if(this.errorprimer_nombre != "")
                                {
                                    this.errorprimer_nombre = "";
                                }
                            }
                            if(input.registrame.tab2.primer_apellido != "")                          
                            {
                                if(this.errorprimer_apellido != "")
                                {
                                    this.errorprimer_apellido = "";
                                }
                            }
                            
                            this.error = '';
                    }
                },
                confirmar(input){
                    return function(){
                         if(input.registrame.tab1.confirmar_contrasena != "")
                            {
                                if(this. errorconfirmar_contrasena != "")
                                {
                                    this. errorconfirmar_contrasena = "";
                                }
                            }
                        if(input.registrame.tab1.contrasena_two != input.registrame.tab1.confirmar_contrasena)
                        {
                            this. errorconfirmar_contrasena_true = "Las contraseñas ingresadas no coinciden, intente de nuevo...";
                        }else{
                            this. errorconfirmar_contrasena_true = "";
                        }
                    }
                }
        },
        methods:{
            
                trabaja(value){
                    if(value===2){
                        this.registrame.tab4.trabajo = "Ambos";
                    }else{
                        if(Boolean(value)){
                            this.registrame.tab4.trabajo = "trabajo";
                        }else{
                            this.registrame.tab4.trabajo = "estudio";
                        }
                    }
                    
                },
            validarRegistro(){
                    this.registrarUsuario();
            },
            tab(next,value){
                let me = this;
              if(this.verificar_state(value))
              {
                  if(value===1)
                  {
                        let url = "/correo?correo="+me.registrame.tab1.usuario_two;
                        axios.get(url).then(function (response) {
                        let result  = response.data;
                        console.log(result);
                        me.errorusuario_two = result.answer;
                        if(Boolean(result.state)){
                            me.tabindex = next;
                        }
                        }).catch(function (response){});
                  }
                  else{
                      if(value === 2)
                      {
                          me.validarRegistro();
                      }else{
                          me.tabindex = next;
                      }
                      
                  }
              }
            },
            verificar_state(value){
                let me = this;
                 if(value === 1)
                {
                    if(me.registrame.tab1.usuario_two===''){
                        this.errorusuario_two = "Ingresa tu usuario";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.usuario_two!==''){
                        let strings = me.registrame.tab1.usuario_two;
                        const validate = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        let response =  validate.test(strings);
                        if(!response){
                            this.errorusuario_two ="El correo no es valido vuelva a intentarlo";
                            return Boolean(0);
                        }
                    }
                    if(me.registrame.tab1.contrasena_two===''){
                        this.errorcontrasena_two = "Ingresa tu contraseña";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.confirmar_contrasena===''){
                        this.errorconfirmar_contrasena = "confirma tu contraseña";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.contrasena_two!==''){
                        let count = me.registrame.tab1.contrasena_two.length;
                        if(count<8)
                        {
                            this.errorcontrasena_two ="Debes ingresar una contraseña mayor o igual a 8 caracteres.";
                            return Boolean(0);
                        }else{
                            let strings = me.registrame.tab1.contrasena_two;
                            let validate = /^(?=.*\d)(?=.*[!@#.$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                            let response =  validate.test(strings); 
                            if(!response){
                                this.errorcontrasena_two ="La contraseña debe incluir al menos una letra mayuscula, ninuscula, numero y (*,.).";
                                return Boolean(0);
                            }
                        }
                       if(me.registrame.tab1.contrasena_two===me.registrame.tab1.confirmar_contrasena)
                        {
                                    return Boolean(1);
                        }else{
                                    return Boolean(0);
                        }
                    }
                }else if(value===2){
                     if(me.registrame.tab2.primer_nombre==='')
                    {
                        this.errorprimer_nombre = "Ingrese primer nombre";
                        return Boolean(0);
                    }
                    else if(me.registrame.tab2.primer_apellido==='')
                    {
                        this.errorprimer_apellido = "Ingrese primer apellido";
                        return Boolean(0);
                    }else{
                        return Boolean(1);
                    }
                }
            },
           
            back(before){
                this.tabindex = before;
            },
            cambiar(sw){
                this.sw = sw;
            },
            showCreateClientForm(sw,modalView){
                this.sw = sw;
                if(modalView===2)
                {
                    $('#modal-edit-client.modal').addClass('fadeview');
                    $('#modal-edit-client.modal').addClass('modal-view');
                    $('.menu-responsive').removeClass('yes-show-movil');
                    $('.menu-responsive').addClass('not-show-movil');
                }
                $('#modal-edit-client').modal('show');
            },
            verificar(){
                if(localStorage.getItem('rutaCompra')===null || localStorage.getItem('rutaCompra')===undefined){
                }else{
                   localStorage.removeItem('rutaCompra');
               }
               document.getElementById('Mm').click();
                $('#modal-edit-client.modal').removeClass('fadeview');
                $('#modal-edit-client.modal').removeClass('modal-view');
                $('#modal-edit-client').modal('hide');
            },
            iniciarSeccion(){
                let me = this;
                me.button_view = Boolean(1);
                // validacion de input
                if(me.inicarsesion.usuario===""){
                    me.errorusuario = "Ingrese el usuario";
                     me.button_view = Boolean(0);
                }
                if(me.inicarsesion.contrasena===""){
                    me.errorcontrasena = "Ingrese la contraseña";
                     me.button_view = Boolean(0);
                }
                if(me.inicarsesion.usuario != "" && me.inicarsesion.contrasena != ""){
                    // validacion correcta procedemos a enviar los datos
                     axios.post(me.ruta + 'login',{
                    'usuario': me.inicarsesion.usuario,
                    'contrasena': me.inicarsesion.contrasena
                    }).then(function (response) {
                        let respose = response.data + "/";
                        if(respose === "/"){
                            respose = "/Home";
                        }
                        let redirect = true;
                        // console.log(response);
                        // si el usuario o contraseña es incorrecto
                        if(response.data ==="error"){
                            me.button_view = Boolean(0);
                            me.show = true;
                            me.errors = "Usuario y/o Contraseña Incorrecta";
                            redirect = false;
                        }
                        // comprobamos si lo enviamos a la vista por defecto o la accion del usuario
                    if(redirect)
                    {
                        // console.log(response);
                        me.button_view = Boolean(0);
                        if(localStorage.getItem('rutaCompra')===null || localStorage.getItem('rutaCompra')===undefined){
                            if(localStorage.getItem('ayuda')===null || localStorage.getItem('ayuda')===undefined){
                                // url por defecto
                                window.location.href=respose;
                            }else{
                                // url por el usuario ayuda a buscar trabajo (llenar todos los campos en mi perfil)
                               localStorage.removeItem('ayuda');
                               localStorage.setItem('primera_ves',1);
                               window.location.href="/perfil";
                            }
                        }else{
                            // ruta para comprar un curso.
                                window.location.href=localStorage.getItem('rutaCompra');
                        }
                    }
                    }).catch(function (error) {
                        console.log(error);
                        me.button_view = Boolean(0);
                        me.errorusuario = ""+error.response.data.errors.usuario+"";
                        me.errorcontrasena =  ""+error.response.data.errors.contrasena+"";
                    });
                }
            },
                  registrarUsuario(){
                let me = this;
                // let ciudads = '';
                // if(me.registrame.tab3.ciudad2===undefined||me.registrame.tab3.ciudad2===''||me.registrame.tab3.ciudad2===null){
                //    ciudads = me.registrame.tab3.ciudad;
                // }else{
                //    ciudads = me.registrame.tab3.ciudad2;
                // }
                axios.post(me.ruta + '/usuario/registrar',{
                    // datos de usuarios
                    'usuario': me.registrame.tab1.usuario_two,
                    'contrasena': me.registrame.tab1.contrasena_two,
                    // información de la persona
                    // 'documento':me.registrame.tab2.documento,
                    'tipo_documento':me.registrame.tab2.tipodocumento,
                    'primer_nombre':  me.registrame.tab2.primer_nombre,
                    'segundo_nombre': me.registrame.tab2.segundo_nombre,
                    'primer_apellido': me.registrame.tab2.primer_apellido,
                    'segundo_apellido': me.registrame.tab2.segundo_apellido,
                    'ir':me.ir,
                    
                }).then(function (response) {
                    // console.log(response);
                    // if(me.ayudas){
                    //     localStorage.setItem('ayuda',0);
                    // }
                    // iniciar sesion con el usuario que se acaba de regstrar.
                 me.inicarsesion.usuario = me.registrame.tab1.usuario_two;
                 me.inicarsesion.contrasena = me.registrame.tab1.contrasena_two;
                me.iniciarSeccion();
                }).catch(function (error) {
                    console.log(error);
                });
            },
        },
    }
</script>
<style >
.modal-backdrop {
  z-index: -1;
}
</style>