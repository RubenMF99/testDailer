<template>
    
<div class="row" >
    <div id="video"></div>
    <template v-if="sw">
    <div class="col-12" style="text-align:center;">
        <p style="font-size:20px;"> Bienvenido(a): <br> <strong>{{this.cursoName}}</strong></p>
        <br>
    </div>  
    </template>
    <div class="col-md-12 center" v-for="(item,index) in array" :key="index">
        <template v-if="sw">
            
            <div class="col-md-12 center">
                <h4 style="text-align:left; color:#FF9821;text-transform:capitalize;margin-bottom:-10px;">Introduccion </h4> 
                <hr>
                <div class="row" style="margin-bottom:50px;">
                    <div class="col-md-12" style="margin-bottom:20px;">
                        <img style="margin-top:20px;width:100%; height:470px;" :src="'/img/cursos/'+item.imagen_contenido" alt="">
                    </div>
                    
                    <div class="col-md-12">
                        <p style="text-align:justify;padding-right:20px;" v-html="item.contenido"></p>
                    </div>
                </div>
                <p style="margin-bottom:100px;" v-if="item.id_tipo_curso===3">
                    <button  @click="next(0);">Siguiente</button>
                </p>
                <p v-else style="margin-bottom:100px;">
                    <button v-if="item.urlvideo!=null" @click="next(0);">Siguiente</button>
                    <button v-else @click="enviar(item.id,item.id_curso);">Siguiente</button>
                </p>
            </div>
        </template>
        <template v-else>
            <div  class="col-md-12">
               
                <h4 style="text-align:left; color:#FF9821;text-transform:capitalize;margin-bottom:-10px;">Video </h4> 
                <hr>
                <div class="row" style="margin-bottom:20px;">
                    <div v-html="item.urlvideo" class="col-md-12 video">
                       <!-- section video -->
                    </div>
                    <div class="col-md-12" style="text-align:justify;margin-top:30px;">
                       <div class="col-md-12" v-html="item.descripcion_video">
                       </div>
                    </div>
                    <div v-if="item.id_tipo_curso===3" class="col-md-12">
                        <div class="col-md-12" style="text-align:left;">
                            <h2 style="font-size:20px;margin-bottom:-10px;">Material de apoyo</h2>
                            <hr>
                        </div>
                        <div class="col-md-12" style="text-align:left;" v-for="(item_two, index2) in lectura" :key="index2">
                            
                            <a v-if="item_two.tipo_enlace==='local'" target="_blank" :href="item_two.url+'.'+item_two.tipo_archivo" >{{index2+" "+item_two.name_file}} - <strong>descargar</strong></a>
                            <a v-if="item_two.tipo_enlace==='externo'" target="_blank" :href="item_two.url" >{{index2+" "+item_two.name_file}} - <strong>descargar</strong></a>
                        </div>
                        
                    </div>
                    
                </div>
                <p v-if="item.id_tipo_curso===3" style="margin-bottom:100px;"><button @click="Parcial();">Realizar Parcial</button></p>
                <p v-else style="margin-bottom:100px;"><button @click="enviar(item.id,item.id_curso);">Siguiente</button></p>
            </div>
        </template>
    </div>
       

    </div> 
   
</template>
<script>
export default {
    props:['curso','person','person_name'],
    data(){
        return{
                array:[],
                sw:Boolean(1),
                cursoName:'',
                lectura:[],
        }
    },
    computed:{

    },
    methods:{
        intro()
        {
            let _this=this;
                var url=  '/listarIntro/'+_this.curso;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					   console.log(respuesta);
                    _this.array = respuesta.curso;
                    _this.cursoName = respuesta.curso[0].nombre_curso;
                    _this.lectura = respuesta.lectura;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        next(value){
            let _this = this;
            if(_this.array[0].urlvideo==="")
            {
                _this.enviar(_this.array[0].id, _this.array[0].id_curso);
            }else{
                window.scrollTo(0,0); 
                _this.sw = Boolean(value);
                   
            }
            
        },
        Parcial(){
            let me = this;
            window.location.href = "/parcial/"+ me.curso; 
        },
        enviar(id, idcurso){
            let _this=this;
                var url= '/storeintro';
                axios.post(url,{'intro':id,'curso':idcurso,'estudiante':_this.person}).then(function (response) {
                    var respuesta= response.status;
					  if(respuesta === 200){
                          window.location.href = "/clase/virtual/"+ _this.curso;
                      }
                    // me.array = respuesta.curso;
                    // me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            // 
        }
    },
    mounted(){
        this.intro();
    }
}
</script>