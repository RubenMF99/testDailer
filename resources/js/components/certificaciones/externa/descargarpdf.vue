<template>
    <div class="row" style="margin-top:40px;">
            <div class="col-md-12 effect-pallarax spacing-lados" style="background-image:url('/img/fondos/fondo.png');">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 content-center">
                    <div class="content-parallax-default">
                            <h2>¿Deseas descargar PDF? </h2>
                            <p>Esta certificacion es para: ingenieros de sistemas, desarrolladores de sistemas, tecnicos en redes de computadores.</p>
                            <button @click="abrirdatos" class="btn-parallax">Descargar</button>
                    </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>
            </div>
            <!-- modal o ventana emergente -->
            <div class="modal fade" id="datePerson" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="background-image:url('/img/fondos/fondo_login.jpg');">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="row" style="padding:50px;">
                            <template v-if="sw===0">
                                <div class="col-md-12 center">
                                <img src="/img/logo_d_academy.png" style="width:180px; height:50px; margin-bottom:30px;" alt="">
                            </div>
                            <div class="col-md-12 center">
                                <h3 style="text-align:center;font-size:20px;">¿Deseas descargar toda la informacion de está certificación?</h3>
                                <p style="margin-bottom:20px;">Llena todos los datos para contactarte.</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" @input="borrar(this)" :class="'form-control '+error.primer_nombre" v-model="data.primer_nombre" style="margin-bottom:20px;" placeholder="Primer Nombre">
                                <input type="text" @input="borrar(this)" :class="'form-control '+error.segundo_nombre" v-model="data.segundo_nombre" style="margin-bottom:20px;" placeholder="Segundo Nombre">
                                <input type="text" @input="borrar(this)" :class="'form-control '+error.primer_apellido" v-model="data.primer_apellido" style="margin-bottom:20px;" placeholder="Primer Apellido">
                                <input type="text" @input="borrar(this)" :class="'form-control '+error.segundo_apellido" v-model="data.segundo_apellido" style="margin-bottom:20px;" placeholder="Segundo Apellido">
                                <input type="text" @input="borrar(this)" :class="'form-control '+error.correo" v-model="data.correo" style="margin-bottom:20px;" placeholder="Correo">
                                <input type="number" @input="borrar(this)" :class="'form-control '+error.telefono" v-model="data.telefono" style="margin-bottom:20px;" placeholder="Telefono">
                            </div>
                            <div class="col-md-12 center">
                                <button @click="next(1)" type="button" style="background:#FF9700 !important;">Descargar</button>
                            </div>
                            </template>
                            <template v-if="sw===1">
                                <div class="col-md-12 center">
                                <img src="/img/logo_d_academy.png" style="width:180px; height:50px; margin-bottom:30px;" alt="">
                            </div>
                                 <div class="col-md-12 center">
                                    <h3 style="text-align:center;font-size:20px;">Descarga toda la informacion de está certificación</h3>
                                    <p>Aqui se encuentran toda la información.</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" style="padding:20px;">
                                        <div  v-for="(item, index) in listFiles" :key="index" class="col-md-12">
                                            <a @click="downloadFile2"  :id="index" :href="'/pdf/'+item.url+'.'+item.tipo_archivo" :download="item.url"><i class="fas fa-cloud-download-alt"></i> {{item.url}}</a>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-md-12 center">
                                    <button @click="downloadFile" type="button" style="background:#FF9700 !important;">Descargar Todos</button>
                                </div>
                            </template>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button @click="cerrar" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        
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
    props:['curso'],
    data(){
        return{
            descargo:1,
            data:{
                primer_nombre:'',
                segundo_nombre:'',
                primer_apellido:'',
                segundo_apellido:'',
                telefono:'',
                correo:'',
            },
            error:{
                primer_nombre:'',
                segundo_nombre:'',
                primer_apellido:'',
                segundo_apellido:'',
                telefono:'',
                correo:'',
            },
            sw:0,
            NameClassError:'is-invalid',
            listFiles:[
                        {'name':'hoja de vida 34','ext':'pdf'},
                        {'name':'parcial I calculo 3','ext':'pdf'}
                        ]
        }
    },
    computed:{
        borrar: function(input){
            let _this = this;
            return function(){
                if(input.data.primer_nombre != ""){
                    if(_this.error.primer_nombre != "")
                    {
                        _this.error.primer_nombre = "";
                    }
                }
                if(input.data.primer_apellido != ""){
                    if(_this.error.primer_apellido != "")
                    {
                        _this.error.primer_apellido = "";
                    }
                }
                if(input.data.correo != ""){
                    if(_this.error.correo != "")
                    {
                        _this.error.correo = "";
                    }
                }
                if(input.data.telefono != ""){
                    if(_this.error.telefono != "")
                    {
                        _this.error.telefono = "";
                    }
                }
            }
        }
    },
    methods:{
        abrirdatos: function(){
            $('#datePerson').modal('show');
        },
        validate: function(){
            let _this = this;
            if(_this.data.primer_nombre===""||_this.data.primer_nombre===null||_this.data.primer_nombre===undefined){
                _this.error.primer_nombre = _this.NameClassError;
            }
            else if(_this.data.primer_apellido===""||_this.data.primer_apellido===null||_this.data.primer_apellido===undefined){
                _this.error.primer_apellido = _this.NameClassError;
            }
            else if(_this.data.correo===""||_this.data.correo===null||_this.data.correo===undefined){
                _this.error.correo = _this.NameClassError;
            }
            else if(_this.data.telefono===""||_this.data.telefono===null||_this.data.telefono===undefined){
                _this.error.telefono = _this.NameClassError;
            }
            return true;
            
        },
        next: function(){
            let _this = this;
            if(_this.validate()){
                _this.listFilesCertifi();
            }
        },
       downloadFile: function(){
           let _this = this;
           if(_this.descargo==1)
           {
                let url = '/certificacion/saveDownload'
                +'?primer_nombre='+_this.data.primer_nombre
                +'&segundo_nombre='+_this.data.segundo_nombre
                +'&primer_apellido='+_this.data.primer_apellido
                +'&primer_segundo='+_this.data.primer_segundo
                +'&telefono='+_this.data.telefono
                +'&correo='+_this.data.correo
                +'&certificacion='+_this.curso[0].id;
                axios.get(url).then(function(response){
                    let data = response.data;
                        for (let i = 0; i < _this.listFiles.length; i++) {
                            document.getElementById(i).click();
                        }
                         _this.descargo = 2;
                }).catch(function(error){
                    Swal.fire({
                        icon:'error',
                        title:'D-Academy',
                        text:'Opps. algo salio mal debido a:'+error
                    })
                });
           }
           
       },
       downloadFile2: function(){
           let _this = this;
           if(_this.descargo==1)
           {
                let url = '/certificacion/saveDownload'
                +'?primer_nombre='+_this.data.primer_nombre
                +'&segundo_nombre='+_this.data.segundo_nombre
                +'&primer_apellido='+_this.data.primer_apellido
                +'&primer_segundo='+_this.data.primer_segundo
                +'&telefono='+_this.data.telefono
                +'&correo='+_this.data.correo
                +'&certificacion='+_this.curso[0].id;
                axios.get(url).then(function(response){
                    let data = response.data;
                    _this.descargo = 2;
                }).catch(function(error){
                    Swal.fire({
                        icon:'error',
                        title:'D-Academy',
                        text:'Opps. algo salio mal debido a:'+error
                    })
                });
           }
       },
       listFilesCertifi: function(){
            let _this = this;
            let url = '/listFiles?certificacion='+_this.curso[0].id;
            axios.get(url).then(function(response){
                let result = response.data;
                _this.listFiles = result.listFiles;
                _this.sw = 1
            }).catch(function(error){
                Swal.fire({
                   icon:'error',
                   title:'D-Academy',
                   text:'Opps. algo salio mal debido a:'+error
               })
            });
            
       },
       cerrar: function(){
           let _this = this;
           _this.sw = 0;
       }
       
    },
    mounted(){
       
    }

}
</script>