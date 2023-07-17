<template>
<div id="lp-archive-courses" class="container">
  <div class="thim-course-top switch-layout-container" style="
    margin-bottom: 0px;
    margin-top: 50px;
">
        <div class="course-index">
           <span v-text="'Mostrando  '+ pagination.from+' - '+pagination.to+' De '+ pagination.total+ ' resultados'">Showing 1-9 of 19 results</span>
            </div>
             <div class="thim-course-order">
                 <select v-model="criterio">
                     <option value="primer_nombre">Primer Nombre</option> 
                      </select>
                      </div> 
                      <div class="courses-searching">
                         <div >
				<input type="text" placeholder="Buscar cursos" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarBancoPreguntas(1,buscar,criterio)">
				<button type="submit" @click="listarBancoPreguntas(1,buscar,criterio)"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
                         </div>
                                      <ul class="courses-list-search list-unstyled"></ul>
                                      </div>
                                     <button type="button" class="btn btn-success btn-sm" @click="verModal" style="height: 36px; margin: 5px;">
                                         <i class="fa fa-plus"></i></button>
                                      </div>  
<table class="table table-bordered table-striped table-sm">
    <thead>
                                <tr>
                                    <th class="col-md-2">Opciones</th>
                                    <th class="col-md-8">Enunciado Pregunta</th>
                                    <th class="col-md-1">Tipo Pregunta</th>
                                    <th class="col-md-1">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="curso in inicio.arrayPregunta" :key="curso.id" >
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm">
                                          <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                       <template v-if="curso.estado_registro">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                       </template>
                                      <template v-else>
                                            <button type="button" class="btn btn-info btn-sm">
                                                <i class="fa fa-check"></i>
                                            </button>
                                      </template>
                                      
                                    </td>
                                    <td v-text="curso.enunciado"></td>
                                    <td v-text="curso.nombre_tipo_pregunta"></td>
                                
                                    <td>
                                        <div v-if="curso.estado_registro">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>   
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>

<div class="modal fade" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header" style="background: #2F89B6;">
                        <h6 style="color: #fff">Tipo de Pregunta</h6>    

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                           <div class="form-group row col-md-12">
                                    <div class="col-md-11">
                                      <select v-model="tipodepregunta" class="form-control">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipopregunta in inicio.arrayTipoDePregunta" :key="tipopregunta.id" :value="tipopregunta.id" v-text="tipopregunta.nombre_tipo_pregunta"></option>
                                          </select>                                        
                                    </div>
                                     <div class="col-md-1">
                                    <button type="button" class="btn btn-primary btn-sm" style="height: 36px; margin: 5px;" @click="funcionTipoPregunta()"><i class="fa fa-check"></i></button>
                                </div>
                           </div>
                                
                     </div>
                    

                    <!-- Modal Actions -->
                    <div class="modal-footer">
        

                     
                    </div>
                </div>
            </div>
        </div>
            <!--Fin del modal-->


<template v-if="tipopregunta == 1">
    <crear-falsoverdadero ruta= http://localhost:8000/></crear-falsoverdadero>
</template>
<template v-if="tipopregunta == 2">
    <crear-opcionmultiple ruta= http://localhost:8000/></crear-opcionmultiple>
</template>
<template v-if="tipopregunta == 3">
    <crear-seleccionmultiple ruta= http://localhost:8000/></crear-seleccionmultiple>
</template>
 




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
        mounted() {
            this.listarBancoPreguntas();
            this.selectTipoPregunta();
        }, 
         props: ['ruta'],
        data (){
			return {
                criterio: 'primer_nombre',
                buscar: '',
                tipodepregunta: 0,
                titulo_tipo_pregunta: '',
                tipopregunta: 0,
                
                inicio:{
                    arrayPregunta: [],
                    arrayTipoDePregunta: [],
                    arrayCategoria: [],
                },
                campos:{
                    primer_nombre: '',
                    segundo_nombre: '',
                    primer_apellido: '',
                    segundo_apellido: '',
                    direccion: '',
                    telefono: '',
                    fecha_nacimiento: '',
                    id_categoria: 0,
                    respuesta: 0,
                },
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
            }
        },
         computed:{
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
            	listarBancoPreguntas(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarBancoPreguntas?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayPregunta = respuesta.preguntas.data;
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
                me.listarBancoPreguntas(page, buscar, criterio)
            },
            verModal(){
                $('#modal').modal('show');

            },
            registrarcurso(){
                 let me = this;

                axios.post(me.ruta + '/cursos/registrar',{
                    'campos': me.campos,
                    
                }).then(function (response) {
                $('#modal').modal('hide');
                me.listarBancoPreguntas();
                }).catch(function (error) {
                    console.log(error);
                });
            
            },
            funcionTipoPregunta(){
           this.tipopregunta = this.tipodepregunta;
          
            },
            selectTipoPregunta(){
                  let me=this;
                var url=  me.ruta +'selectTipoPregunta';
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayTipoDePregunta = respuesta.tipopregunta;
                    
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
               selectCategoria(){
                let me=this;
                var url= this.ruta + '/categoria/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.inicio.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        }
    }
</script>
