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
				<input type="text" placeholder="Buscar Estudiantes" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarAdministrador(1,buscar,criterio)">
				<button type="submit" @click="listarAdministrador(1,buscar,criterio)"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
                         </div>
                                      <ul class="courses-list-search list-unstyled"></ul>
                                      </div>
                                     <button type="button" class="btn btn-success btn-sm" @click="abrirModal('usuarios','registrar',administrador)" style="height: 36px; margin: 5px;">
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
                                    <th>Telefono</th>
                                    <th>Tipo Usuario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="administrador in inicio.arrayAdministradores" :key="administrador.id_user" >
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('usuarios','actualizar',administrador)">
                                          <i class="fa fa-eye"></i>
                                        </button> &nbsp;
                                       <template v-if="administrador.estado_registro">
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
                                    <td v-text="administrador.primer_nombre"></td>
                                    <td v-text="administrador.segundo_nombre"></td>
                                    <td v-text="administrador.primer_apellido"></td>
                                    <td v-text="administrador.segundo_apellido"></td>
                                    <td v-text="administrador.telefono"></td>
                                    <td>
                                        <div v-if="administrador.idrol===1">
                                            <span class="badge badge-success">Administrador</span>
                                        </div>
                                        <div v-if="administrador.idrol===2">   
                                            <span class="badge badge-danger">Profesor</span>
                                        </div>
                                         <div  v-if="administrador.idrol===3">   
                                            <span class="badge badge-info">Estudiante</span>
                                        </div>
                                        
                                    </td>
                                    <div v-if="administrador.estado_registro">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>   
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                </tr>                                
                            </tbody>
                        </table>

<div class="modal fade" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header" style="background: #2F89B6;">
                        <h6 style="color: #fff" v-text="campos.titulo_modal"></h6>    

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        
                           <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Nombre(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.primer_nombre" class="form-control" placeholder="Ej: juan">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Nombre</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.segundo_nombre" class="form-control" placeholder="Ej: Andres">                                        
                                    </div>
                                </div> 
                                     <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Primer Apellido(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.primer_apellido" class="form-control" placeholder="Ej: Peroso">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Segundo Apellido</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.segundo_apellido" class="form-control" placeholder="Ej: guate">                                        
                                    </div>
                                </div> 
                                 <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Fecha de Nacimiento</span>
                                    <div class="col-md-12">
                                        <input type="date" v-model="campos.fecha_nacimiento" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Telefono (+57)</span>
                                    <div class="col-md-12">
                                        <input type="number" v-model="campos.telefono" class="form-control" placeholder="3042562526">                                        
                                    </div>
                                </div> 
                                        <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Direccion</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.direccion" class="form-control" placeholder="Cra 41 # 52-44">                                        
                                    </div>
                                </div> 
                                  <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Usuario</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.usuario" class="form-control" placeholder="Ej: D-Juan">                               
                                    </div>
                                </div> 
                                <div class="form-group row col-md-6">
                                    <span class="col-md-12" for="text-input">Contraseña</span>
                                    <div class="col-md-12">
                                        <input type="password" v-model="campos.contrasena" class="form-control" placeholder="Ej: 123456789">                                   
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
            this.listarAdminitrador();
        }, 
         props: ['ruta'],
        data (){
			return {
                criterio: 'primer_nombre',
                buscar: '',
                inicio:{
                    arrayAdministradores: [],
                    arraypersonas:[],
                },
                campos:{
                    usuario:'',
                    contrasena:'',
                    id_persona:'',
                    name_persona:'',
                    role:'',
                    titulo_modal:'',
                    password:'',
                    fecha_nacimiento:'',
                    direccion:'',
                    telefono:'',
                    ir:1,
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
            	listarAdminitrador(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'listarAdministradores?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayAdministradores = respuesta.administradores.data;
                    me.pagination= respuesta.pagination;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarPersona(page, buscar, criterio){
                let me=this;
                var url=  me.ruta +'Listarpersonas?page=' +page + '&buscar='+ me.buscar + '&criterio='+ me.criterio;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arraypersonas = respuesta.personas.data;
                    
                   
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
                me.listarAdminitrador(page, buscar, criterio)
            },
            verModal(){
                
                $('#modal').modal('show');
                

            },
            registrarEstudiante(){
                 let me = this;

                axios.post(me.ruta + '/usuario/registrar',{
                    'campos': me.campos,
                    
                }).then(function (response) {
                    console.log(response);
                $('#modalP').modal('hide');
                me.listarAdminitrador('','','');
                }).catch(function (error) {
                    console.log(error);
                });
            
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "usuarios":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                              
                                this.campos.titulo_modal = 'Agregar Administrador';
                                this.campos.primer_nombre = '';
                                this.campos.segundo_nombre = '';
                                this.campos.primer_apellido = '';
                                this.campos.segundo_apellido ='';
                                this.campos.fecha_nacimiento = '';
                                this.campos.telefono = '';
                                this.campos.direccion = '';
                                this.campos.usuario = '';
                                this.campos.contrasena = '';
                                $('#modal').modal('show');
                                                
                                break;
                            }
                            case 'actualizar':
                            {
                                $('#modal').modal('show');
                                this.campos.titulo_modal = 'Actualizar Administrador';
                                this.campos.primer_nombre = data['primer_nombre'];
                                this.campos.segundo_nombre = data['segundo_nombre'];
                                this.campos.primer_apellido = data['primer_apellido'];
                                this.campos.segundo_apellido = data['segundo_apellido'];
                                this.campos.fecha_nacimiento = data['fecha_nacimiento'];
                                this.campos.telefono = data['telefono'];
                                this.campos.direccion = data['direccion'];
                                this.campos.usuario = data['email'];
                                this.campos.contrasena = '';
                                this.campos.password  = data['password'];
                                
                                break;
                            }
                        }
                    }
                }
            }
            
        }
    }
</script>
