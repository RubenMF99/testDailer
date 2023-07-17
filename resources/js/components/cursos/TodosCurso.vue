<template>
<div>


<div class="row" style="transform: none;"><main id="main" class="site-main col-sm-9 alignleft">

    
<article  class="post-0 post type-post status-publish format-standard hentry pmpro-has-access page type-page">
    <div class="entry-content">
        


    <div id="lp-archive-courses" data-all-courses-url="https://www.d-academy.co/courses/">

			<div class="thim-course-top switch-layout-container ">
		<div class="thim-course-switch-layout switch-layout">
			<a href="#" @click="cambiarSwitchto()" class="list switchToGrid "  :class="switchTo ? 'switch-active' : ''"><i class="fa fa-th-large"></i></a>
			<a href="#" @click="cambiarSwitchto()" class="grid switchToList"  :class="switchTo ? '' : 'switch-active'"><i class="fa fa-list-ul"></i></a>
		</div>
		<div class="course-index">
			<span v-text="'Mostrando  '+ pagination.from+' - '+pagination.to+' De '+ pagination.total+ ' resultados'">Showing 1-9 of 19 results</span>
		</div>
				<div class="thim-course-order">
				<select v-model="criterio">
					<option value="nombre_curso">Nombre Curso</option>
					<option value="alphabetical">Alphabetical</option>
					<option value="most-members">Most members</option>				
					</select>
			</div>
				<div class="courses-searching">
			<form >
				<input type="text" placeholder="Buscar Cursos" class="form-control course-search-filter" v-model="buscar" autocomplete="off" @keyup.enter="listarCursos(1,buscar,criterio,arrayCategorias)">
				<button type="submit"  @click="listarCursos(1,buscar,criterio,arrayCategorias)"><i class="fa fa-search"></i></button>
				<span class="widget-search-close"></span>
			</form>
			<ul class="courses-list-search list-unstyled"></ul>
		</div>
	</div>
<div id="" data-cookie="grid-layout"   :class="switchTo ? 'thim-course-grid' : 'thim-course-list'" >
	<card-curso  v-for="(curso, index) in inicio.arrayCursos"
                :key="curso.id"
                :curso="curso"></card-curso>


</div>

	


<nav class="learn-press-pagination navigation pagination">
    <ul class="page-numbers">
	<li v-if="pagination.current_page > 1"> <a class="prev page-numbers" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio,arrayCategorias)"></a></li>
	<li  v-for="page in pagesNumber" :key="page" ><a class="page-numbers" :class="[page == isActived ? 'current' : '']" href="#" @click.prevent="cambiarPagina(page, buscar,criterio,arrayCategorias)" v-text="page"></a></li>
	<li v-if="pagination.current_page < pagination.last_page"><a class="next page-numbers"  href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio,arrayCategorias)"></a></li>
</ul>
</nav>

</div>            </div><!-- .entry-content -->

</article><!-- #post-## -->

    
</main>
<div id="sidebar" class="widget-area col-sm-3 sticky-sidebar sidebar_header_v4" role="complementary" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
	
		
		
	
	<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">
		<div style="text-align: center; margin: 10px;">
		<!--<button class="btn-info" @click="crearCurso()">CREAR CURSO</button>-->
		</div>
		<aside class="thim-course-filter-wrapper">
			<form name="thim-course-filter"  class="thim-course-filter">
				
					<h4 class="filter-title">Cursos por Categorias</h4>

					<ul class="list-cate-filter">
						<li class="term-item" v-for="categoria in inicio.arrayCategoriaCurso" :key="categoria.id">
                
									<input type="checkbox"    :data-id="categoria.slug" :value="categoria.slug"  v-model="arrayCategorias">
																<label :data-id="categoria.slug" v-text="categoria.nombre_categoria +' ('+ categoria.numero+')'">
																
								</label>
								
								
							</li>
										
												</ul>
										<h4 class="filter-title">Instructores</h4>
											<ul class="list-instructor-filter">
															<li class="instructor-item">
									<input type="checkbox" name="course-instructor-filter" id="instructor-id_2" value="2">
									<label for="instructor-id_2">
										Mgs. Mario Fernando Prada										<span>(2)</span>
									</label>
								</li>
																<li class="instructor-item">
									<input type="checkbox" name="course-instructor-filter" id="instructor-id_1" value="1">
									<label for="instructor-id_1">
										master-dacademy										<span>(17)</span>
									</label>
								</li>
														</ul>
											<h4 class="filter-title">Precios</h4>

					<ul class="list-price-filter">
						<li class="price-item">
							<input type="radio" id="price-filter_all" name="course-price-filter" value="all" checked="">
							<label for="price-filter_all">
								All								<span>(19)</span>
							</label>
						</li>
						<li class="price-item">
							<input type="radio" id="price-filter_free" name="course-price-filter" value="free">
							<label for="price-filter_free">
								Free								<span>(2)</span>
							</label>
						</li>
						<li class="price-item">
							<input type="radio" id="price-filter_paid" name="course-price-filter" value="paid">
							<label for="price-filter_paid">
								Paid								<span>(17)</span>
							</label>
						</li>
					</ul>
					
				<div class="filter-submit">
					<button type="button"  @click="listarCursos(1,buscar,criterio,arrayCategorias)">Buscar</button>
				</div>
			</form>
		</aside>
		<aside id="course-categories-3" class="widget widget_course-categories" style="display: none;">
			<div class="thim-widget-course-categories thim-widget-course-categories-base template-base-v3"><h4 class="widget-title">All Courses</h4>
