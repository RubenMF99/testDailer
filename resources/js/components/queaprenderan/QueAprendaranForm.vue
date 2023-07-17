<template>
<span class="input-group">
    <input placeholder="Ejemplo: Fotografía con poca luz"  class="form-control" v-model="descripcion" @keyup.enter="registararQueAprenderas()"></span>    
       
</template>

<script>
import toastr from 'toastr'
    export default {
        data(){
            return{
                descripcion: '',
            }
        },
           props: ['ruta','id_curso'],
           methods:{
               registararQueAprenderas(){
                    let me = this;

                axios.post(this.ruta + '/queaprender/registrar',{
                    'descripcion': this.descripcion,
                    'id_curso': this.id_curso,
                }).then(function (response) {
                        const queaprender = response.data;
                       toastr.error('Hi, there!');
               me.$emit('new', queaprender);
                }).catch(function (error) {
                    console.log(error);
                 
                });
            },
            
               },
          
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
