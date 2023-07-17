<template>
    <div class="row" style="background:#ffffff;padding:30px;">
        <template v-if="sw===1">
            <div class="row">
                                <div class="col-md-4 espacio-input">
                                    <strong>Quiz del Modulo</strong> 
                                        <select :class="'form-control '+errorModulo " v-model="modulo" name="" id="">
                                            <option value="">Escoge el modulo</option>
                                            <option :value="item.id" v-for="(item, index) in listModQuiz" :key="index">{{item.nombre}}</option>
                                            
                                        </select> <br>
                                </div>
                                <div class="col-md-2 espacio-input">
                                        <p><br><strong>Duración:</strong> 
                                        </p>
                                </div>
                               <div class="col-md-2 espacio-input">
                                        <p>Hora(s): <br>
                                        <input type="text" v-model="hora" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                        </p>
                                </div>
                                <div class="col-md-2 espacio-input">
                                    <p>Minuto(s): <br>
                                        <input type="text" v-model="min" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                    </p>
                                </div>
                                <div class="col-md-2 espacio-input">
                                    <p>Segundo(s): <br>
                                        <input type="text" v-model="seg" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                    </p>
                                </div>
                                 <div class="col-md-12 espacio-input">
                                    <textarea :class="'form-control '+errorIntro" v-model="intro" placeholder="Introducción al Quiz" name="" id="" cols="30" rows="5"></textarea><br>
                                </div>
                                <div class="col-md-8 espacio-input">
                                        <input type="text" v-model="pregunta" name="" :class="'form-control '+errorPregunta" placeholder="Pregunta" id="">
                                </div>
                                <div class="col-md-4 espacio-input">
                                        <input type="text" v-model="valorPregunta" name="" :class="'form-control '+errorRespuesta" placeholder="Valor Pregunta" id="">
                                </div>
                                <div class="col-md-5 espacio-input">
                                      <br> <button class="style-btn-alert" @click="AgregarRespuesta" >Agregar Respuesta</button> 
                                </div>
                                <div class="col-md-5 espacio-input" >
                                          <br><button class="style-btn-error" @click="quitarRespuesta"> Remover Respuesta</button>
                                </div>
                               <div class="col-md-12 espacio-input" v-for="(item, index) in listResp" :key="index">
                                   <br>
                                   <div class="col-md-6">
                                       <input type="text" :name="item.nombre" class="form-control" placeholder="Respuesta" id="">
                                   </div>
                                   <div class="col-md-6">
                                       <select class="form-control" :name="item.value" id="">
                                           <option value="">Respuesta correcta o incorrecta</option>
                                           <option :value="valorPregunta">Correcta</option>
                                            <option :value="0">Incorrecta</option>
                                       </select>
                                         
                                   </div>
                                        <br>
                                      
                                </div>
                                  <div class="col-md-12 espacio-input center">
                                      <br> <button class="style-btn-guard" @click="agregarPreguresp" >Aplicar</button>
                                </div>
                                <div class="col-md-12 espacio-input">
                                   <br> <p class="text-derecha" style="background:rgba(0,0,0,0.2); padding:10px;"><strong>Lista de Preguntas</strong></p>
                                </div>
                                <div class="col-md-12" v-for="(item, index) in listPregunta" :key="index">
                                    <br>
                                    <div class="col-md-12">
                                         <div class="col-md-8">
                                        {{item.pregunta}}
                                    </div>
                                     <div class="col-md-2">
                                         <input style="width:100%;" type="text" v-model="item.valorPregunta" class="form-control" placeholder="1.0" id="">
                                    </div>
                                     <div class="col-md-2">
                                         Puntos
                                    </div>
                                    </div>
                                   
                                    <div class="col-md-1">#</div>
                                    <div class="col-md-5">Respuesta</div>
                                    <div class="col-md-6">Respuesta Correcta o incorrecta</div>
                                    <div style="margin-bottom:10px;" v-for="(items, indexs) in item.listRespuesta" :key="indexs">
                                            <div class="col-md-1">
                                               <strong>{{indexs + 1}}</strong> 
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" v-model="items.respuesta" class="form-control" placeholder="Respuesta" id="">
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" v-model="items.valor" id="">
                                                    <option  :value="item.valorPregunta">Correcta</option>
                                                        <option :value="0">Incorrecta</option>
                                                </select>
                                                    
                                            </div>
                                    </div>
                                     
                                   
                                </div>
                               
                                <div class="col-md-12 espacio-input center">
                                       <br> <button v-if="!viewInputQuiz" class="guardar" @click="guardar(0)">Guardar</button>
                                       <button v-else class="guardar">Guardando...</button>
                                       
                                </div>
             </div>
        </template>
        <template v-else-if="sw===2">
              <div class="row">
                                <div class="col-md-4 espacio-input">
                                    <strong>Examen final <br> equivale al ({{this.valor}}%)</strong> <br>
                                     <p><input type="text" v-model="valor" name="" style="width:50%;" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id=""></p>  
                                </div>
                                <div class="col-md-2 espacio-input">
                                        <p><br><strong>Duración:</strong> 
                                        </p>
                                </div>
                               <div class="col-md-2 espacio-input">
                                        <p>Hora(s): <br>
                                        <input type="text" v-model="hora" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                        </p>
                                </div>
                                <div class="col-md-2 espacio-input">
                                    <p>Minuto(s): <br>
                                        <input type="text" v-model="min" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                    </p>
                                </div>
                                <div class="col-md-2 espacio-input">
                                    <p>Segundo(s): <br>
                                        <input type="text" v-model="seg" name="" :class="'form-control text-centrado '+errorDuracion " placeholder="00" id="">
                                    </p>
                                </div>
                                <div class="col-md-12 espacio-input">
                                   <br> <textarea :class="'form-control '+errorIntro" v-model="intro" placeholder="Introducción al parcial" name="" id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="col-md-8 espacio-input" style="margin-top:15px;">
                                        <input type="text" @input="borrar(1)" v-model="pregunta" name="" :class="'form-control '+errorPregunta" placeholder="Pregunta" id="">
                                </div>
                                <div class="col-md-4 espacio-input" style="margin-top:15px;">
                                        <input type="text" @input="borrar(2)" v-model="valorPregunta" name="" :class="'form-control '+errorRespuesta" placeholder="Valor Pregunta" id="">
                                </div>
                               <div class="col-md-12" style="background:rgba(0,0,0,0.2); padding:10px; margin-top:20px;">
                                   <div class="col-md-10">
                                       <p><strong>Respuesta de la pregunta: {{this.pregunta}}</strong></p>
                                   </div>
                                   <div class="col-md-1 ">
                                       <button class="style-btn-alert" @click="AgregarRespuesta" ><i class="fas fa-plus"></i></button> 
                                    </div>
                                    <div class="col-md-1 " >
                                          <button class="style-btn-error" @click="quitarRespuesta()"> <i class="fas fa-minus"></i></button>
                                    </div>
                                   
                               </div>
                               <div class="col-md-12 espacio-input" :id="item.nombre" v-for="(item, index) in listResp" :key="index">
                                   <br>
                                   <div class="col-md-1">
                                       <p><strong>{{index+1}}</strong></p>
                                   </div>
                                   <div class="col-md-7">
                                       <input type="text" :name="item.nombre" class="form-control" placeholder="Respuesta" >
                                   </div>
                                   <div class="col-md-4">
                                       <select class="form-control" :name="item.value" >
                                           <option value="">Respuesta correcta o incorrecta</option>
                                           <option :value="valorPregunta">Correcta</option>
                                            <option :value="0">Incorrecta</option>
                                       </select>
                                         
                                   </div>
                                    
                                        <br>
                                      
                                </div>
                                  <div class="col-md-12 espacio-input center">
                                      <br> <button class="style-btn-guard" @click="agregarPreguresp">Agregar Pregunta y Respuestas</button>
                                </div>
                                <div class="col-md-12 espacio-input">
                                   <br> <p class="text-derecha" style="background:rgba(0,0,0,0.2); padding:10px;"><strong>Lista de Preguntas</strong> <button style="float:right;" class="style-btn-error" @click="borrarTodo()"><i class="fas fa-times"></i></button></p>
                                </div>
                                <div class="col-md-12" v-for="(item, index) in listPregunta" :key="index">
                                    <br>
                                    <p><strong>{{item.pregunta+"  ("+ item.valorPregunta+" Puntos)"}}</strong></p>
                                    <div class="col-md-1">#</div>
                                    <div class="col-md-5">Respuesta</div>
                                    <div class="col-md-6">Respuesta Correcta o incorrecta</div>
                                    <div style="margin-bottom:10px;" v-for="(items, indexs) in item.listRespuesta" :key="indexs">
                                            <div class="col-md-1">
                                               <strong>{{indexs + 1}}</strong> 
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" v-model="items.respuesta" class="form-control" placeholder="Respuesta" id="">
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" v-model="items.valor" id="">
                                                    <option  :value="item.valorPregunta">Correcta</option>
                                                        <option :value="0">Incorrecta</option>
                                                </select>
                                                    
                                            </div>
                                    </div>
                                     
                                   
                                </div>
                               
                                <div class="col-md-12 espacio-input center">
                                       <br> <button v-if="!viewInputParcial" class="guardar" @click="guardar(1)">Guardar</button>
                                       <button v-else-if="viewInputParcial" class="guardar">Guardando...</button>

                                       
                                </div>
                            </div>

        </template>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['persona','sw','typeCurso'],
    data: function(){
        return{
            listResp:[{"nombre":"respuesta","value":"valor"}],
            listModQuiz:[],
            valor:40,
            listPregunta:[], 
            pregunta:'', 
            valorPregunta:'', 
            modulo:'', 
            intro:'',
            viewInputParcial:Boolean(0),
            viewInputQuiz:Boolean(0),
            min:'', seg:'',hora:'',
            errorModulo:'',
            errorDuracion:'',
            errorIntro:'',
            errorPregunta:'',
            errorRespuesta:'',
        }
    },
    computed:{

    },
    methods:{
        borrar: function(delete_input){
            let _this = this;
            switch(delete_input){
                case 1:
                        _this.errorPregunta = "";
                        break;
                case 2:
                        _this.errorPregunta = "";
                        break;
            }
        },
        borrarTodo: function(){
            let me =this;
            me.listPregunta = [];
        },
        AgregarRespuesta: function(){
            let me = this;
            let data = {"nombre":"respuesta","value":"valor"};
            me.listResp.push(data);
        },
        quitarRespuesta: function(){
            let me = this;
            me.listResp.splice(1,1);
        },
        agregarPreguresp: function(){
            let me = this;
            let pasar = Boolean(0);
            me.pregunta===''?me.errorPregunta = "is-invalid":(me.valorPregunta===''?me.errorRespuesta = "is-invalid":pasar = Boolean(1));
            if(pasar)
            {
                let listItems = [];
                let guardar = false;
                // recorrer los item de las preguntas
                for (let index = 0; index < me.listResp.length; index++) {
                    let element = document.getElementsByName("respuesta")[index].value;
                    let valor = document.getElementsByName("valor")[index].value;
                    let dataItem='';
                    element!==""||valor!==""? (dataItem = {"respuesta":element,"valor":valor}, listItems.push(dataItem)): '';
                }
                if(listItems.length>0){
                let data = {"pregunta":me.pregunta,"valorPregunta":me.valorPregunta,"listRespuesta":listItems};
                me.listPregunta.push(data);
                me.pregunta = '';
                me.valorPregunta = '';
                document.getElementsByName("respuesta")[0].value="";
                document.getElementsByName("valor")[0].value="";
                me.listResp = [];
                me.listResp=[{"nombre":"respuesta","value":"valor"}];
                
                }
            }
            
        },
        listarModulos: function(){
            let me = this;
            let url ="";
            if(me.sw===1)
            {
                if(me.typeCurso===3)
                {
                    url = "/listMod?curso="+parseInt(localStorage.getItem('CMC'));
                }
                else if(me.typeCurso===2){
                     url = "/listMod?curso="+parseInt(localStorage.getItem('CCurso'));
                }
                else if(me.typeCurso===4){
                     url = "/listMod?curso="+parseInt(localStorage.getItem('CCertif'));
                }
                 else if(me.typeCurso===1){
                     url = "/listMod?curso="+parseInt(localStorage.getItem('CDiplo'));
                }
                axios.get(url).then(function(data){
                let result = data.data;
                me.listModQuiz = result.modulos;
                if(me.listModQuiz.length<=0){
                    me.viewInputQuiz = Boolean(1);
                }
                }).catch(function(error){
                    console.log(error);
                });
            }
           
        },
        guardar: function(value){
            
            if(this.validarQuiz(value))
            {
                let me = this;
                let url ='';
                let idcurso = '';
                me.viewInputParcial = Boolean(1);
                me.viewInputQuiz = Boolean(1);
                if(value===0){
                    url = "/exam/store";
                }else if(value===1){
                    url = "/parcial/store";
                }
                if(me.typeCurso===3)
                {
                  idcurso = parseInt(localStorage.getItem('CMC'));
                }
                else if(me.typeCurso===2)
                {
                  idcurso=  parseInt(localStorage.getItem('CCurso'));
                }else if(me.typeCurso===4)
                {
                  idcurso=  parseInt(localStorage.getItem('CCertif'));
                }
                else if(me.typeCurso===1)
                {
                  idcurso=  parseInt(localStorage.getItem('CDiplo'));
                }
                axios.post(url,{
                    'time':me.time_exam,
                    'preguresp':me.listPregunta,
                    'modulo':me.modulo,
                    'curso':idcurso,
                    'valor':me.valor,
                    'intro':me.intro,
                }).then(function(data){
                    
                    let result = data.data;
                    let TextMessage = result.state;
                    if(value===1){
                        localStorage.setItem('Final',1);
                        localStorage.removeItem('CCurso');
                        localStorage.removeItem('CMod');
                        localStorage.removeItem('CQuiz');
                        localStorage.removeItem('CMC');
                        localStorage.removeItem('CCertif');
                        localStorage.removeItem('CDiplo');
                        me.viewInputParcial = 1;
                        me.viewInputQuiz = Boolean(1);
                    }else{
                        me.listarModulos();
                        localStorage.setItem('CQuiz',1);
                        me.viewInputParcial = Boolean(0);
                        me.viewInputQuiz = Boolean(0);
                    }
                    me.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','success');
                }).catch(function(error){
                    let TextMessage = "No se guardo correctamente: por lo siguiente "+ error;
                    me.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','error');
                    me.viewInputParcial = Boolean(0);
                    me.viewInputQuiz = Boolean(0);
                });
            }
        },
        validarQuiz: function(value){
            let me = this;
            if(value===0){ if(me.modulo===""){me.errorModulo="is-invalid";return Boolean(0); }}
            if(me.intro===""){me.errorIntro="is-invalid";return Boolean(0); }
            let h = me.hora, m = me.min, s= me.seg;
            if(me.hora===''){h=0;}if(me.min===''){m=0;}if(me.seg===''){s=0;}
            if(h<=9){ h="0"+h.toString();}if(m<=9){m="0"+m.toString();}if(s<=9){s="0"+s.toString();}me.time_exam=h+":"+m+":"+s;
            if(me.time_exam==="00:00:00"){me.errorDuracion="is-invalid";return Boolean(0);}
            if(me.listPregunta.length<=0){me.errorContent = "¡Lista vacia ingresa un dato!"; return Boolean(0);}
            return Boolean(1);
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
    mounted(){
        this.listarModulos();
    }
}
</script>