<template>
<span class="input-group">
    <input placeholder="Ejemplo: Fotografía con poca luz"  class="form-control" disabled="disabled" v-model="queaprenderan.descripcion">
    <span class="input-group-btn">
        <button type="button" class="btn btn-default"><span class="fa fa-trash"></span>
        </button>
        <button type="button"  class="btn btn-default" ><span class="fa fa-edit"></span></button></span>
    </span>
         
       

</template>

<script>
    export default {
        props: ['ruta','queaprenderan'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
