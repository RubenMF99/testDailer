<template>
<div>

                <div class="col-md-6"></div>
                <div class="col-md-5" style="margin-left:-45px;">
                    <div class="row fondo-tranparent">
                        <div class="col-md-12 center" style="padding:12px; color:#808080;margin-top:15px;">
                            <p style="font-size:25px;"> 
                             <img style=" position:relative; width:180px; height:70px;" src="/img/LOGO.png" alt="">
                             </p>
                             <p style="width:100%;">¡Bienvenido! <br> Te invitamos a que compartas <br> tus conocimientos  con nosotros.</p>
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
                                          <div style="background:#fffff; color:#808080;cursor:pointer;" @click="showCreateClientForm(1)">Iniciar Sesión</div>
                                     </div>
                                      <div class="col-md-6">
                                          <div style="border-bottom:2px solid #FF9821;cursor:pointer;color:#FF9821;font-size:20px;" @click="cambiar(0);"><strong>Registrarme</strong></div>
                                     </div>
                                 </div>
                            </div>
                         <template v-if="!sw">
                             <!-- primer template -->
                             <template v-if="tabindex==1">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Primer Paso:</strong> Crear Usuario</p>
                                                                    <p>Todos los campos requeridos</p>
                                                                   
                                                                    
                                 <div class="form-group col-md-12">
                   
                   <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                       <input placeholder="Correo (*)."  :class="'form-control ' +classusuario_two " type="email" @input="borrar(this);" v-model="registrame.tab1.usuario_two">
                       <p  style="color:red; font-size:14px;" v-text="errorusuario_two"></p>
                    </div>
        </div>
             <div class="form-group col-md-12">
                   
                   <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                       <input type="password" placeholder="Contraseña (*)." @input="borrar(this);" :class="'form-control ' +classcontrasena_two" v-model="registrame.tab1.contrasena_two">
                       <p  style="color:red; font-size:14px;" v-text="errorcontrasena_two"></p>
                       
        </div>
           
        </div>
                             <div class="form-group col-md-12">
                   
                                <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                    <input type="password" placeholder="Confrimar Contraseña (*)." @input="confirmar(this);" :class="'form-control ' +classconfirmar_contrasena" v-model="registrame.tab1.confirmar_contrasena">
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
                                                                    <p></p>
                                                                    
                                                    <div class="form-group col-md-12">
                                                            <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                                <input placeholder="Documento (*)." ref="tab2" type="number"  :class="'form-control ' +classdocumento" @input="borrar(this);" v-model="registrame.tab2.documento">
                                                                <p  style="color:red; font-size:14px;" v-text="errordocumento"></p>
                                                            </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <select  :class="'form-control ' +classtipodocumento" @change="borrar(this);" v-model="registrame.tab2.tipodocumento"  >
                                                                <option value="">Tipo de Documento (*)</option>
                                                                <option value="CC">Cedula de Ciudadania</option>
                                                                <option value="CE">Cedula de Extranjeria</option>
                                                                <option value="TI">Tarjeta de Identidad</option>
                                                                <option value="RC">Registro Civil</option>
                                                                
                                                            </select>
                                                            <p  style="color:red; font-size:14px;" v-text="errortipodocumento"></p>
                                                        </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Primer Nombre (*)."  :class="'form-control ' +classprimer_nombre" @input="borrar(this);" v-model="registrame.tab2.primer_nombre">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprimer_nombre"></p>
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Segundo Nombre."  class="form-control" v-model="registrame.tab2.segundo_nombre">
                                                            <!-- <p  style="color:red;" v-text="errorprimer_nombre"></p> -->
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Primer Apellido (*)."  :class="'form-control ' +classprimer_apellido" @input="borrar(this);" v-model="registrame.tab2.primer_apellido">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprimer_apellido"></p>
                                                </div></div>
                                                <div class="form-group col-md-12">
                                                        
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <input placeholder="Segundo Apellido."  class="form-control"  v-model="registrame.tab2.segundo_apellido">
                                                            <!-- <p  style="color:red;" v-text="errorprimer_nombre"></p> -->
                                                </div></div>
                                                <div class="col-md-6" style="text-align: center;">
                                                     <a @click="back(1);">Atras</a>
                                                </div>    
                                                <div class="col-md-6" style="text-align: center; ">
                                                    <button style="background:#FF9700 !important;" @click="tab(3,2)">Siguiente</button><br><br>
                                                    
                                                </div>
                             </template>
                             <!-- tercer template -->
                             <template v-if="tabindex==3">
                                  <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Tercer Paso:</strong> Ubicación Actual</p>
                                                                    <p>¡Te damos la Bienvenida {{registrame.tab2.primer_nombre}} <br> queremos saber un poco mas de ti!</p>
                                <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <select  :class="'form-control '+classpais" @change="borrar(this);" v-model="registrame.tab3.pais"  >
                                                                <option value="0">En que pais te encuentras (*)</option>
                                                               <option v-for="(items, index) in ListasPaises" :key="index" :value="items.id" >{{items.nombre}}</option>
                                        </select>
                                        <p  style="color:red; font-size:14px;" v-text="errorpais"></p>
                                    </div>
                                </div>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <select  :class="'form-control '+classciudad " @change="borrar(this);"  v-model="registrame.tab3.ciudad"  >
                                                                <option value="0">En que ciudad te encuentras (*)</option>
                                                               <option v-for="(items, index) in ListasCiudades" :key="index" :value="items.id" >{{items.nombre}}</option>
                                        </select>
                                        <p  style="color:red; font-size:14px;" v-text="errorciudad"></p>
                                    </div>
                                </div>
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(2);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center; ">
                                            <button style="background:#FF9700 !important;" @click="tab(4,3)">Siguiente</button><br><br>
                                </div>
                             </template>
                             <!-- cuarto template -->
                             <template v-if="tabindex==4">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Cuarto Paso:</strong>  Comparte tus conocimientos</p>
                                                                    <p><strong>¿Que clase de enseñanaza has hecho antes?</strong></p>
                                <div class="form-group col-md-12" >
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                       <p class="text-derecha">
                                           <input  type="radio" v-model="inputcheck1" name="r4" @change="tabradio4(1)" id="r41"> <label for="r41">En persona, informalmente.</label>
                                       <br><input type="radio" v-model="inputcheck2" name="r4" @change="tabradio4(2)" id="r42"> <label for="r42">En persona, formalmente.</label>
                                       <br><input type="radio" v-model="inputcheck3" name="r4" @change="tabradio4(3)" id="r43"> <label for="r43">En linea.</label>
                                       <br><input type="radio" v-model="inputcheck4" name="r4" @change="tabradio4(4)" id="r44"> <label for="r44">Otro</label>
                                       <br><input type="text" name="r4" @input="borrar(this)" :class="'form-control '+classensena_profesor" id="r441" placeholder="Enseñanza que hayas hecho..." v-if="inputr4" v-model="registrame.tab4.ensena_profesor"> 
                                       </p>
                                       <p  style="color:red; font-size:14px;" v-text="errorensena_profesor"></p>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(3);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center; ">
                                            <button style="background:#FF9700 !important;" @click="tab(5,4)">Siguiente</button><br><br>
                                            
                                </div>
                             </template>
                             <!-- quinto template -->
                             <template v-if="tabindex===5">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Quinto Paso:</strong> Experiencia con Video</p>
                                                                    <p><strong>¿Cuánto de un video "pro" eres?</strong></p>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                       <p class="text-derecha">
                                           <input type="radio" v-model="inputcheck5" name="r5" @change="tabradio5(1)" id="r51"> <label for="r51">Soy un principiante.</label>
                                       <br><input type="radio" v-model="inputcheck6" name="r5" @change="tabradio5(2)" id="r52"> <label for="r52">Tengo algo de conocimiento.</label>
                                       <br><input type="radio" v-model="inputcheck7" name="r5" @change="tabradio5(3)" id="r53"> <label for="r53">Tengo experiencia.</label>
                                       <br><input type="radio" v-model="inputcheck8" name="r5" @change="tabradio5(4)" id="r54"> <label for="r54">Tengo videos para subir</label>
                                       </p>
                                       <p  style="color:red; font-size:14px;" v-text="errorvideo"></p>
                                    </div>
                                </div>
                               
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(4);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center;">
                                            <button style="background:#FF9700 !important;" @click="tab(6,5)">Siguiente</button><br><br>
                                </div>
                             </template>
                             <!-- Sexto template -->
                             <template v-if="tabindex===6">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Sexo Paso:</strong> Amplia tu alcance</p>
                                                                    <p><strong>¿Tienes unas con la que puedas compartir tu curso?</strong></p>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                       <p class="text-derecha">
                                           <input type="radio" v-model="inputcheck9" name="r6" @change="tabradio6(1)" id="r61" > <label for="r61">No en este momento.</label>
                                       <br><input type="radio" v-model="inputcheck10" name="r6" @change="tabradio6(1)" id="r62" > <label for="r62">Tengo un pequeño seguimiento.</label>
                                       <br><input type="radio" v-model="inputcheck11" name="r6" @change="tabradio6(1)" id="r63" > <label for="r63">Tengo un seguimiento considerable.</label>
                                       </p>
                                       <p  style="color:red; font-size:14px;" v-text="errorampliar_conocimiento"></p>
                                    </div>
                                </div>
                               
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(5);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center;">
                                            <button style="background:#FF9700 !important;" @click="validarRegistro()">Finalizar</button><br><br>
                                </div>
                             </template>
                         </template>
                     </div>
                     <div>
                        <div class="col-md-12 center">
                            www.d-academy.co
                        </div>
                    </div>
                    </div>
                    <!-- Modal Actions -->
                    
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
                    tab3:{
                        pais:0,
                        ciudad:0,
                    },
                    tab4:{
                        ensena_profesor:'',
                    },
                    tab5:{
                        video:'',
                    },
                    tab6:{
                        ampliar_conocimiento:'',
                    }
                },
                
                inputcheck1:'',inputcheck2:'',inputcheck3:'',inputcheck4:'',
                inputcheck5:'',inputcheck6:'',inputcheck7:'',inputcheck8:'',
                inputcheck9:'',inputcheck10:'',inputcheck11:'',
                inputr4:Boolean(0),
                ListarProfesiones:[],
                ListasPaises:[],
                ListasCiudades:[],
                button_view:'',
                sw: 0,
                ir:3,
                show:Boolean(0),
                // errorres con icono
                classusuario_two:'',
                classusuario:'',
                classcontrasena:'',
                classdocumento:'',
                classpais:'',
                classciudad:'',
                classtipodocumento:'',
                classprimer_nombre:'',
                classprimer_apellido:'',
                classcontrasena_two:'',
                classconfirmar_contrasena:'',
                classconfirmar_contrasena_true:'',
                classensena_profesor:'',
                
                
                // mensaje de error
                errors:'',
                errorusuario:'',
                errorcontrasena:'',
                errordocumento:'',
                errorpais:'',
                errorciudad:'',
                errortipodocumento:'',
                errorprimer_nombre:'',
                errorprimer_apellido:'',
                errorusuario_two:'',
                errorcontrasena_two:'',
                errorconfirmar_contrasena:'',
                errorconfirmar_contrasena_true:'',
                errorensena_profesor:'',
                errorvideo:'',
                errorampliar_conocimiento:'',
                tabindex:1,
                ayudas:Boolean(0),
            }
        },
        computed:{
                borrar(input){
                    return function(){
                            if(input.inicarsesion.usuario != ""){
                                 if(this.errorusuario != "")
                                {
                                    this.errorusuario = "";
                                    this.classusuario_two = "";
                                }
                            }
                            if(input.inicarsesion.contrasena != ""){
                                if(this.errorcontrasena != "")
                                {
                                    this.errorcontrasena = "";
                                    this.classcontrasena = "";
                                }
                            }
                            if(input.registrame.tab1.usuario_two != "")
                            {
                                if(this.errorusuario_two != "")
                                {
                                    this.errorusuario_two = "";
                                    this.classusuario_two = "";
                                }
                            }
                            if(input.registrame.tab1.contrasena_two != "")
                            {
                                if(this.errorcontrasena_two != "")
                                {
                                    this.errorcontrasena_two = "";
                                    this.classcontrasena_two = "";
                                }
                            }
                           
                            if(input.registrame.tab2.documento != ""){
                                
                                 if(this.errordocumento != "")
                                {
                                    this.errordocumento = "";
                                    this.classdocumento = "";
                                }
                            }
                            if(input.registrame.tab2.tipodocumento != ""){
                                 if(this.errortipodocumento != "")
                                {
                                    this.errortipodocumento = "";
                                    this.classtipodocumento = "";
                                }
                            }
                            if(input.registrame.tab2.primer_nombre != "")                          
                            {
                                if(this.errorprimer_nombre != "")
                                {
                                    this.errorprimer_nombre = "";
                                    this.classprimer_nombre = "";
                                }
                            }
                            if(input.registrame.tab2.primer_apellido != "")                          
                            {
                                if(this.errorprimer_apellido != "")
                                {
                                    this.errorprimer_apellido = "";
                                    this.classprimer_apellido = "";
                                }
                            }
                            if(input.registrame.tab3.pais !== 0){
                                if(this.errorpais != "")
                                {
                                    this.errorpais = "";
                                    this.classpais = "";
                                }
                                this.ListarCidad(input.registrame.tab3.pais);
                            }
                            if(input.registrame.tab3.pais === 0){
                                    this.registrame.tab3.ciudad = 0;
                            }
                            if(input.registrame.tab3.pais !== 0){
                                if(this.errorciudad != "")
                                {
                                    this.errorciudad = "";
                                    this.classciudad = "";
                                }
                                this.ListarCidad(input.registrame.tab3.pais);
                            }
                            if(input.registrame.tab4.ensena_profesor !== ''){
                                if(this.errorensena_profesor != "")
                                {
                                    this.errorensena_profesor = "";
                                    this.classensena_profesor = "";
                                }
                                
                            }
                            if(input.registrame.tab5.video !== ''){
                                if(this.errorvideo != "")
                                {
                                    this.errorvideo = "";
                                }
                            }
                             if(input.registrame.tab6.ampliar_conocimiento !== ''){
                                if(this.errorampliar_conocimiento != "")
                                {
                                    this.errorampliar_conocimiento = "";
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
                                    this. classconfirmar_contrasena = "";
                                }
                            }
                        if(input.registrame.tab1.contrasena_two != input.registrame.tab1.confirmar_contrasena)
                        {
                            this. errorconfirmar_contrasena_true = "Las contraseñas ingresadas no coinciden, intente de nuevo...";
                        }else{
                            this. errorconfirmar_contrasena_true = "";
                            this. classconfirmar_contrasena_true = "";
                        }
                    }
                }
        },
        methods:{
            tabradio4(value){
                switch(value){
                    case 1:
                        this.registrame.tab4.ensena_profesor = 'En persona, informalmente';
                        this.inputr4 = Boolean(0);
                        this.borrar(this);
                        break;
                    case 2:
                            this.registrame.tab4.ensena_profesor='En persona, formalmente';
                            this.inputr4 = Boolean(0);
                            this.borrar(this);
                        break;
                    case 3:
                            this.registrame.tab4.ensena_profesor = 'En linea';
                            this.inputr4 = Boolean(0);
                            this.borrar(this);
                        break;
                    case 4:
                            this.registrame.tab4.ensena_profesor = '';
                            this.inputr4 = Boolean(1);
                            break;
                    default:
                        break;
                }
            },
            tabradio5(value){
                switch(value){
                    case 1:
                        this.registrame.tab5.video = 'Soy un principiante';
                        this.borrar(this);
                        break;
                    case 2:
                            this.registrame.tab5.video='Tengo algo de conocimiento';
                            this.borrar(this);
                        break;
                    case 3:
                            this.registrame.tab5.video = 'Tengo experiencia';
                            this.borrar(this);
                        break;
                    case 4:
                            this.registrame.tab5.video = 'Tengo videos para subir';
                            this.borrar(this);
                            break;
                    default:
                        break;
                }
            },
            tabradio6(value){
                switch(value){
                    case 1:
                        this.registrame.tab6.ampliar_conocimiento = 'No en este momento';
                        this.borrar(this);
                        break;
                    case 2:
                            this.registrame.tab6.ampliar_conocimiento='Tengo un pequeno seguimiento';
                            this.borrar(this);
                        break;
                    case 3:
                            this.registrame.tab6.ampliar_conocimiento = 'Tengo un seguimiento considerable';
                            this.borrar(this);
                        break;
                    default:
                        break;
                }
            },
            validarRegistro(){
                // validar los campos que esten en 0 para no registrarlo. 
                // combobox 1
                let me = this;
                let enviar = Boolean(1);
                if(this.registrame.tab6.ampliar_conocimiento === '')
                {
                    this.errorampliar_conocimiento = "Ingresa que sunas tienes.";
                    enviar = Boolean(0);
                }
                // validar input checked 
                if(enviar){
                    // alert('Listo para guardar todo esta en orden');
                    this.registrarUsuario();
                }
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
                      me.tabindex = next;
                  }
              }
            },
            verificar_state(value){
                let me = this;
                 if(value === 1)
                {
                    if(me.registrame.tab1.usuario_two===''){
                        this.classusuario_two = "is-invalid";
                        this.errorusuario_two = "Ingresa tu usuario";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.usuario_two!==''){
                        let strings = me.registrame.tab1.usuario_two;
                        const validate = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        let response =  validate.test(strings);
                        if(!response){
                            this.classusuario_two = "is-invalid";
                            this.errorusuario_two ="El correo no es valido vuelva a intentarlo";
                            return Boolean(0);
                        }
                    }
                    if(me.registrame.tab1.contrasena_two===''){
                        this.classcontrasena_two = "is-invalid";
                        this.errorcontrasena_two = "Ingresa tu contraseña";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.confirmar_contrasena===''){
                        this.classconfirmar_contrasena = "is-invalid";
                        this.errorconfirmar_contrasena = "confirma tu contraseña";
                        return Boolean(0);
                    }
                    if(me.registrame.tab1.contrasena_two!==''){
                        let count = me.registrame.tab1.contrasena_two.length;
                        if(count<8)
                        {
                            this.classcontrasena_two = "is-invalid";
                            this.errorcontrasena_two ="Debes ingresar una contraseña mayor o igual a 8 caracteres.";
                            return Boolean(0);
                        }else{
                            let strings = me.registrame.tab1.contrasena_two;
                            let validate = /^(?=.*\d)(?=.*[!@#.$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                            let response =  validate.test(strings); 
                            if(!response){
                                this.classcontrasena_two = "is-invalid";
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
                    if(me.registrame.tab2.documento===''){
                        this.classdocumento = "is-invalid";
                            this.errordocumento = "Ingrese numero de documento";
                            return Boolean(0);
                    }else if(!Number(me.registrame.tab2.documento))
                         {
                             this.classdocumento = "is-invalid";
                           this.errordocumento = "los datos ingresados no es un numero";
                           return Boolean(0);
                        }
                     else if(me.registrame.tab2.tipodocumento===''){
                         this.classtipodocumento = "is-invalid";
                        this.errortipodocumento = "Ingrese tipo de docimento";
                        return Boolean(0);
                    }else if(me.registrame.tab2.primer_nombre==='')
                    {
                        this.classprimer_nombre = "is-invalid";
                        this.errorprimer_nombre = "Ingrese primer nombre";
                        return Boolean(0);
                    }
                    else if(me.registrame.tab2.primer_apellido==='')
                    {
                        this.classprimer_apellido = "is-invalid";
                        this.errorprimer_apellido = "Ingrese primer apellido";
                        return Boolean(0);
                    }else{
                        this.ListarPais();
                        return Boolean(1);
                    }
                }else if(value===3){
                    if(me.registrame.tab3.pais===0){
                        this.classpais = "is-invalid";
                        this.errorpais = "Ingresa pais donde te encuentras";
                        return Boolean(0);
                    }else if(me.registrame.tab3.ciudad===0){
                        this.classciudad = "is-invalid";
                        this.errorciudad = "Ingresa ciudad donde te encuentras";
                        return Boolean(0);
                    }else{
                        this.listarProfesiones();
                        return Boolean(1);
                    }
                }else if(value === 4){
                    if(me.registrame.tab4.ensena_profesor===''){
                        this.errorensena_profesor = "Ingresa la enseñanza que haz hecho";
                        this.classensena_profesor = "is-invalid";
                        return Boolean(0);
                    }else{
                        return Boolean(1);
                    }
                }else if(value===5){
                    if(me.registrame.tab5.video===''){
                        this.errorvideo = 'Ingresa que nivel tienes';
                        return Boolean(0);
                    }else{
                        return Boolean(1);
                    }
                }
            },
            ListarPais(){
                 let me = this;
                let url = "/pais";
                    axios.get(url).then(function (response) {
                        let result = response.data;
                        // console.log(result);
                        me.ListasPaises = result.paises;
                    }).catch(function(error){
                        console.log(error);
                    });
            },
            ListarCidad(pais){
                 let me = this;
                let url = "/ciudad?pais="+pais;
                    axios.get(url).then(function (response) {
                        let result = response.data;
                        // console.log(result);
                        me.ListasCiudades = result.ciudades;
                    }).catch(function(error){
                        console.log(error);
                    });
            },
            listarProfesiones(){
                let me = this;
                let url = "/profesion";
                    axios.get(url).then(function (response) {
                        let result = response.data;
                        // console.log(result);
                        me.ListarProfesiones = result.profesion;
                    }).catch(function(error){
                        console.log(error);
                    });
            },
            back(before){
                this.tabindex = before;
            },
            cambiar(sw){
                this.sw = sw;
            },
            showCreateClientForm(sw){
                $('#modal-edit-client').modal('show');
            },
            verificar(){
                if(localStorage.getItem('rutaCompra')===null || localStorage.getItem('rutaCompra')===undefined){
                }else{
                   localStorage.removeItem('rutaCompra');
               }
            },
            iniciarSeccion(){
                let me = this;
                me.button_view = Boolean(1);
                // validacion de input
                if(me.inicarsesion.usuario===""){
                    me.errorusuario = "Ingrese el usuario";
                }
                if(me.inicarsesion.contrasena===""){
                    me.errorcontrasena = "Ingrese la contraseña";
                }
                if(me.inicarsesion.usuario != "" && me.inicarsesion.contrasena != ""){
                    // validacion correcta procedemos a enviar los datos
                     axios.post('/login',{
                    'usuario': me.inicarsesion.usuario,
                    'contrasena': me.inicarsesion.contrasena,
                    }).then(function (response) {
                        let result = response.data + "/";
                        
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
                                // url por defecto
                                window.location.href=result;
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
                axios.post('/instuctores/registrar',{
                    // datos de usuarios
                    'usuario': me.registrame.tab1.usuario_two,
                    'contrasena': me.registrame.tab1.contrasena_two,
                    // información de la persona
                    'documento':me.registrame.tab2.documento,
                    'tipo_documento':me.registrame.tab2.tipodocumento,
                    'primer_nombre':  me.registrame.tab2.primer_nombre,
                    'segundo_nombre': me.registrame.tab2.segundo_nombre,
                    'primer_apellido': me.registrame.tab2.primer_apellido,
                    'segundo_apellido': me.registrame.tab2.segundo_apellido,
                    'ciudad':me.registrame.tab3.ciudad,
                    'ensena_profe':me.registrame.tab4.ensena_profesor,
                    'video':me.registrame.tab5.video,
                    'ampliar_conoci':me.registrame.tab6.ampliar_conocimiento,
                    
                }).then(function (data) {
                    // console.log(response);
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
