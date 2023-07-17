<template>
   <div>
       <pdf :src="ruta"></pdf>
   </div>
</template>
<script>

export default {
    props:
        ['ruta']
    ,
    data(){
        return{
            pdf,
        }
    },

    computed:{

    },
    mounted(){

    },
    
}
</script>