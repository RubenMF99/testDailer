<template>

    <div class="row">
        <div class="col-md-3" style="margin-bottom:25px;">
            <div class="style-curs" @click="curso();">
            <div class="row">
                <div class="col-md-12" >
                <img  src="img/cursos/placeholder.png"  alt="">

                </div>
                <div class="col-md-12">
                <p style="text-align:center;"><i class="fas fa-plus font-sie-fas"></i></p>
                </div>
                <div class="col-md-12">
                    <p style="text-align:center;"></p>
                   <p style="color:#FF9821; text-align:center;margin-bottom:15px; position:relative;"> Agregar Curso</p> 
                </div>
            </div>
        </div>
        </div> 
     <div class="col-md-3" style="margin-bottom:25px;" v-for="(miscurso, index) in inicio.arraymiscursos" :key="index"> 

            <div class="style-curs" style="" @click="iraclase(miscurso.url_curso, miscurso.id, miscurso.state);">
            <div class="row">
                <div class="col-md-12" >
                <img v-if="miscurso.imagen_destacada"   :src="'img/cursos/' + miscurso.imagen_destacada"   alt="">
                <img v-else src="img/cursos/placeholder.png"  alt="">

                </div>
                <div class="col-md-12">
                <p style="text-align:left;heigth:30px;">{{miscurso.nombre_curso}}</p>
                </div>
                <div class="col-md-12" style="padding-bottom:20px;">
                    
                    <div class="col-md-8">
                    <p style="text-align:left;">Instructor: <br> {{miscurso.primer_nombre +" "+miscurso.primer_apellido}}</p>
                </div>
                <div class="col-md-4">
                    <p style="color:#337AB7; text-align:center;margin-bottom:15px; position:relative;" v-if="miscurso.state === 0"> Iniciar Curso</p> 
                   <p style="color:lime; text-align:center;margin-bottom:15px; position:relative;" v-else-if="miscurso.state === 1"> Iniciado</p> 
                   <p style="color:gray; text-align:center;margin-bottom:15px; position:relative;" v-else-if="miscurso.state === 2"> Finalizado</p> 
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
</template>
<script>
export default {
    props:['idperson','tipocurso'],
    data(){
        return{
            inicio:{
                arraymiscursos:[],
               documento:'',
                
            },
             pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
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
        listarMiscursos(page, buscar, criterio){
            
               let me=this;
               if(localStorage.getItem('primera_ves')==='1'){
                    let idcurso = localStorage.getItem('name_curso_abrir');
                    let nombrecurso = localStorage.getItem('id_curso_abrir');
                    me.iraclase(idcurso, nombrecurso);
                }else{
                    me.buscar=me.idperson;
                    me.criterio = 2;
                    var url=  'listarMisCursos?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio+'&tipo_curso='+me.tipocurso;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        
                        me.inicio.arraymiscursos = respuesta.miscursos.data;
                        me.inicio.documento = respuesta.estudiante[0].n_documento;
                        me.pagination= respuesta.pagination;
                        
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
               
        },
         cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarEstudiantes(page, buscar, criterio)
            },
            curso(){
                window.location.href = "/Busqueda?que_deseas_aprender=";
            },
        iraclase(nombrecurso,idcurso, estadoCurso)
        {
            let me=this;
            if(estadoCurso === 2){
                if(me.tipocurso==="Master Class"){
                        window.location.href = "/certificados";
                }else{
                    window.location.href = '/Repasar/?c='+nombrecurso+'&m=';
                }
                
            }else{
                // este codigo es mientras hago la vista original de la masterclass.
                if(me.tipocurso==="Master Class"){
                        window.location.href = "/clase/virtual/introduccion/"+nombrecurso;
                }
                localStorage.removeItem('primera_ves');
                localStorage.removeItem('name_curso_abrir');
                localStorage.removeItem('id_curso_abrir');
                var url=  'vista/intro?idcurso=' +idcurso+'&estudiante='+me.idperson;
			
                axios.get(url).then(function (response) {

                    var respuesta= response.data;
                    
                    // console.log(respuesta);
                    if(respuesta.visto === 1)
                    {
                        window.location.href = "/clase/virtual/"+nombrecurso;
                    }else if(respuesta.visto === 0)
                    {
                        window.location.href = "/clase/virtual/introduccion/"+nombrecurso;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            }
            // 
            // 
        }
    },
    mounted(){
        this.listarMiscursos();
    }
}
</script>