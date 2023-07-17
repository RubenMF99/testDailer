<template>
<div>
  <template v-if="pagina_crear == 0">
<div class="container site-content">
   <div class="row">
     <main id="main" class="site-main col-md-12 full-width">
        <div class="entry-content">
        <div  class="row" style="position: relative; left: -104.5px; box-sizing: border-box; width: 1349px;">
        <div class="column column_container col-md-9">
            <div class="column-inner"><div>                
            </div>
        </div>
    </div>
     <div class="wpb_column column_container col-md-3">
    
            <div style="text-align: center;">
                <button @click="parteDos()">Continuar</button>
         
    </div>
</div>
</div>
        </div>
      
      
    <div class="wpb_column column_container col-md-2">
      
    </div>
      <div class="wpb_column column_container col-md-8">
        

<div class="contact-from wow fadeIn">
<div class="xs-from" id="xs-contact-form">
<div class="row">
<div class="col-lg-12">
<div class="form-group">
  <div style="text-align: center;">
<h1 style="font-size:28px;font-weight:normal;font-style:inherit;">¿Por qué no eliges un título temporal?</h1>
<p>No pasa nada si no se te ocurre un buen título en este momento. Puedes cambiarlo más tarde.</p>
  </div>
  <div class="empty_space" style="height:50px"></div>
<div  class="row container" v-if="url">
			<strong>Enlace permanente:  </strong>
<span><a href="https://www.d-academy.co/activity/"><p v-text="'  '+ ruta +''+ nombre_curso"></p></a>
<button type="button" aria-label="Editar el enlace permanente">Editar</button></span></div>
<p>
  <span >
    <input type="text" v-model="nombre_curso" class="form-control"  placeholder="Por ejemplo: aprende Photoshop CS6 desde cero"></span>
</p></div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">

<p>
  <vue-editor v-model="contenido"></vue-editor>
</p></div>
</div>
</div>
</div>
</div>
</div>
     </main>
   </div>
</div>
  </template>
  <div>
  <template v-if="pagina_crear == 1">
<div class="container site-content">
   <div class="row">
     <main id="main" class="site-main col-md-12 full-width">
        <div class="entry-content">
        <div  class="row" style="position: relative; left: -104.5px; box-sizing: border-box; width: 1349px;">
        <div class="column column_container col-md-9">
            <div class="column-inner"><div>                
            </div>
        </div>
    </div>
     <div class="wpb_column column_container col-md-3">
    
            <div style="text-align: center;">
                <button @click="crearCurso()" class="btn-danger">Finalizar</button>
         
    </div>
</div>
</div>
        </div>
      
      
    <div class="wpb_column column_container col-md-2">
      
    </div>
      <div class="wpb_column column_container col-md-8">
        

<div class="contact-from wow fadeIn">
<div class="xs-from" id="xs-contact-form">
<div class="row">
<div class="col-lg-12">
<div class="form-group">
  <div style="text-align: center;">
<h1 style="font-size:28px;font-weight:normal;font-style:inherit;">¿Qué categoría se corresponde mejor con la de los conocimientos que quieres compartir?</h1>
<p>Si no tienes claro cuál es la categoría correcta, puedes cambiarla más adelante.</p>
  </div>
  <div class="empty_space" style="height:50px"></div>
<p><span >
  <select class="form-control" v-model="categoria">
    <option value="0"  selected="selected">Elige una categoria</option>
      <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre_categoria">

      </option>
  </select>
   </span>
</p></div>
</div>
</div>

</div>
</div>
</div>
     </main>
   </div>
</div>
    
  </template>
</div>
</div>

</template>
 
<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor
  },
  props: ['ruta'],
  data() {
    return {
      contenido: '',
      url: '',
      nombre_curso: '',
      arrayCategoria: [],
      categoria: 0,
      pagina_crear: 0,
      nombre_curso: '',
    };
  }, 
  methods:{
    selectCategoria(){
                let me=this;
                var url= this.ruta + '/categoria/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            parteDos(){
              this.pagina_crear = 1;
            },
            obtenerUrl(){
              alert(this.nombre_curso);
            },
            crearCurso(){
              let me = this;

                axios.post(this.ruta + '/cursos/registrar',{
                    'nombre_curso': this.nombre_curso,
                    'contenido': this.contenido,
                     'categoria': this.categoria,
                }).then(function (response) {
               
                }).catch(function (error) {
                    console.log(error);
                });
            }
  },
   mounted() {
            this.selectCategoria();
        }
};
</script>
