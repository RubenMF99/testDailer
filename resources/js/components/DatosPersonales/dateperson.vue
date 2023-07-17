<template>
<div style="z-index:1000;" class="modal fade feedback-modal modal-person" id="datospersonales" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      
      <div class="modal-body content-modal-person">
        
          <div class="row center" style=" padding-right:10px;">

                  
               
             <div class="col-md-6 col-xs-12">
               <!-- imagen -->
               <img src="/img/fondos/obten tu titulo profesional.png" alt="">
             </div>
             <div class="col-md-6 col-xs-12">
               <div style="text-align:left;margin-top:30px;" class="col-md-6">Paso <strong>{{pag}}</strong> de <strong>{{fin}}</strong></div>
               <div class="col-md-6 col-xs-12">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                  </div>
                 
               <!-- datos -->
               <!-- switch -->
               <!-- -------------------------------------------------------------------------------------------- -->
               <div class="col-md-12" style="margin-top:50px;" v-if="sw===1">
                 
                 <h2>¡Hola <strong>{{user}}</strong>! <br> <span style="font-size:18px;">Queremos saber mas sobre ti</span></h2>
                 <p>por favor necesitamos que ingreses <br> tu documento de identidad</p>
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                   <div class="col-md-12" style="margin-bottom:5px;">
                     <select class="form-control" v-model="registrame.tipodocumento" >
                       <option value="CC">Cedula de Ciudadania</option>
                       <option value="TI">Tarjeta de Identidad</option>
                       <option value="CE">Cedula Extranjeria</option>
                     </select>
                     
                   </div>
                   <div class="col-md-12">
                     <input type="number" v-model="registrame.documento" placeholder="Ingrese su numero" class="form-control ">
                    <p  style="color:red; font-size:14px;" v-text="errordocumento"></p>
                   </div>
                   
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(2,1)" class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
              
              <!-- sw 3 -->
               <!-- ----------------------------------------------------------------------------------------- -->
             <div class="col-md-12" style="margin-top:50px;" v-if="sw===2">
                 
                 <h2>  <span style="font-size:18px;">¿Donde te encuentras?</span></h2>
                 <p>por favor necesitamos que ingreses <br> la ciudad en donde te encuentras</p>
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                       <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                            <select   class="form-control" @change="borrar(this);" v-model="registrame.pais"  >
                                   <option value="0">En que pais te encuentras (*)</option>
                                   <option v-for="(items, index) in ListasPaises" :key="index" :value="items.id" >{{items.nombre}}</option>
                            </select>
                             <p  style="color:red; font-size:14px;" v-text="errorpais"></p>
                        </div>
                   </div>
                    <div class="form-group col-md-12">
                      <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                           <select v-if="show_Select_Ciudad" class="form-control" @change="borrar(this);" v-model="registrame.ciudad"  >
                                   <option value="0">En que ciudad te encuentras (*)</option>
                                   <option v-for="(items, index) in ListasCiudades" :key="index" :value="items.id" >{{items.nombre}}</option>
                                   <option value="ot">Otro</option>
                           </select>
                                   <input class="form-control" v-else v-model="registrame.otraciudad" type="text" placeholder="Ingrese la ciudad en se encuentra.">
                                   <p  style="color:red; font-size:14px;" v-text="errorciudad"></p>
                          </div>
                                </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(3,2)"  class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
               <!-- ******************************************************************************** -->
             <div class="col-md-12" style="margin-top:50px;" v-if="sw===3">
                 
                 <h2>  <span style="font-size:18px;">¿Estas estudiando, trabajando o ambas?</span></h2>
                 <p>Queremos ayudarte...</p>
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                       <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                            <select   class="form-control" @change="borrar(this);" v-model="registrame.estudiando"  >
                              <option value="estudio">Si estoy estudiando.</option>
                              <option value="trabajo">Si estoy trabajando.</option>
                              <option value="ambos">Si estoy estudiando y trabajando.</option>
                            </select>
                             <p  style="color:red; font-size:14px;" v-text="errorestudiando"></p>
                        </div>
                   </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(4,3)" class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
                <!-- ******************************************************************************** -->
             <div class="col-md-12" style="margin-top:50px;" v-if="sw===4">
                 
                 <h2>  <span style="font-size:18px;">¿En qué te gustaría perfeccionar tus conocimientos?</span></h2>
                 <p>Queremos ayudarte...</p>
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  
                   <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <textarea cols="30" rows="10"  type="text" placeholder="" @input="borrar(this);" class="form-control" v-model="registrame.perfeccionar"></textarea>
                                        <p  style="color:red; font-size:14px;" v-text="errorperfeccionar"></p>
                                    </div>
                                </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(5,4)" class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
                <!-- ******************************************************************************** -->
             <div class="col-md-12" style="margin-top:50px;" v-if="sw===5">
                 
                 <h2>  <span style="font-size:18px;">¿Queremos saber tu profesion?</span></h2>
                 <!-- <p> <br> tu documento de identidad</p> -->
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                      <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                           <select  class="form-control" @change="borrar(this);" v-model="registrame.profesion"  >
                                  <option value="0">Escoge tu profesión (*)</option>
                                  <option v-for="(items, index) in ListarProfesiones" :key="index" :value="items.id" >{{items.nombre}}</option>
                                  <option value="ot">OTROS</option>
                          </select>
                                                            
                                  <input type="text" style="margin-top:10px;" placeholder="Escribe tu profesión." @input="borrar(this);" class="form-control" v-model="registrame.profeionotro" v-if="registrame.viewInput" spellcheck="true">
                                  <p  style="color:red; font-size:14px;" v-text="errorprofesion"></p>
                      </div>
                  </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(6,5)"  class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
               <!-- ******************************************************************************** -->
              <div class="col-md-12" style="margin-top:50px;" v-if="sw===6">
                
                 <h2> <span style="font-size:18px;">¿Estas estudiando para?</span></h2>
                 <!-- <p></p> -->
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                       <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                             <select  class="form-control" @change="borrar(this);" v-model="registrame.estudiando_por"  >
                                      <option value="0">Escoge una opción (*)</option>
                                      <option value="Mejorar mis habilidades y capacidades.">Mejorar mis habilidades y capacidades.</option>
                                      <option value="Desarrollo personal.">Desarrollo personal.</option>
                                      <option value="Desarrollo profesional.">Desarrollo profesional.</option>
                                      <option value="Necesito conocimiento para un nuevo empleo.">Necesito conocimiento para un nuevo empleo.</option>
                                     <option value="Nesesito este conocimiento para un nuevo proyecto personal (emprendimiento).">Nesecito este conocimiento para un nuevo proyecto personal (emprendimiento).</option>
                                      <option value="1">Otros</option>
                            </select>
                                 <input type="text" style="margin-top:10px;" placeholder="Estudiando por:" @input="borrar(this);" class="form-control" v-model="registrame.estudiando_porotro" v-if="registrame.viewInput2">
                          <p  style="color:red; font-size:14px;" v-text="errorestudiandopor"></p>
                       </div>
                  </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(7,6)"  class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
               <!-- -------------------------------------------------------------------------------- -->
             <div class="col-md-12" style="margin-top:50px;" v-if="sw===7">
                  
                 <h2> <span style="font-size:18px;">Te gustaria que te ayudemos a buscar empleo?</span></h2>
                 <p>queremos ayudarte a buscar un empleo</p>
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                      <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                           <select  class="form-control" @change="borrar(this);" v-model="registrame.empleo"  >
                                  <option value="Sin">Si</option>
                                  <option value="Sia">No</option>
                          </select>
                                  <p  style="color:red; font-size:14px;" v-text="errorampleo"></p>
                      </div>
                  </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(8,7)"  class="btn btn-primary btn-next"><strong>Siguiente</strong> </button>
                   </div>
                 </div>
               </div>
               <!-- -------------------------------------------------------------------------------- -->
            <div class="col-md-12" style="margin-top:50px;" v-if="sw===8">
                 
                 <h2> <span style="font-size:18px;">¿Nos autoriza a mostrar tu información a empresas interesadas 
                                                    en personas con tu perfil y respetando las políticas de privacidad de 
                                                    nuestra academia?</span></h2>
                 <!-- <p></p> -->
                 <div class="row" style="padding-left:40px; padding-right:40px;">
                  <div class="form-group col-md-12">
                       <!-- aqui va la ultima seccion -->
                       <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                           <select  class="form-control" @change="borrar(this);" v-model="registrame.autoriczacion"  >
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>

                          </select>
                                  <p  style="color:red; font-size:14px;" v-text="errorampleo"></p>
                      </div>
                  </div>
                   <div class="col-md-12">
                     <br>
                     <button type="button" @click="next(0,8)"  class="btn btn-primary btn-next"><strong>Finalizar</strong> </button>
                   </div>
                 </div>
               </div>
               <!-- -------------------------------------------------------------------------------- -->
            
             </div>
          </div>
          
      </div>
      <!--<div class="modal-footer">
        <button type="button"   class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>-->
    </div>
  </div>
