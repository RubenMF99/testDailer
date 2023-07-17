





<template>
                            <ul class="sub-menu explorar">
                                <li class="tc-menu-item tc-menu-depth-1 tc-menu-align-left" v-for="(industria, index) in inicio.arrayindustrias" :key="index">
                                    <a  class="tc-menu-inner tc-megamenu-title" @click="buscar_industrias(industria.nombre_categoria);">{{industria.nombre_categoria}}
                                    <i style="float:right;" class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
</template>

<script>
export default {
    data(){
        return{
            inicio:{
                 arrayindustrias:[
                    
                 ],
            }
           
        }
    },  
    props:['ruta'],
    computed:{},
    methods:{
        listar_industrias(){
                let me=this;
                var url= '/ListarIndustrias/';
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     console.log(respuesta);
                     me.inicio.arrayindustrias = respuesta.categoria;
                    // console.log(me.arrayindustrias);
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
              
        },
        buscar_industrias(name){
            window.location.href = "/Busqueda?que_deseas_aprender="+name;
        }
    },
    mounted(){
        // console.log('Component mounted.');
        this.listar_industrias();
    }
}
</script>