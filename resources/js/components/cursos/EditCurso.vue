<template>
<div>
<header id="masthead" class="site-header bg-custom-sticky sticky-header header_overlay header_v4 affix" style="
    background: #ff9700;
">
			<!-- <div class="main-menu"> -->
<div class="thim-nav-wrapper container">
	<div class="row">
		<div class="navigation col-md-12">
			<div class="tm-table">
            <div class="col-md-2">
            <a  href="/instructor/courses" aria-label="Volver a los cursos">
            <span class="">Volver a los cursos</span></a>
            </div>
            <div class="col-md-8">
            <h4 style="
    color: #fff;
">Diplomado en Marketing y Ventas en Entornos Digitales</h4>
            </div>
            <div class="col-md-2">
            <button> Guardar</button>
            </div>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>		</header>
<div class=""><div class="col-md-12" data-purpose="side-menu" style="
    padding-top: 92px;">
    <div class="col-md-3">
    <div class="nav-container">
    <ul class="nav-steps nav nav-tabs nav-stacked">
    <li class="active sub-nav">
    <strong class="sub-nav__title">Planifica tu curso</strong>
    <div class="nav-container">
    <ul class="nav">
    <li role="presentation"  v-bind:class="{'active':(cambiarPagina === 1)}">
    <a  href="#" @click="funcionCambiarPagina(1)">Llega a tus estudiantes</a>
    </li>
    </ul>
    </div>
    </li>
    <li class="active sub-nav">
    <strong class="sub-nav__title">Crea tu contenido</strong>
    <div class="nav-container">
    <ul class="nav">
 
    <li role="presentation" v-bind:class="{'active':(cambiarPagina === 2)}">
    <a href="#"  @click="funcionCambiarPagina(2)">Programa</a>
    </li>
   
    </ul>
    </div>
    </li>
    <li class="active sub-nav">
    <strong class="sub-nav__title">Publica tu curso</strong>
    <div class="nav-container">
    <ul class="nav">
    <li role="presentation" v-bind:class="{'active':(cambiarPagina === 3)}">
    <a  href="#" @click="funcionCambiarPagina(3)">Página de inicio del curso</a>
    </li>
    <li role="presentation" v-bind:class="{'active':(cambiarPagina === 4)}">
    <a  href="#" @click="funcionCambiarPagina(4)">Precios</a>
    </li>
   
    <li role="presentation" v-bind:class="{'active':(cambiarPagina === 5)}">
    <a  href="#" @click="funcionCambiarPagina(5)">Mensajes del curso</a>
    </li>
    </ul>
    </div>
    </li>
    </ul>
    </div>
<div class="side-nav--publish-button--yW0v1">
    <button type="button" class="btn btn-lg btn-primary">Enviar para revisión</button></div>
</div>
<div class="col-md-9" style="
    background: #ffff;
    box-shadow: black;
    box-shadow: 5px 10px 5px 10px #00000036;
"><div class="container row col-md-12">
    <template v-if="cambiarPagina == 1">
        <div class="row container col-md-12" style="margin: 21px;">
