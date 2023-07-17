<template>
    <div>
         <!-- <div class="form-group col-md-12">
                                                            <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                                <input placeholder="Documento (*)." ref="tab2" type="number"  class="form-control" @input="borrar(this);" v-model="registrame.tab2.documento">
                                                                <p  style="color:red; font-size:14px;" v-text="errordocumento"></p>
                                                            </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                                            <select  class="form-control" @change="borrar(this);" v-model="registrame.tab2.tipodocumento"  >
                                                                <option value="">Tipo de Documento (*)</option>
                                                                <option value="CC">Cedula de Ciudadania</option>
                                                                <option value="CE">Cedula de Extranjeria</option>
                                                                <option value="TI">Tarjeta de Identidad</option>
                                                                <option value="RC">Registro Civil</option>
                                                                
                                                            </select>
                                                            <p  style="color:red; font-size:14px;" v-text="errortipodocumento"></p>
                                                        </div>
                                                </div> -->
                                                 <!-- tercer template -->
                             <!-- <template v-if="tabindex==3">
                                  <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Tercer Paso:</strong> Ubicación Actual</p>
                                                                    <p>¡Te damos la Bienvenida {{registrame.tab2.primer_nombre}} <br> queremos saber un poco mas de ti!</p>
                                <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <select   class="form-control" @change="borrar(this);" v-model="registrame.tab3.pais"  >
                                                                <option value="0">En que pais te encuentras (*)</option>
                                                               <option v-for="(items, index) in ListasPaises" :key="index" :value="items.id" >{{items.nombre}}</option>
                                        </select>
                                        
                                        <p  style="color:red; font-size:14px;" v-text="errorpais"></p>
                                    </div>
                                </div>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <select v-if="show_Select_Ciudad" class="form-control" @change="borrar(this);" v-model="registrame.tab3.ciudad"  >
                                                                <option value="0">En que ciudad te encuentras (*)</option>
                                                               <option v-for="(items, index) in ListasCiudades" :key="index" :value="items.id" >{{items.nombre}}</option>
                                        </select>
                                        <input class="form-control" v-else v-model="registrame.tab3.ciudad2" type="text" placeholder="Ingrese la ciudad en se encuentra.">
                                        <p  style="color:red; font-size:14px;" v-text="errorciudad"></p>
                                    </div>
                                </div>
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(2);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center; ">
                                            <button style="background:#FF9700 !important;" @click="tab(4,3)">Siguiente</button><br><br>
                                </div>
                             </template> -->

                             <!-- cuarto template -->
                             <!-- <template v-if="tabindex==4">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Cuarto Paso:</strong>  Información Profesional o Estudiantil</p>
                                                                    <p></p>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Actualmente:</p>
                                            </div>
                                            <div class="col-md-4">
                                                Trabajas: <input v-model="inputcheck1"  id="trabajo" @change="trabaja(1)" type="radio" name="trabajo_1" >
                                            </div>
                                            <div class="col-md-4">
                                                 Estudias: <input v-model="inputcheck2"  id="estudio" @change="trabaja(0)" type="radio" name="trabajo_1" >
                                            </div>
                                             <div class="col-md-4">
                                                 Ambas: <br><input v-model="inputcheck2"  id="estudio" @change="trabaja(2)" type="radio" name="trabajo_1" >
                                            </div>
                                        </div>
                                        <p  style="color:red; font-size:14px;" v-text="errortrabajo"></p>
                                    </div>
                                </div>
                                 <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                                                            <select  class="form-control" @change="borrar(this);" v-model="registrame.tab4.profesion"  >
                                                                <option value="0">Escoge tu profesión (*)</option>
                                                               <option v-for="(items, index) in ListarProfesiones" :key="index" :value="items.id" >{{items.nombre}}</option>
                                                                <option value="Ot">OTROS</option>
                                                            </select>
                                                            
                                                            <input type="text" style="margin-top:10px;" placeholder="Escribe tu profeción." @input="borrar(this);" class="form-control" v-model="registrame.tab4.profeionotro" v-if="registrame.tab4.viewInput" spellcheck="true">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprofesion"></p>
                                                        </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <input type="text" placeholder="En qué te gustaría perfeccionar tus conocimientos: (*)." @input="borrar(this);" class="form-control" v-model="registrame.tab4.perfeccionar">
                                        <p  style="color:red; font-size:14px;" v-text="errorperfeccionar"></p>
                                    </div>
                                </div>
                                 <div class="form-group col-md-12">
                                                        <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;" >
                                                            <select  class="form-control" @change="borrar(this);" v-model="registrame.tab4.estudiando_por"  >
                                                                <option value="0">¿Estas estudiando para? (*)</option>
                                                                <option value="Mejorar mis habilidades y capacidades.">Mejorar mis habilidades y capacidades.</option>
                                                                <option value="Desarrollo personal.">Desarrollo personal.</option>
                                                                <option value="Desarrollo profesional.">Desarrollo profesional.</option>
                                                                <option value="Necesito conocimiento para un nuevo empleo.">Necesito conocimiento para un nuevo empleo.</option>
                                                                <option value="Nesesito este conocimiento para un nuevo proyecto personal (emprendimiento).">Nesecito este conocimiento para un nuevo proyecto personal (emprendimiento).</option>
                                                                <option value="Ot">Otros</option>
                                                            </select>
                                                            <input type="text" style="margin-top:10px;" placeholder="Escribe tu profeción." @input="borrar(this);" class="form-control" v-model="registrame.tab4.estudiando_porotro" v-if="registrame.tab4.viewInput2">
                                                            <p  style="color:red; font-size:14px;" v-text="errorprofesion"></p>
                                                        </div>
                                </div>
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(3);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center; ">
                                            <button style="background:#FF9700 !important;" @click="tab(5,4)">Siguiente</button><br><br>
                                            
                                </div>
                             </template> -->

                             <!-- quinto template -->
                             <!-- <template v-if="tabindex===5">
                                 <p style="color:#000000; font-weight: 300; font-size: 22px; text-align: center;"><strong>Quinto Paso:</strong> Información Laboral</p>
                                                                    <p></p>
                                 <div class="form-group col-md-12">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>¿Estas buscando empleo?</p>
                                            </div>
                                            <div class="col-md-6">
                                                Si: <input v-model="inputcheck3" id="empleoyes" @click="vempleo(1)" type="radio" name="empleo" >
                                            </div>
                                            <div class="col-md-6">
                                                 No: <input v-model="inputcheck4" id="empleonot" @click="vempleo(0)" type="radio" name="empleo" >
                                            </div>
                                        </div>
                                        <p  style="color:red; font-size:14px;" v-text="errortrabajo"></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" v-if="view_empleo2">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>¿Te gustaria que te ayudemos a buscar empleo?</p>
                                            </div>
                                            <div class="col-md-6">
                                                Si: <input  id="empleo2yes" @click="vempleo2(1)" type="radio" name="empleo2" >
                                            </div>
                                            <div class="col-md-6">
                                                 No: <input  id="empleo2not" @click="vempleo2(0)" type="radio" name="empleo2" >
                                            </div>
                                        </div>
                                        <p  style="color:red; font-size:14px;" v-text="errortrabajo"></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" v-if="view_empleo3">
                                    <div class="form-control-counter-container" style="padding-left:15%; padding-right:15%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p>Nos autoriza a mostrar tu información a empresas interesadas 
                                                    en personas con tu perfil y respetando las políticas de privacidad de 
                                                    nuestra academia?</p>
                                            </div>
                                            <div class="col-md-6">
                                                Si: <input  id="empleo3yes" @click="vempleo3(1)" type="radio" name="empleo3" >
                                            </div>
                                            <div class="col-md-6">
                                                 No: <input  id="empleo3not" @click="vempleo3(0)" type="radio" name="empleo3" >
                                            </div>
                                        </div>
                                        <p  style="color:red; font-size:14px;" v-text="errortrabajo"></p>
                                    </div>
                                </div>
                                 <div class="col-md-6" style="text-align: center;">
                                        <a @click="back(4);">Atras</a>
                                 </div>
                                <div class="col-md-6" style="text-align: center;">
                                            <button style="background:#FF9700 !important;" @click="validarRegistro()">Finalizar</button><br><br>
                                </div>
                             </template> -->

    </div>
