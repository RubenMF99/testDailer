<template>
    <div class="row recuperar">
        <div class="col-md-4 center">

        </div>
        <div class="col-md-4 text-justificado cuadro-recuperar center">
             <template v-if="paso===1">
            <h3 > <strong>Primero:</strong> Vamos a buscar tu cuenta.</h3>
            <p >Introduce tu direccion de correo electronico</p>
            <input v-model="correo" type="text" @input="borrar(this)" v-on:keyup.enter="tab(2)" placeholder="Escribe aqui tu correo electronico" style="width:100%;margin-bottom:12px;">
            <p style="color:red;" v-html="errorCorreo"></p>
            
            <button  @click="tab(2)">Confirmar</button>
            </template>
            <template v-if="paso===2">
                <h3> <strong>Segundo: </strong>Escoge una opcion.</h3>
                <p>¿{{this.usuario.nombre+ " "  +this.usuario.apellido}}  En donde quieres que te enviemos el codigo?</p>
                <p class="text-derecha"><input type="radio" name="enviar" id="check1" v-model="enviarpor" @click="otro(0)" :value="correo"><label for="check1">Correo: {{this.correo}}</label> </p>
                <p class="text-derecha"><input type="radio" name="enviar" id="check2"   @click="otro(1)" ><label for="check2">Otro</label> </p>
                <p ><input type="text" v-model="enviarpor" placeholder="Correo Electronico" style="width:90%;margin-bottom:12px;" v-if="viewinput"></p> 
                <br>
            <button class="center" @click="tab(3)" v-if="!btnEnv">Enviar Codigo</button>
            <button class="center" v-else>Enviando Codigo...</button>
            </template>
            <template v-if="paso===3">
                <h3 class="text-derecha"> <strong>Tercero:</strong> Escribe el codigo.</h3>
                <p class="text-derecha">Escribe aqui el codigo que te enviamos al correo.</p>
                <p ><strong style="font-size:25px;">DA- </strong><input type="text" @input="borrar(this);" placeholder="Codigo" style="width:70%;margin-bottom:12px;" v-model="codigo"></p>    
                <p style="color:red;" v-html="errorcodigo"></p>   
                <p id="clock"> <span v-text="mensaje_tiempo"></span>  <strong> <span v-text="clock"></span></strong></p> 
                <br>
            <button class="center" @click="tab(4)">Listo</button>
            </template>
              <template v-if="paso===4">
                <h3 class="text-derecha"> <strong>Cuarto:</strong> Cambiar contraseña.</h3>
                <p class="text-derecha">La contraseña debe contener minimo: <br> un numero, caracter (*.,) y letra.</p>
                <p class="text-derecha">¡Por favor escribe una contraseña y copiala para que no se te olvide!</p>
                <p><input type="password" v-model="contra1" @input="borrar(this);" placeholder="Contraseña" style="width:90%;margin-bottom:12px;"></p>  
                <p><input type="password" v-model="contra2" @input="confirmar(this);" placeholder="Confirmar contraseña" style="width:90%;margin-bottom:12px;"></p>      
                <p style="color:red;" v-html="errorPassword"></p>
                <br>
            <button class="center" @click="guardar" >Guardar</button>
            </template>
        </div>
          <div class="col-md-4 center">

        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:["ruta"],
    data(){
        return{
            paso:1,
            timer:'',
            mensaje_tiempo:'Tiempo de espera:',
            clock:'(05:00)',
            correo:'',
            errorCorreo:'',
            errorPassword:'',
            errorcontra1:'',
            errorcontra2:'',
            errorcodigo:'',
            vacio:'',
            usuario:{
                nombre:'',
                apellido:'',
                id_person:'',
            },
            enviarpor:'',
            viewinput:Boolean(0),
            codigo:'',contra1:'',contra2:'',
            btnEnv:Boolean(0),
        }
    },
    computed:{
        borrar(input){
            return function(){
                if(input.correo != ''){
                     if(this.errorCorreo !="")
                    {
                        this.errorCorreo = "";
                    }
                }
                if(input.contra1 != ""){
                    if(this.errorcontra1!=""){
                        this.errorcontra1 ="";
                    }
                    if(this.errorPassword!=""){
                        this.errorPassword ="";
                    }
                }
                if(input.codigo != ""){
                    if(this.errorcodigo!=""){
                        this.errorcodigo ="";
                    }
                }
            }
        },
        confirmar(input){
                    return function(){
                        if(input.contra2 != "")
                            {
                                if(this. errorcontra2 != "")
                                {
                                    this. errorcontra2 = "";
                                }
                            }
                        if(input.contra1 != input.contra2)
                        {
                            this.errorPassword = "Las contraseñas ingresadas no coinciden, intente de nuevo...";
                        }else{
                            this. errorPassword = "";
                        }
                    }
                },
        
    },
    methods:{
        otro(value){
            if(value===1){
                this.enviarpor = '';
            }
            this.viewinput = Boolean(value);
        },
        validarInput(){
            let me = this;
             if(me.contra1 !== me.contra2)
            {
                me.errorPassword = "Las contraseñas ingresadas no coinciden, intente de nuevo...";
            }
            if(me.errorPassword==="")
            {
                let strings = me.contra2;
                if(strings.length>=8)
                {
                    const validate =/^(?=.*\d)(?=.*[!@#.$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                let response =  validate.test(strings);
                if(!response){
                    me.errorPassword ="La contraseña minimo de contener 1 letra MAYUSCULA, un NUMERO y un CARACTER";
                    return Boolean(0);
                }else{
                    return Boolean(1);
                }
                }else{
                    me.errorPassword ="La contraseña debe ser mayor o igual a 8 caracteres";
                    return Boolean(0);
                }
                
            }
            
        },
         MensajeAlert(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage,url)
        {
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                }).then((result) => {
                    if(iconsMessage==="success"){
                        window.location.href = "/";
                    }
                });
        },
        guardar(){
            let me = this;

            if(me.validarInput())
            {
                let url = "/cambiarcontra";
                axios.post(url,{
                    'usuario_id':me.usuario.id_person,
                    'password': me.contra1
                }).then(function(data){
                    let respuesta = data.data;
                     me.MensajeAlert('D - Academy Información',respuesta.result,'warning',false,'Ok', '','success');
                }).catch(function(error){
                    me.MensajeAlert('D - Academy Información',error,'warning',false,'Ok', '','error');
                });
            }
       
        },
        backItems(value){
            let me = this;
            let codigo = localStorage.getItem("codigo"+me.usuario.id_person);
            if(codigo === undefined || codigo === null || codigo === ''){
                 me.paso=value;
            }else{
                me.paso=3;
                me.time();
            }
        },
        verificarcorreo(value){
            let me = this;
            let url = "/correo?correo="+me.correo+"&recuperar=1";
             axios.get(url).then(function(data){
                 let result = data.data;
                 if(result.state===1)
                 {
                     me.errorCorreo = "El correo <strong>"+me.correo+"</strong> ingresado no es valido intente de nuevo...";
                 }else{
                     me.usuario.id_person = result.Rdatos[0].id;
                     me.usuario.nombre = result.Rdatos[0].primer_nombre;
                     me.usuario.apellido = result.Rdatos[0].primer_apellido;
                    me.backItems(value);
                 }
             }).catch(function (error) {
                 console.log(error);
             });
        },
        tab(value){
            let me = this;
            if(value === 2){
                me.verificarcorreo(value);
                
            }else if(value === 3){
                me.btnEnv = Boolean(1);
                me.enviarMail(value);
            }else if(value === 4){
                 me.verificarCodigo();
            }
        },
        time(){
            let me = this;
                let min = 5;
                let seg =0;
                let before_num1 ="",before_num2 ="";
               me.timer= setInterval(function(){
                    if(seg===0){
                        if(min === 0){
                                clearInterval(timer);
                                localStorage.removeItem("codigo"+me.usuario.id_person);
                                me.paso=1;
                        }else{
                                seg = 60;
                                min = min-1;
                                seg = seg-1;
                                before_num1 ="",before_num2="";
                                if(min <= 9)
                                {
                                   before_num1 = "0"; 
                                }
                                 if(seg <= 9)
                                {
                                   before_num2 = "0"; 
                                }
                                me.clock = "("+before_num1+min+":"+before_num2+seg+")";
                        }
                    }else{
                        seg = seg -1;
                        before_num1 ="",before_num2="";
                        if(min <= 9)
                        {
                            before_num1 = "0"; 
                        }
                        if(seg <= 9)
                        {
                            before_num2 = "0"; 
                        }
                         me.clock = "("+before_num1+min+":"+before_num2+seg+")";
                        if(min ===0 && seg <= 5)
                        {
                            me.mensaje_tiempo = "El tiempo se esta agotando";
                            $("#clock").css("color","red");
                        }
                    }
                }, 1000);
        },
        verificarCodigo(){
            let me = this;
            clearInterval(me.timer);
            $("#clock").css("color","#808080");
            let codigo = localStorage.getItem("codigo"+me.usuario.id_person);
            let codigoUsuario = me.codigo.toString();
            if(codigo = codigoUsuario){
                localStorage.removeItem("codigo"+me.usuario.id_person);
                me.paso=4;
            }else{
                me.errorcodigo = "El codigo ingresado no coincide con el que le enviamos al correo";
            }
        },
        enviarMail(value){
            let me = this;
            let fecha = new Date();
            let usuario = me.usuario.nombre+" "+ me.usuario.apellido;
            let mes = "", dia ="", hora ="", seg="",min="";
            dia = fecha.getDate().toString();
            hora = fecha.getHours();
            mes = (fecha.getMonth()+1).toString();
            seg = fecha.getSeconds().toString();
            min = fecha.getMinutes().toString();
            if(fecha.getDate()<=9){dia = "0"+fecha.getDate();}if(fecha.getMonth()<=9){mes = "0"+(fecha.getMonth()+1);}
             if(fecha.getSeconds()<=9){seg = "0"+fecha.getSeconds();}if(fecha.getMinutes()<=9){min = "0"+fecha.getMinutes();}
            let codigo = "DA-"+dia+hora+mes+seg+min;
            let codigoO = dia+hora+mes+seg+min;
            localStorage.setItem("codigo"+me.usuario.id_person, codigoO);
            let url = "/enviarcorreo";
             axios.post(url,{
                    "correo":me.enviarpor,
                    "mensaje":codigo,
                    "usuario":usuario
                }).then(function(data){
                 let result = data.data;
                 me.btnEnv = Boolean(0);
                me.backItems(value);
                 console.log(result);
             }).catch(function (error) {
                //  console.log(error);
                 me.MensajeAlert('D - Academy Información',error,'warning',false,'Ok', '','error');
                 me.btnEnv = Boolean(0);
             });
        },
        
    },
    mounted(){
       
    }
}
</script>