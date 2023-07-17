<template>
<div id="lp-archive-courses" class="container">
  <div class="thim-course-top switch-layout-container" style="
    margin-bottom: 0px;
    margin-top: 50px;
">


        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="container ">
    <div class="row">
        <div class="col-md-12 col-sm-12">
           <span><button type="button" class="btn btn-primary btn-sm" @click="abrirModal('estudiante','registrar')" style="height: 36px; margin: 5px;">
                                         Ingresar Nuevo Estudiante <i style="font-size:18px;" class="fa fa-user-circle-o"></i> </button></span> 
           
        </div>
        
    </div>

</div>
                              
                </div>
                <div class="col-md-6 col-sm-12">
                      <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                            <div class="thim-course-order">
                                            <select v-model="criterio">
                                                <option value="primer_nombre">Primer Nombre</option> 
                                                <option value="segundo_nombre">Segundo Nombre</option>
                                                <option value="primer_apellido">Primer Apellido</option>
                                                <option value="segundo_apellido">Segundo Apellido</option>
                                            </select>
                            </div> 
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <input type="text" placeholder="Buscar Estudiantes" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarEstudiantes(1,buscar,criterio)">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button type="submit" class="btn btn-primary btn-md" @click="listarEstudiantes(1,buscar,criterio)"><i class="fa fa-search" style="font-size:14px;"></i></button>
                    </div>
                </div>

            </div>
                </div>
            </div>
        </div>

             
            <div class="courses-searching">
            <div >
			
			
				<span class="widget-search-close"></span>
                         </div>
                                      <ul class="courses-list-search list-unstyled"></ul>
                                      </div>
                                      
                                     
                                      </div>  

<div>
    
    
</div>

<div class="course-index">
           <span v-text="'Mostrando  '+ pagination.from+' - '+pagination.to+' De '+ pagination.total+ ' resultados'">Showing 1-9 of 19 results</span>
            </div>

<table class="table table-bordered table-striped table-sm table-hover">
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
                                <tr  v-for="estudiante in inicio.arrayEstudiantes" :key="estudiante.id_personas" >
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('estudiante','actualizar',estudiante)">
                                          <i class="fa fa-edit"></i>
                                        </button> &nbsp;
                                       <template v-if="estudiante.estado_registro">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarEstudiante(estudiante.id_personas)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                       </template>
                                      <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarEstudiante(estudiante.id_personas)">
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
                    <div class="modal-header" style="background: #2F89B6; ">
                        <img src="/img/Logo_Blanco_d_academy.png" alt="" style="width:120px;">
                        <h6 style="color: #fff; margin-left:20%; font-size:20px; " v-text="titulo_modal"></h6>    

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                           <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Nombre(*)</span>
                                    <div class="col-md-12">
                                        <input type="text"  v-model="campos.primer_nombre" class="form-control" placeholder="Ej: Juan">  
                                                                           
                                    </div>
                                     
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Nombre</span>
                                    <div class="col-md-12">
                                        <input type="text" form v-model="campos.segundo_nombre" class="form-control" placeholder="Ej: Alverto" required>
                                        <p style="color:red; font-size:12px;"></p>                             
                                    </div>
                                </div> 
                                     <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Apellido(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.primer_apellido" class="form-control" placeholder="Ej: Cabrales" required>
                                                                                
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Apellido</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.segundo_apellido" class="form-control" placeholder="Ej: Mojica" required>                                        
                                  
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Fecha de Nacimiento</span>
                                    <div class="col-md-12">
                                        <input type="date" v-model="campos.fecha_nacimiento" class="form-control" placeholder="" required>                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Telefono(+57)</span>
                                    <div class="col-md-12">
                                        <input type="number" v-model="campos.telefono" class="form-control" placeholder="Ej: 3002152428" required>                                        
                                    </div>
                                </div> 
                                        <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Direcion</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.direccion" class="form-control" placeholder="Ej: Cra 53# 99-99" required>                                        
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Usuario</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.email" class="form-control" placeholder="Ej: Agonzales5524@Dacademy.com.co" required>                                        
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Contraseña</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.password" class="form-control" placeholder="Ej: Ag5524*" required>                                        
                                    </div>
                                </div> 
                                
                     </div>
                    

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="registrarEstudiante()" >Guardar</button>

                     
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

import Swal from 'sweetalert2';
window.swal = swal;
    export default {
        mounted() {
            this.listarEstudiantes();
        }, 
         props: ['ruta'],
        data (){
            
			return {
                criterio: 'primer_nombre',
                buscar: '',
                titulo_modal: '',
                inicio:{
                    arrayEstudiantes: [],
                },
                campos:{
                    id: '',
                    primer_nombre: '',
                    segundo_nombre: '',
                    primer_apellido: '',
                    segundo_apellido: '',
                    direccion: '',
                    telefono: '',
                    fecha_nacimiento: '',
                    email:'',
                    password:'',
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
            	listarEstudiantes(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarEstudiantes?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayEstudiantes = respuesta.estudiantes.data;
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
            verModal(){
  

            },
            registrarEstudiante(){
                
                 let me = this;
               

                   axios.post(me.ruta + '/estudiantes/registrar',{
                        'campos': me.campos,
                        
                    }).then(function (response) {
                        
                    $('#modal').modal('hide');
                    Swal.fire(
                        'Estudiante Registrado!',
                        'Click en el botton!',
                        'success'
                    )
                    me.listarEstudiantes();
                    }).catch(function (error) {
                        console.log(error);
                    });
                
            
            },
             desactivarEstudiante(id){
                 const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Esta seguro de desactivar este estudiante?',
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Aceptar',
  cancelButtonText: 'Cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
   let me = this;

                    axios.put(this.ruta + '/estudiante/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEstudiantes(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'El estudiante no fue desactivado',
      'error'
    )
  }
})
             },

              activarEstudiante(id){
              const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Esta seguro de activar este estudiante?',
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Aceptar',
  cancelButtonText: 'Cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
   let me = this;

                    axios.put(this.ruta + '/estudiante/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEstudiantes(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'El estudiante no fue activado :)',
      'error'
    )
  }
})
             },
            
             abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "estudiante":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                              $('#modal').modal('show');
                                              this.titulo_modal = 'Agregar Estudiante';
                                  this.campos.primer_nombre = '';
                    this.campos.segundo_nombre= '';
                    this.campos.primer_apellido= '';
                    this.campos.segundo_apellido= '';
                    this.campos.direccion = '';
                    this.campos.telefono = '';
                    this.campos.fecha_nacimiento = '';
                                break;
                            }
                            case 'actualizar':
                            {
                                $('#modal').modal('show');
                                  this.titulo_modal = 'Actualizar Estudiante';
                                  this.campos.primer_nombre = '';
                                //console.log(data);
                                 this.campos.id = data['id'];
                               this.campos.primer_nombre = data['primer_nombre'];
                    this.campos.segundo_nombre= data['segundo_nombre'];
                    this.campos.primer_apellido= data['primer_apellido'];
                    this.campos.segundo_apellido= data['segundo_apellido'];
                    this.campos.direccion = data['direccion'];
                    this.campos.telefono = data['telefono'];
                    this.campos.fecha_nacimiento = data['fecha_nacimiento'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        
    }
</script>
