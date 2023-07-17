<template>
<div class="col-md-12">

<h4>¿Qué aprenderán los estudiantes en tu curso?</h4>
  <queaprenderan-form  @new="agregarAprederan"
  :ruta= ruta
  :id_curso = 1></queaprenderan-form>

  <queaprenderan-info   v-for="(queaprenderan, index) in inicio.arrayQueAprenderan"
                :key="queaprenderan.id"
                :queaprenderan="queaprenderan"></queaprenderan-info>
</div>
       
</template>

<script>
import toastr from 'toastr'
    export default {
       
          data (){
			return {
                inicio:{
                   arrayQueAprenderan: [],
                   
                }
            }
          },
             props: ['ruta'],
          methods:{
              listarQueAprenderan(){
                let me=this;
                var url= this.ruta + '/listarQueAprenderan';
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayQueAprenderan = respuesta.queaprendiste;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },	
                agregarAprederan(queaprender) {
                     toastr.Success("Guardado con exito");
                this.inicio.arrayQueAprenderan.push(queaprender);
            },
          },
        mounted() {
           this.listarQueAprenderan();
        }
    }
</script>
