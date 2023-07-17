/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('feedback-div',require('./components/Inicio/feedback.vue').default);
Vue.component('inicio-categoria',require('./components/Inicio/Categoria.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login-component', require('./components/Login/Login.vue').default);
Vue.component('menu-movil', require('./components/inicio/menumovil.vue').default);
Vue.component('login-profe', require('./components/Login/loginProfe.vue').default);
Vue.component('administradoes-component',require('./components/admins/admins.vue').default);
Vue.component('cursoscate-component',require('./components/cursos/cursocategoria.vue').default);
Vue.component('industrias-lista',require('./components/Buscadores/explorar.vue').default);
Vue.component('input-autocomplete',require('./components/Buscadores/buscarcursos.vue').default);
Vue.component('prueba-component',require('./components/Buscadores/explorar.vue').default);
Vue.component('estudiante-component',require('./components/Estudiante/Estudiante.vue').default);
Vue.component('estudiante-perfil',require('./components/Estudiante/Perfil.vue').default);
Vue.component('instructor-component',require('./components/Instructor/Instructor.vue').default);
Vue.component('mis-cursos',require('./components/Estudiante/miscursos.vue').default);
Vue.component('button-component',require('./components/cursos/button.vue').default);
Vue.component('certificado-component',require('./components/Certificados/certificado.vue').default);
Vue.component('cursando-curso',require('./components/cursos/cursando.vue').default);
Vue.component('mis-notas',require('./components/Estudiante/misnotas.vue').default);
Vue.component('empresa-component',require('./components/Empresa/Empresa.vue').default);
Vue.component('queaprenderan-form',require('./components/queaprenderan/QueAprendaranForm.vue').default);
Vue.component('queaprenderan-info',require('./components/queaprenderan/QueAprenderanInfo.vue').default);
Vue.component('queaprenderan',require('./components/queaprenderan/QueAprendaran.vue').default);
Vue.component('editarcur-component',require('./components/cursos/EditCurso.vue').default);
Vue.component('banco-preguntas',require('./components/BancoPreguntas/BancoPreguntas.vue').default);
Vue.component('crear-falsoverdadero',require('./components/BancoPreguntas/Crear/FalsoVerdadero.vue').default);
Vue.component('crear-opcionmultiple',require('./components/BancoPreguntas/Crear/OpcionMultiple.vue').default);
Vue.component('crear-seleccionmultiple',require('./components/BancoPreguntas/Crear/SeleccionMultiple.vue').default);
Vue.component('todos-cursos',require('./components/cursos/TodosCurso.vue').default);
Vue.component('cursos-cate',require('./components/cursos/cursoscate.vue').default);
Vue.component('intro-cursos',require('./components/cursos/intro.vue').default);
Vue.component('busqueda-cursos',require('./components/cursos/busqueda.vue').default);
Vue.component('pagar-curso',require('./components/cursos/PagarCurso.vue').default);
Vue.component('cerrar-cursos',require('./components/cursos/Cerrar.vue').default);
Vue.component('aprobar-cursos',require('./components/cursos/Aprobar.vue').default);
Vue.component('card-curso',require('./components/cursos/CardCurso.vue').default);
Vue.component('passport-clients',require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue').default);
Vue.component('convert-pdf',require('./components/Convert/PDF.vue').default);
Vue.component('parcial-final',require('./components/cursos/parcial.vue').default);
Vue.component('mis-certificados',require('./components/Estudiante/miscertificados.vue').default);
Vue.component('mis-transacciones',require('./components/Estudiante/mistransacciones.vue').default);
Vue.component('item-curso',require('./components/cursos/itemscursos.vue').default);
Vue.component('recuperar-usuario',require('./components/recuperar/recuperar.vue').default);
Vue.component('view-instructor',require('./components/instructor/instructorview.vue').default);
Vue.component('crear-curso',require('./components/instructor/crearcurso.vue').default);
Vue.component('crear-quiz',require('./components/instructor/crearQuiz.vue').default);
Vue.component('crear-modulo',require('./components/instructor/crearmodulo.vue').default);
Vue.component('crear-masterClass',require('./components/instructor/crearmasterclass.vue').default);
Vue.component('crear-certificado',require('./components/instructor/crearcertificacion.vue').default);
Vue.component('editar-curso-component',require('./components/instructor/editarcurso.vue').default);
Vue.component('modulo-curso',require('./components/instructor/modulos.vue').default);
Vue.component('repasar-curso',require('./components/Estudiante/repaso.vue').default);
Vue.component('certifi-cards',require('./components/certificaciones/externa/certificados.vue').default);
Vue.component('certifi-cards-detalle',require('./components/certificaciones/externa/detalle.vue').default);
Vue.component('certifi-cards-confir',require('./components/certificaciones/externa/confirmacion.vue').default);
Vue.component('descargarpdf-certificaciones',require('./components/certificaciones/externa/descargarpdf.vue').default);
Vue.component('data-people',require('./components/DatosPersonales/dateperson.vue').default);
Vue.component('login-two',require('./components/Login/Login2.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
