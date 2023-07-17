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
                     <option value="segundo_nombre">Segundo Nombre</option>
                      <option value="primer_apellido">Primer Apellido</option>
                      <option value="segundo_apellido">Segundo Apellido</option>
                      </select>
                      </div> 
                      <div class="courses-searching">
                         <div >
				<input type="text" placeholder="Buscar Estudiantes" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarInstructores(1,buscar,criterio)">
				<button type="submit" @click="listarInstructores(1,buscar,criterio)"><i class="fa fa-search"></i></button>
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
                                    <th>Opciones</th>
                                    <th>Primer Nombre</th>
                                    <th>Segundo Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="estudiante in inicio.arrayEstudiantes" :key="estudiante.id" >
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm">
                                          <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                       <template v-if="estudiante.estado_registro">
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
                                    <td v-text="estudiante.primer_nombre"></td>
                                    <td v-text="estudiante.segundo_nombre"></td>
                                    <td v-text="estudiante.primer_apellido"></td>
                                    <td v-text="estudiante.segundo_apellido"></td>
                                    <td v-text="estudiante.fecha_nacimiento"></td>
                                    <td v-text="estudiante.telefono"></td>
                                    <td>
                                        <div v-if="estudiante.estado_registro">
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
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header" style="background: #2F89B6;">
                        <h6 style="color: #fff">Agregar Estudiantes</h6>    

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                           <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Nombre(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.primer_nombre" class="form-control" placeholder="Nombre de artículo">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Nombre</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.segundo_nombre" class="form-control" placeholder="">                                        
                                    </div>
                                </div> 
                                     <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Apellido(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.primer_apellido" class="form-control" placeholder="Nombre de artículo">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Apellido</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.segundo_apellido" class="form-control" placeholder="">                                        
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Fecha de Nacimiento</span>
                                    <div class="col-md-12">
                                        <input type="date" v-model="campos.fecha_nacimiento" class="form-control" placeholder="Nombre de artículo">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Telefono</span>
                                    <div class="col-md-12">
                                        <input type="number" v-model="campos.telefono" class="form-control" placeholder="">                                        
                                    </div>
                                </div> 
                                        <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Direccion</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.direccion" class="form-control" placeholder="">                                        
                                    </div>
                                </div> 
                                  <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Biografia</span>
                                    <div class="col-md-12">
                                       <textarea class="form-control" v-model="campos.biografia" cols="10" rows="5"></textarea>                                       
                                    </div>
                                </div> 
                                
                     </div>
                    

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-secondary" @click="registrarEstudiante()">Guadar</button>

                     
                    </div>
                </div>
            </div>
        </div>
            <!--Fin del modal-->
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
            this.listarInstructores();
        }, 
         props: ['ruta'],
        data (){
			return {
                criterio: 'primer_nombre',
                buscar: '',
                inicio:{
                    arrayEstudiantes: [],
                },
                campos:{
                    primer_nombre: '',
                    segundo_nombre: '',
                    primer_apellido: '',
                    segundo_apellido: '',
                    direccion: '',
                    telefono: '',
                    fecha_nacimiento: '',
                    biografia: '',
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
            	listarInstructores(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarInstructores?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayEstudiantes = respuesta.instructores.data;
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
                me.listarInstructores(page, buscar, criterio)
            },
            verModal(){
                $('#modal').modal('show');

            },
            registrarEstudiante(){
                 let me = this;

                axios.post(me.ruta + '/instuctores/registrar',{
                    'campos': me.campos,
                    
                }).then(function (response) {
                $('#modal').modal('hide');
                me.listarInstructores();
                }).catch(function (error) {
                    console.log(error);
                });
            
            }
        }
    }
</script>
