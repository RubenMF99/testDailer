<template>

    <div class="row">
        <div class="col-md-12" style="justify-content:center;">
                    <div style="margin-top:50px; margin-bottom:50px;text-align:center;" v-if="inicio.arraymiscursos.length<=0">
                        <i style="font-size:80px; color:rgba(0,0,0,0.2);margin-bottom:20px;" class="far fa-times-circle"></i>
                        <p style="text-align:center;margin-left:auto; margin-right:auto;font-size:20px;">No hay Certificados Disponibles para ti</p>
                    </div>
                </div>
    <div class="col-md-12" v-if="view">
        <div class="col-md-12" style="margin-bottom:25px;">
            <div class="col-md-12">
            <p style="text-align:center; font-size:24px;"><strong>{{this.curso}}</strong></p>
        </div>
        
        </div>

        <div class="col-md-12" >
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                    
                    <th scope="col" v-for="(items_notas, indexp) in inicio.arraythmodulos" :key="indexp">{{items_notas.thmodulo}}</th>
               
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    
                    <td v-for="(items_notas, indexp) in inicio.arraymisnotas" :key="indexp"><strong>{{items_notas.modulo}}</strong></td>
                  
                    </tr>
                </tbody>
            </table>
            <div class="col-md-12">
                <div class="col-md-8">

                </div>
                <div class="col-md-4" style="text-align:center; font-size:18px;">
                    
                <p ><strong>Promedio: <span>{{this.promedio}}</span></strong> </p>
           
                </div>
                <div class="col-md-12-">
            <button @click="ocultar();"><span><i class="far fa-arrow-alt-circle-left"></i></span> Volver</button>
        </div>
            </div>
            
        </div>
        
    </div>
    <div class="col-md-12" v-else>
        <div class="col-md-4" style="margin-bottom:25px;" v-for="(miscurso, index) in inicio.arraymiscursos" :key="index"> 

            <div class="style-curs" style="" @click="vernotas(miscurso.nombre_curso,miscurso.id);">
            <div class="row">
                <div class="col-md-12" >
                <img v-if="miscurso.imagen_destacada"   :src="'img/cursos/' + miscurso.imagen_destacada"   alt="">
                <img v-else src="img/cursos/placeholder.png"  alt="">

                </div>
                <div class="col-md-12">
                <p style="text-align:left;">{{miscurso.nombre_curso}}</p>
                
                </div>
                <div class="col-md-12">
                    <hr style="margin-top:12px;height:2px;">
                    <div class="col-md-8">
                    <p style="text-align:left;">Instructor: {{miscurso.primer_nombre +" "+miscurso.primer_apellido}}</p>
                </div>
                <div class="col-md-4">
                   <p style="color:#337AB7; text-align:center;margin-bottom:15px; position:relative;" v-if="miscurso.state==1">Notas Disponibles </p> 
                   <p style="color:#ff0000; text-align:center;margin-bottom:15px; position:relative;" v-else-if="miscurso.state==0">Notas no Disponibles </p> 
                   <p style="color:#808080; text-align:center;margin-bottom:15px; position:relative;" v-if="miscurso.state==2">Curso Terminado </p> 
                </div>
                </div>
                
            </div>
            </div>
        </div>
        
                    <nav class="learn-press-pagination navigation pagination">
                <ul class="page-numbers">
                <li v-if="pagination.current_page > 1"> <a class="prev page-numbers" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio,arrayCategorias)"></a></li>
                <li  v-for="page in pagesNumber" :key="page" ><a class="page-numbers" :class="[page == isActived ? 'current' : '']" href="#" @click.prevent="cambiarPagina(page, buscar,criterio,arrayCategorias)" v-text="page"></a></li>
                <li v-if="pagination.current_page < pagination.last_page"><a class="next page-numbers"  href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio,arrayCategorias)"></a></li>
            </ul>
            </nav>
    </div> 
     
    </div>
</template>
<script>
export default {
    props:['idperson'],
    data(){
        return{
            inicio:{
                arraymiscursos:[],
                arraymisnotas:[],
                arraythmodulos:[],
            }, 
             pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
            },
            view:false,
            curso:'',
            promedio:'',
            
        }
    },computed:{

            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
    methods:{
        ocultar(){
            let me = this;
            me.view =false;
        },
        listarMiscursos(page, buscar, criterio){
               let me=this;
                me.buscar=me.idperson;
                me.criterio = 1;
                var url=  'listarMisCursos?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arraymiscursos = respuesta.miscursos.data;
                    me.pagination= respuesta.pagination;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
         cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarEstudiantes(page, buscar, criterio)
            },
        vernotas(nombre,idcurso)
        {
            let me=this;
                me.buscar=me.idperson;
                me.view =true;
                me.curso = nombre;
                var url=  'estudiante/mis-notas?idcurso=' +idcurso+'&estudiante='+me.idperson;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    // console.log(respuesta);
                    me.inicio.arraymisnotas = respuesta.notas_curso;
                    me.inicio.arraythmodulos = respuesta.mod_par_curso;
                    me.promedio = respuesta.promedio;
                    me.view = true;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    mounted(){
        this.listarMiscursos();
    }
}
</script>