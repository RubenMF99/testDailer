<template>
    <div >
        <div class="row">
            <div class="col-md-12">
                <span v-if="view">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <img src="/img/errores/web-error-404.png" style="height:450px;" width="100%"  alt="">
                        <h2 class="text-error">¡Lo sentimos!</h2>
                        <h2 style="margin-top:5%;"><strong>{{this.resultado}}</strong></h2>
                        <p><br>Intenta de nuevo buscando otra palabra, al momento de encontrar el curso referente a lo escrito aparecerá aca en esta session...</p>
                    </div>
                    <div class="col-md-2"></div>
                </span>
                
                <span v-else><p class="title-search-success" style="padding-left:20px;font-size:30px;margin-top:20px;padding-bottom:20px;border-bottom:2px solid rgba(0,0,0,0.08)">{{this.resultado}} de "<span style="font-size:25px;color:#000;">{{this.busqueda}}</span>"</p></span>
            </div>
        </div>
        <div class="row" style="padding-left:20px;padding-top:30px;" v-if="ver">
            <div class="col-md-3" v-for="(item, index) in listadodelosCursos" :key="index">
                <div class="row" style="padding-left:15px;padding-right:15px;">
                     
                    <div class="col-md-12" style="padding-left:0px!important;padding-right:0px!important;">
                       <!--<div class="ddco-new-course disponible">
                            <p>disponible</p>
                        </div>-->
                        <img style="width:100%;height:180px;" :src="'/img/cursos/'+item.imagen_destacada" alt="" v-if="item.imagen_destacada">
                        <img style="width:100%;height:180px;" src="/img/cursos/placeholder.png" alt="" v-else>
                        
                    </div>
                    <div class="col-md-12" style="padding-left:20px;padding-right:20px;padding-top:10px;background:#fff;">
                        <p style="font-size:19px;font-weight:500; color:#000;">
                        <span v-if="item.id_tipo_curso===3" style="font-size:14px;padding:5px 10px;margin-right:10px;background:#337ab7;color:#fff;">Master Class</span>
                        <span v-if="item.id_tipo_curso===2" style="font-size:14px;padding:5px 10px;margin-right:10px;background:#015D52;color:#fff;">Curso</span>
                        <span v-if="item.id_tipo_curso===4" style="font-size:14px;padding:5px 10px;margin-right:10px;background:#FF9700;color:#fff;">Certificacion</span>
                        <span v-if="item.id_tipo_curso===1" style="font-size:14px;padding:5px 10px;margin-right:10px;background:#000;color:#fff;">Diplomado</span>    
                        {{item.nombre_curso}}</p>
                        <p>{{item.subtitulo_curso}}</p>
                        <p v-if="item.estudiante_maximo !== 0"><strong>Cupo de:</strong> {{item.estudiante_maximo}} Estudiantes.</p>
                         <p v-else><strong>Cupo de:</strong>  Estudiantes Ilimitados.</p>
                        <p style="margin-top:-20px;"><strong>Duración:</strong> de {{item.duracion_numero+" "+item.duracion}}</p>
                    </div>
                    <div class="col-md-12" style="padding-top:30px;background:#fff;padding-bottom:30px;justify-content:center; display:flex; margin-left:auto; margin-right:auto;">
                        
                        <button v-if="item.id_tipo_curso===4" style="border-radius:4px;text-transform:capitalize;font-size:18px;font-weight:500;" @click="detalle('/certificaciones/'+item.url_curso);">Detalle</button>
                        <button v-else style="border-radius:4px;text-transform:capitalize;font-size:18px;font-weight:500;" @click="detalle('/curso/'+item.url_curso);">Detalle</button>
                    </div>
                    
                    
                </div>
                <br>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['cursos'],
    data(){
        return {
            listadodelosCursos:[],
            resultado:'',
            busqueda:'',
            ver:false,
        }
    },
    mounted(){
        let me = this;
        me.ListarTodoslosCursos();
    },
    computed:{},
    methods:{
        ListarTodoslosCursos(){
             let me=this;
                var url= '/BusquedaFiltrada?curso='+me.cursos;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    if(!respuesta.error)
                    {
                        me.ver = true;
                        me.listadodelosCursos = respuesta.curso;
                        me.resultado = "Resultados Encontrados ";
                        me.busqueda = me.cursos;
                        me.view = Boolean(0);
                    }else{
                        me.view = Boolean(1);
                        me.resultado = respuesta.mensaje;
                    }
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        detalle(curso){
          
                window.location.href = curso;
          
            
        }
    }
}
</script>