<template>
        <button class="ddco-btn-banners ddco-btn-segundary" @click="Registrar();" v-text="text" v-if="view==1"></button>
        <button class="ddco-btn-banners ddco-btn-primary"  @click="vercerti();" v-text="text" v-else-if="view==2"></button>
        <button class="ddco-btn-banners ddco-btn-primary" @click="vercursos();" v-text="text" v-else-if="view==3"></button>
</template>
<script>
export default {
    props:['text','tourl'],
    data(){
        return {
            view:1,
            value:'',
        }
    },
    methods:{
        Registrar(){
           document.getElementById('R').click();
        },
        vercursos(){
            window.location.href = "/Busqueda?que_deseas_aprender=cursos";
        },
        vercerti(){

        },
        verificar(){
            if(this.tourl===""||this.tourl===undefined||this.tourl === null){}else{
                this.view = parseInt(this.tourl);
            }
           
        },
        btnClass(){
            (screen.width <= 870) ? document.getElementById("btn").classList.add("center"):"" ;
        }
    },
    mounted(){
        this.verificar();
        this.btnClass();
    },
    computed:{}
}
</script>