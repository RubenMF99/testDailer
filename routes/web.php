<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
/*
|----------------------------------------------------------------------------
| vistas de la app
|----------------------------------------------------------------------------
|
*/
// ------------------------------------------------------------------------
//      Inicio de la pagina 
// ------------------------------------------------------------------------
Route::group(['middleware'=>'homeg'], function(){
    Route::get('/', function () {return view('home');});
});
// ------------------------------------------------------------------------
//      Rutas web sin restricciones
// ------------------------------------------------------------------------
Route::group(['middleware'=>['web']], function(){
    //---------------inicio app---------------------------
    Route::get('/access/login/sing-up',function() { return view('auth.login2');});
    Route::get('/feedback','MailController@feedback');
    Route::get('/ListarIndustrias','CategoriaCursoController@ListarCategorias');
    Route::get('/Busqueda', 'CursoController@ViewCursoscategorias');
    Route::get('/BusquedaFiltrada', 'CursoController@cursos');
    Route::get('listarCursos', 'CursoController@listarCursos');
    Route::get('listarCategoriaCurso','CategoriaCursoController@listarCategoriaCurso');
    Route::get('/Listarcursocate','CategoriaCursoController@Listar_Categoria_curso');
    Route::get('/state-curso/{curso}','CategoriaCursoController@verificarstate');
    Route::get('/Listarcursocate2','CategoriaCursoController@Listar_Categoria_curso2');
    Route::get('curso/{url}','CursoController@CursoDetalles');
    Route::get('/verificar','CursoController@Verifcar');
    Route::get('/ingresarCurso','EstudiantesController@serEstudiante');
    Route::get('/correo','UsuarioController@verificarcorreo');
    Route::get('/pais','PersonaController@ListarPais');
    Route::get('/recuperar-contraseña',function() { return view('recuperacion.index');});
    Route::get('/ciudad','PersonaController@ListarCiudad');
    Route::get('/certificaciones',function(){return view('Certificados.inicio.index');});
    Route::get('ListarCertificaciones','CertificadoController@certificaciones');
    Route::get('/certificaciones/{url}','CertificadoController@detallecertifi'); 
    Route::get('quienes-somos', 'QuienesSomosController@index');
    Route::get('noticias', 'NoticiasController@index');
    Route::get('contacto', 'ContactoController@index');
    // descargar  materia pdf de certificaciones.
    Route::get('/certificacion/savePerson', 'CertificadoController@savePerson');
    Route::get('/certificacion/saveDownload', 'CertificadoController@saveDownload');
    Route::get('/listFiles', 'CertificadoController@listFilesCertificaciones');
    Route::get('/certificacion/epayco/', function() { return view('PasarelaDePago.certificaciones'); });
    // landing 
    // --------
    Route::get('/page/landing-marketing-digital', function(){ return view('Landing.marketing.index'); });
     
    // Route::get('/home', 'HomeController@index')->name('cursos');
    Route::get('/profesion','CursoController@profesiones');
    Route::get('/profesor/login/registrarme', function(){ return view('Instructores.auth'); });
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/usuario/registrar', 'UsuarioController@store');
    Route::post('/enviarcorreo','UsuarioController@enviarcorreo');
    Route::post('/cambiarcontra','UsuarioController@cambiarcontra');
    
});
// ------------------------------------------------------------------------------------------------
//      Rutas de estudiante
// ------------------------------------------------------------------------------------------------
Route::group(['middleware'=>'usu'], function(){
    //-----este es para el estudiante vistas....----------------------
    Route::get('certificado/', function(){ return view('Certificados.index');});
    Route::get('certificado/{url}', function(){ return view('Certificados.id_certificado');});
    Route::get('clase/virtual/{url}','CursoController@Cursando');
    Route::get('listarMisCursos/','CursoController@listarMisCursos');
    Route::get('location/','CursoController@location');
    // rutas de los tipo de cursos que existen, 
    // la cual te llevan a una sola vista que es mis_cursos.blade.php
    // --------------------------------------------------------------
    Route::get('mis-cursos','CursoController@viewcursos');
    Route::get('mis-master-class','CursoController@viewmasterclass');
    Route::get('mis-diplomados','CursoController@viewdiplomados');
    Route::get('mis-certificaciones','CursoController@viewcertificaciones');
    // --------------------------------------------------------------
    Route::get('clase/virtual/introduccion/{url}', 'CursoController@intro');
    Route::get('listarIntro/{url}', 'CursoController@detalleintro');
    Route::get('/listarmodulo', 'ModuloController@ListarModulos');
    Route::get('vista/intro','EstudiantesController@viewintrobool');
    Route::get('/quizmodulo','EstudiantesController@exam');
    Route::get('mis-notas', function(){ return view('Estudiantes.misnotas');});
    Route::get('estudiante/mis-notas','EstudiantesController@notas');
    Route::get('parcial/{url}','CursoController@indexparcial');
    Route::get('/parcial','CursoController@parcial');
    Route::get('/certificados',function(){return view('Estudiantes.miscertificados');});
    Route::get('transacciones/',function(){return view('Estudiantes.transaccion');});
    Route::get('/listarPagos','TransacionController@mistransacciones');
    Route::get('/Dpdf','CertificadoController@descargar_pdf');
    Route::get('/miscertificados','CertificadoController@miscertificados');
    Route::get('perfil',function(){return view('Estudiantes.perfil');})->name('perfil');
    Route::get('/ListarPerfil','EstudiantesController@perfil');
    Route::get('/imagenes','UsuarioController@verImg');
    Route::get('/Home',function(){return view('Estudiantes.home');});
    Route::get('/Repasar','EstudiantesController@repasar');
    Route::get('/modrepasar','ModuloController@listarModRepaso');
    Route::get('transDataPay', 'TransacionController@storeTransaccionCert');
    Route::get('/request-data','UsuarioController@showDataPeople');
    Route::post('/storeintro','EstudiantesController@viewintro');
    Route::post('/notas/registrar','EstudiantesController@gQuiz');
    Route::post('/perfilStore','EstudiantesController@perfilStore');
    Route::post('/saveDataPeople','UsuarioController@dataPersona');
    
    //-----------Inicio transacciones ----------------------------------
    Route::get('respuesta','TransacionController@ViewTrans');
    Route::get('/transData','TransacionController@storeTransaccion');
    // Route::get('/transDataPayCertifi','CertificadoController@savePayCertificacion');
    Route::post('respuesta','TransacionController@index');
    Route::post('/certificacion/epayco/', function() { return view('PasarelaDePago.certificaciones');});
});
// --------------------------------------------------------------------------------------
//      Rutas de administradores
// --------------------------------------------------------------------------------------
Route::group(['middleware'=>'admin'], function(){
// administradores---------------------------
    //-------------peticiones get------------------------
    
    Route::get('listarAdministradores/','UsuarioController@listarAdminitrador');
    Route::get('administradores/','UsuarioController@index');
    Route::get('crear-curso','CursoController@crearCurso');
    Route::get('todoscursos/{url}','CursoController@filtroscursos');
    Route::get('cursos/edit/{url}','CursoController@CursoEditar');
    Route::get('/categoria/selectCategoria','CategoriaCursoController@selectCategoria');
    Route::get('url/{texto}','CursoController@url');
    Route::get('empresa','EmpresaController@index');
    Route::get('listarEmpresa','EmpresaController@listarEmpresa');
    Route::get('/listarQueAprenderan', 'QueAprendaranController@listarQueAprenderan');
    Route::get('/nivel/selectNivel','NivelController@selectNivel');
    Route::get('/idioma/selectIdioma','IdiomaController@selectIdioma');
    Route::get('listarCursosCerrar','CerrarCursoController@listarCursosCerrar');
    Route::get('aprobar','AprobarCursoController@index');
    //----peticiones put-------------------------------------
    Route::put('cursoCerrar/desactivar','CerrarCursoController@desactivarCurso');
    Route::put('cursoCerrar/activar','CerrarCursoController@activarCurso');
    Route::put('estudiante/desactivar','EstudiantesController@desactivarEstudiante');
    Route::put('estudiante/activar','EstudiantesController@activarEstudiante');
    //----peticiones post-------------------------------------
    Route::post('empresa/registrar','EmpresaController@store');
    Route::post('estudiantes/registrar','EstudiantesController@store');
    Route::post('/queaprender/registrar', 'QueAprendaranController@store');
});
// -----------------------------------------------------------------------------------------
//      Rutas de profesores
// -----------------------------------------------------------------------------------------
Route::group(['middleware'=>'profe'], function(){
// Vista para los profesores-------------------------------------
    //------peticiones get--------------------------------------------
    Route::get('bancopreguntas','BancoPreguntaController@index');
    Route::get('/home-profesor', function(){return view('Instructores.index');});
    Route::get('/listarcombos', 'CursoController@listartipocurso');
    Route::get('/listarCursoPE', 'CursoController@listarcursoProfeEliminado');
    Route::get('/listarCursoP', 'CursoController@listarcursoProfe');
    Route::get('instructor/{url}','InstructorController@detalleInstructor');
    Route::get('/listMod', 'ModuloController@Listmod');
    Route::get('selectTipoPregunta','TipoPreguntaController@selectTipoPregunta');
    Route::get('listarBancoPreguntas','BancoPreguntaController@listarBancoPreguntas');
    Route::get('modulos', 'ModuloController@index');   
    Route::get('instructores','InstructorController@index');
    Route::get('listarInstructores','InstructorController@listarInstructores');
    Route::get('cerrar','CerrarCursoController@index');
    Route::get('estudiantes','EstudiantesController@index');
    Route::get('listarEstudiantes','EstudiantesController@listarEstudiantes');
    Route::get('listarCursoMod','ModuloController@listarModulosCursos');
    Route::get('subir-video-youtube',function(){return view('Instructores.subirvideoayoutube');});
    Route::get('/venta-certificaciones','CertificadoController@comprarcertifi'); 
    //--------peticiones put-----------------------------------------------
    //--------peticiones post----------------------------------------------
    Route::post('/instuctores/registrar','InstructorController@store');
    Route::post('/cursos/registrar', 'CursoController@store');
    Route::post('/intro/registrar', 'CursoController@introstore');
    Route::post('/modulo/registrar', 'ModuloController@store');
    Route::post('/exam/store', 'ModuloController@storeQuiz');
    Route::post('/parcial/store', 'ModuloController@storeParcial');
    Route::post('fasoverdadero/registrar','BancoPreguntaController@falsoVerdadero');
    Route::post('/update/curso','CursoController@updateCurso');
    
    
    //----Route::get('/certificado',function(){return view('Estudiantes.certificados',
    //---["estudiante"=>"andres felipe gutierrez","identificacion"=>"1143158522","curso"=>"Diplomnado en negocios digitales","horas"=>"12 Minutos","director"=>"andres monzerrat de la hoz","firma"=>"/img/persona/LOGOBlanco.png","codigobarra"=>"/img/persona/LOGOBlanco.png"]);});
});
//----------------------------------------------------------------------------------








