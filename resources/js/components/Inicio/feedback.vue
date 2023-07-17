<template>
<div>
<div class="feedback" @click="feedback">
    <p>Soporte</p>
</div>
<div class="modal fade feedback-modal" id="Feedback" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><strong>Soporte D-Academy.co</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row center" style="padding-left:10px;">
              <p v-if="sw==0" class="col-md-12 col-sm-12" style="padding:10px;text-align:center;font-size:20px;margin-top:20px;"><strong>Bienvenido al centro de soporte y ayuda</strong> </p>
        <p v-if="sw==0" class="col-md-12 col-sm-12" style="text-align:center;padding-left:35px;padding-right:35px;margin-top:-20px;">Por favor, elige la opción que mas se acomode a tu necesidad. </p>
        <p v-if="sw==1" class="col-md-12 col-sm-12" style="padding:10px;text-align:center;font-size:20px;margin-top:20px;"><strong>{{this.optionSoporte}}</strong> </p>
        <p v-if="sw==1" class="col-md-12 col-sm-12" style="text-align:justify;padding-left:35px;padding-right:35px;margin-top:-20px;" v-html="this.descripcionSoporte"> </p>
        <template v-if="sw==0">
            <div class="col-md-4 col-sm-12" style="padding:20px;">
            <button @click="opcion(1)" class="btn-feedback-primary"><i style="font-size:20px;margin-right:10px;" class="fas fa-headset"></i> Soporte Técnico</button>
        </div>
         <div class="col-md-4 col-sm-12" style="padding:20px;">
            <button @click="opcion(2)" class="btn-feedback-primary"><i style="font-size:20px;margin-right:10px;" class="fas fa-exclamation-circle"></i> Reportar Problema</button>
        </div>
         <div class="col-md-4 col-sm-12" style="padding:20px;">
            <button @click="opcion(3)" class="btn-feedback-primary"><i style="font-size:20px;margin-right:10px;" class="fas fa-envelope"></i> Sugerencia</button>
        </div>
        </template>
        <template  v-if="sw==1">
            <div class="col-md-12 col-sm-12" style="padding:20px;">
            <input type="text" :class="'form-control spacing-input '+this.error.nombre" @input="borrarNombre" v-model="user.nombre" placeholder="Escribe tu nombre completo Ej: Juan Carlos">
            <input type="text" :class="'form-control spacing-input '+this.error.correo" @input="borrarCorreo" v-model="user.correo" placeholder="Escribe tu correo eléctronico Ej: jcarlos@gmail.com">
            <textarea v-model="user.asunto" :class="'form-control '+this.error.asunto" @input="borrarAsunto" cols="30" rows="10" :placeholder="asunto"></textarea>
        </div>
        </template>
        <template v-if="sw==2">
            <div class="col-md-12 col-sm-12 center" style="padding:20px;">
                <br>
            <img src="/img/cargando/cargar.gif" style="width:80px; height:80px;" alt="">
            <h2>Enviando mensaje...</h2>
            <p>Porfavor, Espere</p>
            </div>
        </template>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button"  @click="Cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button v-if="sw==1" @click="back" type="button" class="btn btn-secondary">Volver</button>
        <button v-if="sw==1" type="button" @click="enviarTicket" class="btn btn-primary">Enviar</button>
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
    data(){
        return{
            user:{
                nombre:"",
                correo:"",
                asunto:"",
            },
            error:{
                nombre:"",
                correo:"",
                asunto:"",
            },
            opt:0,
            sw:0,
            asunto:'',
            optionSoporte:'',
            descripcionSoporte:'',
        }
    },
    computed:{
        borrarNombre:function(){
            let _this = this;
            if(_this.user.nombre!=="")
            {
                _this.error.nombre="";
            }
        },
        borrarCorreo:function(){
            let _this = this;
            if(_this.user.correo!=="")
            {
                _this.error.correo="";
            }
        },
        borrarAsunto:function(){
            let _this = this;
            if(_this.user.asunto!=="")
            {
                _this.error.asunto="";
            }
        }
    },
    methods:{
        feedback: function(){
            $('#Feedback').modal('show');
        },
        opcion: function(option){
            let _this = this;
            _this.opt = option;
            _this.sw = 1;
            if(option===1){
                _this.optionSoporte = "SOPORTE TÉCNICO";
                _this.descripcionSoporte = "Apreciado usuario gracias por contactarnos, nuestros agentes de soporte técnico se contactará con usted por medio del <strong>correo eléctronico</strong>,  si el correo no aparece en <strong>bandeja de entrada</strong> tambien lo puedes buscar en <strong>correo no deseado o spam</strong>.";
                _this.asunto = "¿En que te podemos ayudar?";
            }else if(option===2){
                _this.optionSoporte = "REPORTAR PROBLEMA";
                _this.descripcionSoporte = "Apreciado usuario al reportar tu problema con el sistema, se creará un ticket para resolver tu situación. Te contactaremos por medio del correo eléctronico, esta aténto a el correo, si el correo no aparece en <strong>bandeja de entrada</strong> tambien lo puedes buscar en <strong>correo no deseado o spam</strong>. ";
                _this.asunto = "¿Que problema tienes para ayudarte?";
            }else if(option===3){
                _this.optionSoporte = "SUGERENCIAS";
                _this.descripcionSoporte = "Apreciado usuario queremos prestarle un buen servicio, por lo tanto, necesitamos que nos ayudes a mejorar para que tu experiencia en <strong>D-Academy</strong> sea la mejor.";
                _this.asunto = "Danos tu opnion y ayudanos a mejorar.";
            }
        },
        back: function(){
            let _this = this;
            _this.sw=0;
        },
        Cerrar: function(){
            let _this = this;
            _this.user.nombre="";
            _this.user.correo = "";
            _this.user.asunto = "";
            _this.error.nombre="";
            _this.error.correo="";
            _this.error.asunto="";
            _this.sw =0;
        },
        validarinputempty(){
            let _this = this;
            if(_this.user.nombre==="")
            {
                _this.error.nombre = "is-invalid";
                return false;
            }else if(_this.user.correo==="")
            {
                _this.error.correo = "is-invalid";
                return false;
            }else if(_this.user.asunto ===""){
                _this.error.asunto = "is-invalid";
                return false;
            }
            return true;
        },
        enviarTicket: async function(){
            let _this = this;
            if(_this.validarinputempty()){
            _this.sw = 2;
            let fecha = new Date();
            let sec = fecha.getSeconds();
            let dia = fecha.getDate();
            let mes = fecha.getMonth()+1;
            let hora = fecha.getHours();
            let min = fecha.getMinutes();
            if(min<9){min = "0"+min.toString();}
            if(mes<9){mes = "0"+mes.toString();}
            if(dia<9){dia = "0"+dia.toString();}
            if(hora<9){hora = "0"+hora.toString();}
            if(sec<9){sec = "0"+sec.toString();}
            let url = '/feedback?nombre='+_this.user.nombre
            +'&correo='+_this.user.correo
            +'&asunto='+_this.user.asunto
            +'&feedback='+_this.opt;
            // codigo consta de segundos+dia+mes+hora+minutos result => 3503101021
            if(_this.opt===1)
            {
                let codigo = "ST-"+sec.toString()+dia.toString()+mes.toString()+hora.toString()+min.toString();
                url += '&codSoporte='+codigo;
            }else if(_this.opt===2){
                let codigo = "RP-"+sec.toString()+dia.toString()+mes.toString()+hora.toString()+min.toString();
                url += '&codSoporte='+codigo;
            }
            // console.log(codigo);
            await axios.get(url).then(function(response){
                _this.sw = 1;
                const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                icon: 'success',
                title: response.data.response
                })
                _this.user.nombre = "";
                _this.user.correo = "";
                _this.user.asunto = "";
            }).catch(function(error){
                Swal.fire({
                    icon: 'error',
                    title:'Información D-Academy',
                    text:error
                })
            });
            }
           
        },
    },
    mounted: function(){
    }
}
</script>