</template>
<script>
export default {
    data(){
        return{
            tab3:{
                        pais:0,
                        ciudad:0,
                        ciudad2:'',
                    },
                    tab4:{
                        // run select llenado desde la base de datos;
                        trabajo:'',
                        viewInput:Boolean(0),
                        viewInput2:Boolean(0),
                        // stop
                        profesion:0,
                        profeionotro:'',
                        perfeccionar:'',
                        estudiando_por:0,
                        estudiando_porotro:'',
                    },
                    tab5:{
                        buscando_empleo:'',
                        ayuda:'',
                        autorizacion:'',
                    },
                    ayudas:Boolean(0),
                    errortrabajo:'',
                errorprofesion:'',
                errorperfeccionar:'',
                errorestudiando_por:'',
                errorbuscando_empleo:'',
                errorayuda:'',
                errorautorizacion:'',
                 errortipodocumento:'',
                 errordocumento:'',
                errorpais:'',
                errorciudad:'',
                view_empleo2:Boolean(0),
                view_empleo3:Boolean(0),
                ListarProfesiones:[],
                ListasPaises:[],
                ListasCiudades:[],
                show_Select_Ciudad:Boolean(1),

        }
    },
    computed:{
        borrar(input){
            return function(){
                            if(input.registrame.tab2.documento != ""){
                                if(this.errordocumento != "")
                                {
                                    this.errordocumento = "";
                                }
                            }
                            if(input.registrame.tab2.tipodocumento != ""){
                                 if(this.errortipodocumento != "")
                                {
                                    this.errortipodocumento = "";
                                }
                            }
                            if(input.registrame.tab3.pais !== 0){
                                if(this.errorpais != "")
                                {
                                    this.errorpais != ""
                                }
                                this.ListarCidad(input.registrame.tab3.pais);
                            }
                            if(input.registrame.tab3.pais === 0){
                                
                                    this.registrame.tab3.ciudad = 0;
                                
                               
                            }
                            if(input.registrame.tab3.pais !== 0){
                                if(this.errorciudad != "")
                                {
                                    this.errorciudad != ""
                                }
                                this.ListarCidad(input.registrame.tab3.pais);
                            }
                            if(input.registrame.tab4.profesion){
                                if(input.registrame.tab4.profesion==="Ot"){
                                    this.registrame.tab4.viewInput = Boolean(1);
                                }else{
                                    this.registrame.tab4.viewInput = Boolean(0);
                                }
                                
                                if(this.errorprofesion != "")
                                {
                                    this.errorprofesion = "";
                                }
                            }
                            if(input.registrame.tab4.estudiando_por){
                                if(input.registrame.tab4.estudiando_por==="Ot"){
                                    this.registrame.tab4.viewInput2 = Boolean(1);
                                }else{
                                    this.registrame.tab4.viewInput2 = Boolean(0);
                                }
                                
                                if(this.errorestudiando_por != "")
                                {
                                    this.errorestudiando_por = "";
                                }
                            }
                                 
            }
            
        }
    },
    methods:{
        vempleo(value){
                    
                    if(Boolean(value)){
                        this.registrame.tab5.buscando_empleo = "si";
                        this.view_empleo2 = Boolean(1);
                    }else{
                        this.registrame.tab5.buscando_empleo = "no";
                        this.registrame.tab5.ayuda = "";
                        this.view_empleo2 = Boolean(0);
                  }
                },
                vempleo2(value){
                     if(Boolean(value)){
                         this.view_empleo3 = Boolean(1);
                         this.registrame.tab5.ayuda = "si";
                         this.ayudas = Boolean(1);
                    }else{
                        this.view_empleo3 = Boolean(0);
                         this.registrame.tab5.ayuda = "no";
                         this.registrame.tab5.autorizacion = "";
                    }
                },
                vempleo3(value){
                     if(Boolean(value)){
                         this.registrame.tab5.autorizacion = "si";
                    }else{
                        this.registrame.tab5.autorizacion = "no";
                    }
                },
                 validarRegistro(){
                // validar los campos que esten en 0 para no registrarlo. 
                // combobox 1
                // let me = this;
                // let estudiando = '';
                // if( me.registrame.tab4.estudiando_por !== 0){
                //     if(me.registrame.tab4.estudiando_por === "Ot"){
                //         estudiando = me.registrame.tab4.estudiando_porotro;
                //     }else{
                //         estudiando = me.registrame.tab4.estudiando_por;
                //     }
                // }
                // combobox 2
                // let profesion = '';
                
                // if( me.registrame.tab4.profesion !== 0){
                //     if(me.registrame.tab4.profesion === "Ot"){
                //         profesion = me.registrame.tab4.profeionotro;
                //     }else{
                //         profesion = me.registrame.tab4.profesion;
                //     }
                // }
                // let enviar = Boolean(1);
                // validar input checked 
                    // if(me.registrame.tab5.buscando_empleo===''){
                    //     me.errorbuscando_empleo = "Elige si estas buscando empleo";
                    //     enviar = Boolean(0);
                    // }else if(me.registrame.tab5.buscando_empleo==='si'){
                    //     if(me.registrame.tab5.ayuda===''){
                    //         me.errorayuda = "Elige si deseas nuestra ayuda para ti";
                    //         enviar = Boolean(0);
                    //     }else if(me.registrame.tab5.ayuda === "si"){
                            
                    //         if(me.registrame.tab5.autorizacion===''){
                    //             me.errorautorizacion = "Nos autorizas para manejar tu información";
                    //         }else{
                    //             enviar =  Boolean(1);
                    //         }
                    //     }else if(me.registrame.tab5.ayuda === "no"){
                    //         localStorage.removeItem('ayuda');
                    //     }
                    // }else{
                    //     enviar = Boolean(1);
                    // }
                    // if(enviar){
                    //     // alert('Listo para guardar todo esta en orden');
                    //     this.registrarUsuario(estudiando, profesion);
                    // }

                    this.registrarUsuario(estudiando, profesion);
            },
    }
}
</script>