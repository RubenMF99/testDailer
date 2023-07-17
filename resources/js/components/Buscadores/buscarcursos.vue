<template>
<li id="buscador"  class="tc-menu-item tc-menu-depth-1 tc-menu-align-left">
        <input type="text" class="text-buscar" name="autocomplete" v-model="autocomplete" @input="change" @keyup.enter="enter();"  placeholder="¿Que deseas aprender?" >
        <button id="btnbuscar" class="btn-buscar">
            <i class="fas fa-search"></i>
        </button>
        <div>
            <ul class="lista-cursos"  v-if="mostrar">
            <li  v-for="(curso, index) in resultado" :key="index" @click="integrar(index);">
                <div class="row">
                    <div class="col-md-2 ddco-col-md-2">
                        <img v-if="curso.imagen_destacada" class="foto" v-bind:src="'/img/cursos/'+curso.imagen_destacada" alt="">
                   <img v-else class="foto" src="\img\cursos\placeholder.png" alt="">
                    </div>
                    <div class="col-md-10 ddco-col-md-10">
                        {{curso.nombre_curso}} 
                    </div>
                </div>
                   <hr style="margin-top:-2px; margin-bottom:-2px;">
            </li>
            </ul>
        </div>
</li>
</template>
<script>
export default {
    data(){
        return{
            autocomplete:'',
            mostrar:false,
            buscar: '',
            paglength:'100',
            criterio: '',
            inicio:{
                arrayMisCursos:[],
            },
            
        }
    },props:['ruta'],
    methods:{
       change(){
           if(!this.mostrar){
               this.mostrar = true;
           }
           if(this.autocomplete === "")
           {
               this.mostrar = false;
           }
           if(this.resultado <= 0)
           {
               this.mostrar = false;
               
           }
       },
       integrar(index){
           let me = this;
           me.autocomplete = me.resultado[index].nombre_curso;
           me.mostrar = false;
           me.buscarData(me.autocomplete);
       },
       enter(){
           let me = this;
           me.buscarData(me.autocomplete);
       },
        buscarData(name){
            window.location.href = "/Busqueda?que_deseas_aprender="+name;
        },
       listarCursos(page,buscar,criterio="200", data= []){
                let me=this;
                var url= 'listarCursos?page=' +page + '&buscar='+ buscar + '&criterio='+ criterio + '&data='+ data;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.inicio.arrayMisCursos = respuesta.cursos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }

    },
    computed:{
        resultado(){
            return this.inicio.arrayMisCursos.filter(el => {
                return el.nombre_curso.toLowerCase().includes(this.autocomplete.toLowerCase());
            });
            
        }
    },
    mounted(){
      this.listarCursos();
        // console.log("Component mounted.");
       
    }
}
</script>
<style scoped>
.foto{
    margin-top: 10px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.lista-cursos{
    margin-top: 0px;
    display: block;
    padding: 10px;
    background: #ffffff;
    box-shadow: 0 1px 5px -1px rgba(0,0,0,.3);
    -webkit-box-shadow: 0 1px 5px -1px rgba(0,0,0,.3);
    overflow: auto;
    max-height: 350px;
    overflow-x: hidden;
    float: left;
    position: absolute;
}
.lista-cursos li{
    width: 400px !important;
    list-style: none;
    cursor: pointer;
}
.lista-cursos li span{
    font-size: 16px;
line-height: 20px;
height: 5px;
color: #333;
}

</style>