<ul>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/backend/">Backend</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/css/">CSS</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/frontend/">Frontend</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/general/">General</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/it-software/">IT &amp; Software</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/photography/">Photography</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/programming-language/">Programming Language</a>
                                </li>
            <li>
            <a href="https://www.d-academy.co/curso-categoría/technology/">Technology</a>
                                </li>
    </ul>
</div></aside><aside id="courses-7" class="widget widget_courses"  style="display: none;"><div class="thim-widget-courses thim-widget-courses-base template-list-sidebar-v3"><h4 class="widget-title">Latest Courses</h4>	<div class="thim-course-list-sidebar">
					<div class="lpr_course has-post-thumbnail">
				<div class="course-thumbnail"><img src="https://www.d-academy.co/wp-content/uploads/2015/11/course-4-150x150.jpg" alt="Diplomado en Negocios Digitales"></div>				<div class="thim-course-content">
					<h3 class="course-title">
						<a href="https://www.d-academy.co/cursos/negocios-digitales/"> Diplomado en Negocios Digitales andres feliep</a>
					</h3>
											
<div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <div class="value  has-origin" itemprop="price">
                                            <span class="course-origin-price">$1,960.00</span>
                        $1,765.00        </div>
        <meta itemprop="priceCurrency" content="COP">
    </div>									</div>
			</div>
					<div class="lpr_course has-post-thumbnail">
				<div class="course-thumbnail"><img src="https://www.d-academy.co/wp-content/uploads/2015/11/course-4-150x150.jpg" alt="Diplomado en Marketing y Ventas en Entornos Digitales"></div>				<div class="thim-course-content">
					<h3 class="course-title">
						<a href="https://www.d-academy.co/cursos/marketing-y-ventas/"> Diplomado en Marketing y Ventas en Entornos Digitales</a>
					</h3>
											
<div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <div class="value  has-origin" itemprop="price">
                                            <span class="course-origin-price">$1,960.00</span>
                        $1,765.00        </div>
        <meta itemprop="priceCurrency" content="COP">
    </div>									</div>
			</div>
					<div class="lpr_course has-post-thumbnail">
				<div class="course-thumbnail"><img src="https://www.d-academy.co/wp-content/uploads/2015/06/course-2-150x150.jpg" alt="Become a PHP Master and Make Money"></div>				<div class="thim-course-content">
					<h3 class="course-title">
						<a href="https://www.d-academy.co/cursos/become-a-php-master-and-make-money-fast/"> Become a PHP Master and Make Money</a>
					</h3>
											
<div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <div class="value  has-origin" itemprop="price">
                                            <span class="course-origin-price">$80.00</span>
                        $69.00        </div>
        <meta itemprop="priceCurrency" content="COP">
    </div>									</div>
			</div>
			</div>
</div></aside>
</div>
</div>
</div>
</div>
</template>

<script>
    export default {
		data (){
			return {
				
			
				switchTo: true,
				arrayCategorias:[],
				arrays:[],
				buscar: '',
				criterio: '',
				inicio:{
					arrayCursos: [],
					arrayCategoriaCurso: [],
				},
				  pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,

			}
		},props:['curso'],
		 computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
	 methods : {
		
		listarCursos(page,buscar,criterio="200", data= []){
                let me=this;
                var url= 'listarCursos?page=' +page + '&buscar='+ buscar + '&criterio='+ criterio + '&data='+ data;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.arrayCursos = respuesta.cursos.data;
                    me.pagination= respuesta.pagination;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },	
			listarCategoriaCurso(){
                let me=this;
                var url= 'listarCategoriaCurso';
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					me.inicio.arrayCategoriaCurso = respuesta;
					//   console.log(respuesta);
               
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },	
cambiarPagina(page, buscar,criterio,arrayCategorias){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCursos(page, buscar,criterio,arrayCategorias);
            },
			cambiarSwitchto(){
				   let me = this;
				if(me.switchTo == true){
					me.switchTo = false
				}else{
					me.switchTo = true;
				}
			},
			crearCurso(){
			  window.open('/crear-curso','_self');
			}
		},
        mounted() {

			// this.arrays = '<?php echo $cursos?>';

            this.listarCursos(1,this.buscar,this.criterio);
			// this.listarCategoriaCurso();

		
        }
    }
</script>