</div>

</template>
<script>
export default {
  props:['user','ruta'],
  data(){
    return{
        registrame:{
          documento:'',
          tipodocumento:'CC',
          estudiando_por:'0',
          empleo:'Si',
          profesion:'0',
          estudiando:'estudio',
          perfeccionar:'',
          ciudad:'0',
          pais:'0',
          otraciudad:'',
          profeionotro:'',
          estudiando_porotro:'',
          viewInput:Boolean(0),
          viewInput2:Boolean(0),
          autoriczacion:'SI'
        }
        ,
          errordocumento:'',
          errorestudiandopor:'',
          errorampleo:'',
          errorprofesion:'',
          errorestudiando:'',
          errorpais:'',
          errorciudad:'',
          sw:1,
          pag:1,
          fin:8,
          ListasPaises:[],
          ListasCiudades:[],
          ListarProfesiones:[],
          show_Select_Ciudad:Boolean(1),
    }
  },
  computed:{
    borrar(input){
      return function(){
                 if(input.registrame.pais != "0")                          
                {
                    if(this.errorpais != "")
                    {
                       this.errorpais = "";
                    }
                    this.listarCiudades(input.registrame.pais);
                }
                if(input.registrame.ciudad != "0")                          
                {
                  if(input.registrame.ciudad != "ot")
                  {
                    this.registrame.otraciudad='';
          
                    this.show_Select_Ciudad = Boolean(1);
                      if(this.errorciudad != "")
                    {
                        this.errorciudad = "";
                    } 
                  }else if(input.registrame.ciudad === "ot"){
                    this.show_Select_Ciudad = Boolean(0);
                    // input.registrame.ciudad = 1;
                  }
                   
                                   
                }
                if(input.registrame.estudiando_por != "0")                          
                {
                  if(input.registrame.estudiando_por != "1")
                  {
                    this.registrame.viewInput2 = Boolean(0);
                    
                    this.registrame.estudiando_porotro='';
                      if(this.errorciudad != "")
                    {
                        this.errorciudad = "";
                    } 
                  }else if(input.registrame.estudiando_por === "1"){
                    this.registrame.viewInput2 = Boolean(1);
                    // input.registrame.estudiando_por = 1;
                  }
                }
                if(input.registrame.profesion != "0")                          
                {
                  if(input.registrame.profesion != "ot")
                  {
                    this.registrame.profeionotro='';
                    this.registrame.viewInput = Boolean(0);
                      if(this.errorciudad != "")
                    {
                        this.errorciudad = "";
                    } 
                  }else if(input.registrame.profesion === "ot"){
                    this.registrame.viewInput = Boolean(1);
                    // input.registrame.profesion = 1;
                  }
                }
             this.error = '';
      }
    }
  },
  methods:{
    next(value, tab){
      let me = this;
      if(me.filtroValidar(tab)){
        if(value === 0)
        {
          me.verificarInput();
        }else{
          me.sw = value;
          me.pag = value;
        }
        
      }
    },
    filtroValidar(tab){
      let me = this;
      if(tab===1){
        if(me.registrame.documento===""){
          me.errordocumento = "ingrese la su cedula por favor.";
          return false;
        }else{
          return true;
        }
      }else if(tab===2){
        return true;
      }
      return true;
      
    },
    listarCiudades(id){
      let me  =  this;
      let url = me.ruta +"/ciudad?pais="+id;
        axios.get(url).then(function(response){
          let data = response.data;
          me.ListasCiudades = data.ciudades;
        }).catch(function(error){
          console.log('error: '+error);
        });
    },
    listarPais(){
      let me = this;
      if(me.ListasPaises.length<=0){
        let url = me.ruta +"/pais";
        axios.get(url).then(function(response){
          let data = response.data;
          me.ListasPaises = data.paises;
        }).catch(function(error){
          console.log('error: '+error);
        });
      }
    },
    listarOficios(){
      let me  =  this;
      let url = me.ruta +"/profesion";
        axios.get(url).then(function(response){
          let data = response.data;
          console.log('datos: '+data);
          me.ListarProfesiones = data.profesion;
        }).catch(function(error){
          console.log('error: '+error);
        });
    },
    saveDataPerson(ciudad, estudio, profesion){
      let me = this;
      let url = '/saveDataPeople';
      axios.post(url,{
        'documento':me.registrame.documento,
        'tipo_documento':me.registrame.tipodocumento,
        'profesion':profesion,
        'perfeccionar':me.registrame.perfeccionar,
        'trabajo':me.registrame.estudiando,
        'buscando_empleo':me.registrame.empleo,
        'estudiando':estudio,
        'autorizacion':me.registrame.autoriczacion,
        'ciudad':ciudad,
      }).then(function(response){
        let data = response.data;
        alert(data.success);
        // redireccionar
        if(localStorage.getItem('button')===null||localStorage.getItem('button')===undefined||localStorage.getItem('button')===""){
          if(localStorage.getItem('dataperson')===null||localStorage.getItem('dataperson')===undefined||localStorage.getItem('dataperson')===""){
                $('#datospersonales').modal("hide");
            }else{
              $('#datospersonales').modal("hide");
               location.reload();
            }
        }else{
          $('#datospersonales').modal("hide");
          let name = localStorage.getItem('button');
          localStorage.removeItem('button');
          $('#'+name+'').click();

        }
      }).catch(function(error){
        alert(error);
        console.log(error);
      });
        
    },
    verificarInput(){
      let me = this;
      let ciudads = "";
      let estudiandos = "";
      let profesions = "";
      if(me.registrame.ciudad === "ot")
      {
        ciudads = me.registrame.otraciudad;
      }else{
        ciudads = me.registrame.ciudad;
      }
      if(me.registrame.estudiando_por === "ot")
      {
        estudiandos = me.registrame.estudiando_porotro;
      }else{
        estudiandos = me.registrame.estudiando_por;
      }
      if(me.registrame.profesion === "ot")
      {
        profesions = me.registrame.profeionotro;
      }else{
        profesions = me.registrame.profesion;
      }
      me.saveDataPerson(ciudads, estudiandos, profesions);

    }
  },
  mounted(){
    this.listarPais();
    this.listarOficios();
  }
}
</script>