<h2>Llega a tus estudiantes</h2>
       
  <queaprenderan :ruta = ruta></queaprenderan>

    <queaprenderan :ruta = ruta></queaprenderan>
      <queaprenderan :ruta = ruta></queaprenderan>
     
         </div>
          
           

    
    </template>
      <template v-else-if="cambiarPagina == 2">
           <h1>Hola mundo 2</h1>
      </template>
       <template v-else-if="cambiarPagina == 3">
           <div class="row container col-md-12" style="margin: 21px;">
               <h2>Página de inicio del curso</h2>
               <div class="form-group col-md-12">
                   <label for="title" class="control-label">Título del curso</label>
                   <div class="form-control-counter-container">
                       <input placeholder="Inserta el nombre de tu curso." v-model="curso_edit.nombre_curso" class="form-control">
        </div></div>
          <div class="form-group col-md-12">
                   <label for="title" class="control-label">Subtítulo del curso</label>
                   <div class="form-control-counter-container">
                       <input placeholder="Inserta el subtitulo de tu curso." maxlength="60" class="form-control">
        </div></div>
          <div class="form-group col-md-12">
                   <label for="title" class="control-label">Subtítulo del curso</label>
                   <div class="form-control-counter-container">
                          <vue-editor v-model="curso_edit.descripcion"></vue-editor>
        </div></div>
           <div class="form-group col-md-12">
                   <label for="title" class="control-label">Inforacion básica</label>
                   <div class="form-control-counter-container">
                       <div class=" col-md-4">
                           <select class="form-control" v-model="curso_edit.id_categoria">
                               <option value="0"  selected="selected">Elige una categoria</option>
      <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre_categoria"></option>
                           </select>
                       </div>
                          <div class=" col-md-4">
                          <select class="form-control">
                               <option value="0"  selected="selected">Elige un nivel</option>
      <option v-for="nivel in arrayNiveles" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre_niveles"></option>
                           </select>
                       </div>
                          
                             <div class=" col-md-4">
                            <select class="form-control">
                               <option value="0"  selected="selected">Elige un idioma</option>
      <option v-for="idioma in arrayIdiomas" :key="idioma.id" :value="idioma.id" v-text="idioma.nombre_idioma"></option>
                           </select>
                       </div>
                       
                          
                          
                         
        </div>
        
        </div>
  <div class="form-group">
      <div class="col-md-6">
          <label for="title" class="control-label">Imagen del curso</label>
          <img src="http://localhost:8000/img/cursos/placeholder.png" alt="" style="">
      </div>
       <div class="col-md-6">
           <input type="file" class="form-control  " @change="cambiarImagen($event)">
  </div>
  </div>
           </div>
      </template>
       <template v-else-if="cambiarPagina == 4">
           <h1>Hola mundo 4</h1>
      </template>
       <template v-else-if="cambiarPagina == 5">
           <h1>Hola mundo 5</h1>
      </template>
</div>
</div></div></div>
</div>


</template>

<script>
import { VueEditor } from "vue2-editor";
    export default {
          components: {
    VueEditor
  },
        data(){
            return{
                cambiarPagina: 0,
                arrayCategoria: [],
                arrayNiveles: [],
                arrayIdiomas: [],
                imagen: '',
                curso_edit:{
                    nombre_curso: '',
                    descripcion: '',
                    id_categoria: 0,
                    id_instructor: 0,
                    id_nivel: 0,
                    id_tipo_duracion: 0,
                    subtitulo_curso: '',
                },
            }
        },
          props: ['ruta','curso'],
        methods:{
            funcionCambiarPagina(pagina){
                this.cambiarPagina = pagina;

            },
            cambiarImagen(event){
                this.imagen = event.target.files[0];
                
    var filePath = this.imagen.value;
    console.log(filePath);
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
      
    }
            },
            obtenerVariables(){
                this.curso_edit.nombre_curso = this.curso[0].nombre_curso;
                this.curso_edit.descripcion = this.curso[0].descripcion;
                this.curso_edit.id_categoria = this.curso[0].id_categoria;
                this.curso_edit.id_instructor = this.curso[0].id_instructor;
                this.curso_edit.id_nivel = this.curso[0].id_nivel;
                this.curso_edit.id_tipo_duracion = this.curso[0].id_tipo_duracion;
                this.curso_edit.subtitulo_curso = this.curso[0].subtitulo_curso;
                           
            },
            
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
             selectNivel(){
                let me=this;
                var url= this.ruta + '/nivel/selectNivel';
                axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    me.arrayNiveles = respuesta.niveles;
              
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
 selectIdioma(){
                let me=this;
                var url= this.ruta + '/idioma/selectIdioma';
                axios.get(url).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    me.arrayIdiomas = respuesta.idiomas;
              
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

        },
        mounted() {
            this.obtenerVariables();
           this.selectCategoria();
           this.selectNivel();
           this.selectIdioma();
        }
    }
</script>

