<template>


            <div class="modal fade" id="modal-pregunta" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header" style="background: #2F89B6;">
                        <h6 style="color: #fff">Opcion Multiple</h6>

                        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                           <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Enunciado Pregunta(*)</span>
                                    <div class="col-md-12">
                                        <input type="text" v-model="campos.enunciado_pregunta" class="form-control" placeholder="Enunciado de la Pregunta">                                        
                                    </div>
                                </div>
                               
                  
                     <div class="form-group row col-md-12">
                                    <span class="col-md-12" for="text-input">Categoria(*)</span>
                                    <div class="col-md-12">
                                        <select v-model="campos.id_categoria" class="form-control">
                                              <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in inicio.arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre_categoria"></option>
                                            </select>                                        
                                    </div>
                                </div>
                               
                    
                         <div class="form-group row col-md-4">
                                    <span class="col-md-12" for="text-input">Respuesta Correcta(*)</span>
                                    <div class="col-md-12">
                                        <select v-model="campos.respuesta" class="form-control">
                                              <option value="0" >Falso</option>
                                            <option value="0" >Verdadero</option>
                                            </select>                                        
                                    </div>
                                </div>
                               
                     </div>
                       

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-secondary" @click="registroPreguntaFalsoV()">Guadar</button>

                     
                    </div>
                </div>
            </div>
            </div>
</template>

<script>
import Swal from 'sweetalert2';
window.swal = swal;
    export default {
        data (){
			return {
                
                
                inicio:{
                  
                    arrayCategoria: [],
                },
                campos:{
                    enunciado_pregunta: '',
                    id_categoria: 0,
                    respuesta: 0,
                },
            }
        },
        mounted() {
           this.functionInicio();
        },
          props: ['ruta'],
        methods:{
            functionInicio(){
                   $('#modal-pregunta').modal('show');
                 
                     this.selectCategoria();
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
                   registroPreguntaFalsoV(){
                 let me = this;

                axios.post(me.ruta + '/fasoverdadero/registrar',{
                    'campos': me.campos,
                    
                }).then(function (response) {
                $('#modal-pregunta').modal('hide');
               Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)
                }).catch(function (error) {
                    console.log(error);
                });
            
            }
        }
    }
</script>
