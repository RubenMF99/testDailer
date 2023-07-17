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
                     <option value="razon_social">Primer Nombre</option> 
                     <option value="nit">Segundo Nombre</option>
                      <option value="correo_electronico">Primer Apellido</option>
                      <option value="telefono">Segundo Apellido</option>
                      </select>
                      </div> 
                      <div class="courses-searching">
                         <div >
				<input type="text" placeholder="Buscar Estudiantes" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarEmpresa(1,buscar,criterio)">
				<button type="submit" @click="listarEmpresa(1,buscar,criterio)"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
                         </div>
                                      <ul class="courses-list-search list-unstyled"></ul>
                                      </div>
                                     <button type="button" class="btn btn-success btn-sm" @click="abrirModal('estudiante','registrar')" style="height: 36px; margin: 5px;">
                                         <i class="fa fa-plus"></i></button>
                                      </div>  
<table class="table table-bordered table-striped table-sm">
    <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nit</th>
                                    <th>Razon Social</th>
                                    <th>Direccion</th>
                                    <th>Numero Empleados</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="empresa in inicio.arrayEmpresa" :key="empresa.id" >
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('empresa','actualizar',empresa)">
                                          <i class="fa fa-edit"></i>
                                        </button> &nbsp;
                                       <template v-if="empresa.estado_registro">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarempresa(empresa.id)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                       </template>
                                      <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarempresa(empresa.id)">
                                                <i class="fa fa-check"></i>
                                            </button>
                                      </template>
                                      
                                    </td>
                                    <td v-text="empresa.nit"></td>
                                    <td v-text="empresa.razon_social"></td>
                                    <td v-text="empresa.direccion"></td>
                                    <td v-text="empresa.numero_empleados"></td>

                                    <td v-text="empresa.telefono"></td>
                                    <td>
                                        <div v-if="empresa.estado_registro">
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
                        <h6 style="color: #fff" v-text="titulo_modal"></h6>    

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                           <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Razon Social(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.razon_social" class="form-control" placeholder="Razon Social">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Nit(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.nit" class="form-control" placeholder="Nit">                                        
                                    </div>
                                </div> 
                                     <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Correo Electronico(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.correo_electronico" class="form-control" placeholder="Correo Electronico">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Telefono</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.telefono" class="form-control" placeholder="Telefono">                                        
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Numero Empleados</span>
                                    <div class="col-md-12">
                                     
                                        <select class="form-control" v-model="campos.num_empleado">
                                             <option value="0" disabled>Seleccione</option>
                                              <option value="0-10" >0-10</option>
                                               <option value="10-30" >10-30</option>
                                               <option value="30-100" >30-100</option>
                                                <option value="100-500" >100-500</option>
                                            </select>                                      
                                    </div>
                                </div>
                                        <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Dirección</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.direccion" class="form-control" placeholder="Dirección">                                        
                                    </div>
                                </div> 
                                
                     </div>
                    

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="registrarEstudiante()" >Guadar</button>

                     
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
            this.listarEmpresa();
        }, 
         props: ['ruta'],
        data (){
			return {
                criterio: 'razon_social',
                buscar: '',
                titulo_modal: '',
                inicio:{
                    arrayEmpresa: [],
                },
                campos:{
                    id: '',
                    razon_social: '',
                    nit: '',
                    correo_electronico: '',
                    telefono: '',
                    direccion: '',
                    num_empleado: 0,
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
            	listarEmpresa(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarEmpresa?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayEmpresa = respuesta.empresa.data;
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
                me.listarEmpresa(page, buscar, criterio)
            },
            verModal(){
  

            },
            registrarEstudiante(){
                 let me = this;

                axios.post(me.ruta + '/empresa/registrar',{
                    'campos': me.campos,
                    
                }).then(function (response) {
                    
                $('#modal').modal('hide');
                Swal.fire(
  'Estudiante Registrado!',
  'Click en el botton!',
  'success'
)
                me.listarEmpresa();
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
                        me.listarEmpresa(1,'','nombre');
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
      'El estudiante no fue desactivado :)',
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
                        me.listarEmpresa(1,'','nombre');
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
                                  this.campos.razon_social = '';
                    this.campos.nit= '';
                    this.campos.correo_electronico= '';
                    this.campos.telefono= '';
                    this.campos.direccion = '';
                    this.campos.telefono = '';
                    this.campos.num_empleado = 0;
                                break;
                            }
                            case 'actualizar':
                            {
                                $('#modal').modal('show');
                                  this.titulo_modal = 'Actualizar Estudiante';
                                  this.campos.razon_social = '';
                                //console.log(data);
                                 this.campos.id = data['id'];
                               this.campos.razon_social = data['razon_social'];
                            this.campos.nit= data['nit'];
                    this.campos.correo_electronico= data['correo_electronico'];
                    this.campos.telefono= data['telefono'];
                    this.campos.direccion = data['direccion'];
                    this.campos.telefono = data['telefono'];
                    this.campos.num_empleado = data['num_empleado'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        
    }
</script>
