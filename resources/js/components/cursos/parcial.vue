<template>
    <div class="row content-parcial" >
            <div class="col-md-12 col-sm-12 hoja_de_word" v-if="ver">
                <div class="row">
                    <div class="col-md-12" style="text-align:right;">
                        Tiempo Estimado: {{this.timerestimado}}
                        <strong>- Tiempo: {{this.formattedTimer}}</strong>
                    </div>
                </div>
                <div class="row" v-for="(itemp, indexp) in lista" :key="indexp">
                    
                    <div class="col-md-12 col-sm-12 text-centrado font-18px" style="margin-bottom:80px;">
                        <strong> D-Academy -
                        Parcial Final</strong>
                        
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 font-18px text-capitalize" v-for="(estu, indexest) in itemp.estudiante" :key="indexest">
                                <strong>Nombre:</strong> <span style="padding-left:15px; padding-right:15px;">
                                    <span style="margin-left:20px;" >{{estu.primer_nombre}}</span>
                                    <span style="margin-left:20px;" v-if="estu.segundo_nombre">{{estu.segundo_nombre}}</span>
                                    <span style="margin-left:20px;">{{estu.primer_apellido}}</span>
                                    <span style="margin-left:20px;" v-if="estu.segundo_apellido">{{estu.segundo_apellido}}</span>
                                    </span>  <br>
                                <strong>Identificacion:</strong><span style="padding-left:15px; padding-right:15px;">{{estu.n_documento}}</span>
                            </div>
                             <div class="col-md-6 font-18px text-capitalize" v-for="(profe, indexpro) in itemp.Profesor" :key="indexpro">
                                 <strong>Curso:</strong><span style="padding-left:15px; padding-right:15px;">{{cursoName}}</span> <br>
                                 <strong>instructor: </strong>
                                 <span style="padding-left:15px; padding-right:15px;">
                                     <span >{{profe.primer_nombre}}</span>
                                     <span v-if="profe.segundo_nombre">{{profe.segundo_nombre}}</span>
                                     <span>{{profe.primer_apellido}}</span>
                                     <span v-if="profe.segundo_apellido">{{profe.segundo_apellido}}</span>
                                </span>
                            </div>
                             <div class="col-md-12 text-justificado" >
                                 <br>
                                 <p><strong>Introducción</strong></p>
                                 {{intro_parcial}}
                                 
                            </div>
                            <div class="col-md-12 text-centrado" >
                                <br>
                                 <strong>Resuelve las siguientes preguntas.</strong>
                                 <br>
                                 <br>
                            </div>
                            <form name="frmparcial">
                                <div class="col-md-12 text-derecha"  v-for="(items, index) in itemp.contenido" :key="index">
                                    <p><strong>{{items.title}}</strong> </p>
                                    <span v-for="(item, indexs) in items.listData" :key="indexs" >
                                    
                                        <input type="radio"  :name="'input'+index" :id="item.id" :value="item.valor">
                                        <label :for="item.id" style="font-weight: normal !important;">{{item.respuesta}}</label>
                                        <br>
                                    </span>
                                    <br>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12" v-if="ver">
                <button style="margin-top:50px; float:right; position:relative; cursor:pointer" @click="notas();">Enviar Respuesta</button>
            </div>
            <div v-if="!ver" class="col-md-12">
                <div>
                    <p>
                        {{this.text}}
                    </p>
                    <p>
                        <button @click="salir();">Volver</button>
                    </p>
                </div>
                
            </div>
            
       
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['curso','person'],
    data(){
        return{
            ver:'',
            lista:[],
            intro_parcial:'',
            formattedTimer:'00:00:00',
            currentTimer:0,
            ticker:String.isNullOrEmpty,
            timerestimado:'00:01:00',
            parcialfinals:'',
            material_apoyo:'',
            objetivo:'',
            idcurso:'',
            bloqueado:Boolean(0),
            text:'',
            parcial:'',
            cursoName:'',
        }
    },
    computed:{},
    mounted(){
        this.listarParcial();
    },
    methods:{
        listarParcial(){
                let me = this;
                let url = '/parcial?curso='+me.curso+'&estudiante='+me.person;
                axios.get(url).then(
                    function (response){
                         console.log(response.data);
                        let dataitem = response.data;
                        me.lista = dataitem.arrayparcial;
                        me.parcial = dataitem.arrayparcial[0].parcial;
                        me.timerestimado = dataitem.arrayparcial[0].time;
                        me.cursoName = dataitem.arrayparcial[0].CursoName;
                        me.intro_parcial = dataitem.arrayparcial[0].introParcial;
                        let curso = localStorage.getItem('curso_' + me.person);
                        me.idcurso = dataitem.arrayparcial[0].curso;
                        if(localStorage.getItem('ver')===String(1) && curso  === String(me.idcurso))
                      {
                           let hoy = new Date();
                           let fecha = new Date(localStorage.getItem('fecha'));
                           let verificar = fecha.getTime()- hoy.getTime();
                           let horastranscurrida = verificar / 1000 / 60 / 60;
                           let faltan = Math.round(horastranscurrida);
                           let msjfaltan = '';
                           if(faltan>0)
                           { 
                               if(faltan ===1)
                                {
                                    msjfaltan = "Ya te falta poco: "+faltan +" hora,";
                                }else{
                                     msjfaltan = "Te faltan: "+faltan +" horas.";
                                }
                           }
                          if(horastranscurrida <=0)
                          {
                              me.ver = Boolean(1);
                              me.iniciarconteo();
                              localStorage.removeItem('curso_'+me.person);
                              localStorage.removeItem('ver'); 
                              localStorage.removeItem('fecha'); 
                          }
                          else
                          {
                              me.ver = Boolean(0);
                              me.text = 'El Examen puede hacerce dentro de 12 horas, espere el tiempo asignado por favor!!! \n'+ msjfaltan;
                          }
                      }else{
                          me.ver = Boolean(1);
                          me.iniciarconteo();
                      }
                    }
                ).catch(function(error){
                    console.log(error);
                });
        },
        notas(){
            let _this = this;
            let sumatoria = 0;
            let listaCont = _this.lista;
            let countListparcial = listaCont[0].contenido.length;
            var i =0; var j=0;
            for(i =0; i < countListparcial; i++){
                let countListparcialItem = listaCont[0].contenido[i].listData.length;
                 let input = 'input'+ String(i);
                 let inputs = document.getElementsByName(input);
                for(j=0; j<countListparcialItem; j++){
                    if(inputs[j].checked)
                    {
                        sumatoria = sumatoria + parseFloat(inputs[j].value);
                    }
                }
            }
            if(sumatoria<3){
                _this.Message('Lo sentimos haz perdido tu parcial final con una nota de:'+sumatoria,'error');
                localStorage.setItem('ver',1);
                localStorage.removeItem('timers'+_this.person+'_'+_this.idcurso);
                let hoy = new Date();
                let mañana = new Date(hoy.getTime() + 1000 * 60 * 60 * 12);
                localStorage.setItem('curso_'+_this.person, _this.idcurso);
                localStorage.setItem('fecha', mañana); 
                _this.listarParcial();
            }
            else if(sumatoria>=3)
            {
                _this.enviarrespuesta(sumatoria);
                _this.detener(true);
            }
        },
        enviarrespuesta(notafinal){
            let me = this;
            axios.post('/notas/registrar',{
                    'nota': notafinal,
                    'parcial': me.parcial,
                    'estudiante': me.person,
                    'curso':me.idcurso,
                    'vparcial':true
                }).then(function (response) {
                    var respuesta = response.data;
                    localStorage.removeItem('timers'+me.person+'_'+me.idcurso);
                     me.Message(response.guardado,'success');
                    // me.iniciarcurso();
                }).catch(function (error) {
                    me.Message(error,'error');
                    // console.log(error);
                });
        },
        Message(textMessage, iconMessage){
            const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                title: 'D - Academy Información',text:textMessage,
                type: 'warning',showCancelButton: false,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: 'OK',
                cancelButtonText: 'Cerrar',confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true, icon:iconMessage
                }).then(function(){
                    if(iconMessage=="success")
                    {
                        window.location.href = '/certificados';
                    }
                    
                })
        },
        iniciarconteo(){
           let valor = 0;
           let newmin =0;
           let _this = this;
           if(localStorage.getItem('timers'+_this.person+'_'+_this.idcurso))
           {
                let min = localStorage.getItem('timers'+_this.person+'_'+_this.idcurso).substring(5,3);
                let seg = localStorage.getItem('timers'+_this.person+'_'+_this.idcurso).substring(8,6);
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
            //    alert(localStorage.getItem('timers'));
           }
           _this.tick(valor);
       },
       tick(valor){
           let _this = this;
            _this.ticker = setInterval(()=>{
                if(valor>0)
                {
                    _this.currentTimer = valor; 
                    valor = 0; 
                }
                _this.currentTimer++;
                _this.formattedTimer = _this.formatTime(
                        _this.currentTimer
                    );
            }, 1000)
       },
       formatTime(seconds){
           let datenew = new Date(null);
           let me = this;
           datenew.setSeconds(seconds);
           let responsedate = datenew.toISOString().substring(19, 11);
           if(responsedate >= me.timerestimado)
           {
                let md = Boolean(0);
                return responsedate = me.detener(md);
           }else{
               localStorage.setItem('timers'+me.person+'_'+me.idcurso,responsedate);
               return responsedate;
           }
       },
       detener(md){
           window.clearInterval(this.ticker);
           this.currentTimer = 0;
           this.enviarRespuesta = md;
           if(!md){
            //    this.formattedTimer = '00:00:00';
               this.notas();
               return '00:00:00';
           }
       },
       salir(){
           window.location.href = '/clase/virtual/'+ this.curso;
       }
    }
}
</script>