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
                         <form action="" method="get" enctype="multipart/form-data" >
				<input type="text" placeholder="Buscar Estudiantes" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarCursosCerrar(1,buscar,criterio)">
				<button type="submit" @click="listarCursosCerrar(1,buscar,criterio)"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
                         </form>
                                      <ul class="courses-list-search list-unstyled"></ul>
                                      </div>
                                   
                                      </div>  
<table class="table table-bordered table-striped table-sm table-hover">
    <thead>
                                <tr>
                                    
                                    <th style="width: 80%">Nombre Curso</th>
                                   
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="cursos in inicio.arrayCursos" :key="cursos.id" >
                                   
                                    <td v-text="cursos.nombre_curso"></td>
                                    
                                    <td>
                                        <div v-if="cursos.estado_curso ==1">
                                            <span class="badge badge-success">Aprobado</span>
                                        </div>
                                        <div v-else-if="cursos.estado_curso ==2">   
                                            <span class="badge badge-danger">No Aprobado</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                       <!-- <button type="button" class="btn btn-warning btn-sm">
                                          <i class="fa fa-eye"></i>
                                        </button> &nbsp;-->
                                       <template v-if="cursos.estado_curso == 1">
                                            <button type="button" class="btn btn-success btn-sm" disabled>
                                                <!--@click="desactivarCurso(cursos.id)"-->
                                                <i class="fa fa-check"></i>
                                            </button>
                                       </template>
                                      <template v-else-if="cursos.estado_curso == 2">
                                            <button type="button" class="btn btn-info btn-sm" @click="activarCurso(cursos.id,cursos.nombre_curso)">
                                                <i class="fa fa-check"></i>
                                            </button>
                                      </template>
                                      
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>


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

import Swal from 'sweetalert2';
window.swal = swal;

    export default {
        mounted() {
            this.listarCursosCerrar();
        }, 
         props: ['ruta'],
        data (){
			return {
                criterio: 'primer_nombre',
                buscar: '',
                inicio:{
                    arrayCursos: [],
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
            	listarCursosCerrar(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarCursosCerrar?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayCursos = respuesta.cursos.data;
                    me.pagination= respuesta.pagination;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
                  desactivarCurso(id){
              const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Esta seguro de desactivar este curso?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/cursoCerrar/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCursosCerrar(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },

              activarCurso(id,nombre){
              const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({

       title: 'Esta seguro de activar este curso '+nombre+' ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/cursoCerrar/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCursosCerrar(1,'','nombre');
                        swal(
                        'Activar!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },

            cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCursosCerrar(page, buscar, criterio)
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
                me.listarCursosCerrar();
                }).catch(function (error) {
                    console.log(error);
                });
            
            }
        }
    }
</script>
