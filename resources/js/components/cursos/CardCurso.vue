<template>
   <div class="course-grid-3 lpr_course post-5428 lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-general pmpro-has-access course">
       <div class="course-item">
            <div class="course-thumbnail">
                <a  v-bind:href="'/cursos/'+ curso.url_curso"  class="thumb" >

               
                <img v-if="curso.imagen_destacada" v-bind:src="'img/cursos/' + curso.imagen_destacada" alt="" v-bind:title="curso.nombre_curso" width="400" height="320">
               <img v-else src="\img\cursos\placeholder.png" alt="" v-bind:title="curso.nombre_curso" width="400" height="320">

                </a>
                <a  v-bind:href="'/cursos/'+ curso.url_curso" class="course-readmore">Leer Mas</a>
                </div>
                 <div class="thim-course-content">
                     <div itemscope="itemscope" itemtype="http://schema.org/Person" class="course-author">
                     <img alt="" src="//www.gravatar.com/avatar/7790ff5d00acbdda5d94cc79016052e5?s=40&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/7790ff5d00acbdda5d94cc79016052e5?s=40&amp;r=g&amp;d=mm 2x" height="40" width="40" class="avatar avatar-40 photo"> 
                     <div class="author-contain">
                         <div itemprop="name" class="value">
                             <a v-bind:href="'/instructor/'+ curso.slug_instructor"><span v-text="curso.primer_nombre+' '+ curso.segundo_nombre+' '+curso.primer_apellido"></span></a>
                             </div>
                             </div>
                             </div> 
                             <h2 class="course-title"><a  v-bind:href="'/cursos/'+ curso.url_curso" rel="bookmark"><span v-text="curso.nombre_curso"></span></a></h2>
                              <div class="course-meta">
                                  <div itemscope="itemscope" itemtype="http://schema.org/Person" class="course-author">
                                  <img alt="" src="//www.gravatar.com/avatar/7790ff5d00acbdda5d94cc79016052e5?s=40&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/7790ff5d00acbdda5d94cc79016052e5?s=40&amp;r=g&amp;d=mm 2x" height="40" width="40" class="avatar avatar-40 photo"> 
                                  <div class="author-contain">
                                      <div itemprop="name" class="value">
                                          <a  v-bind:href="'/instructor/'+ curso.slug_instructor"><span v-text="curso.primer_nombre+' '+ curso.segundo_nombre+' '+curso.primer_apellido"></span></a>
                                          </div>
                                          </div>
                                          </div> 
                                          <div class="course-review">
                                              <label>Review</label>
                                               <div class="value">
                                                    <div class="review-stars-rated">
                                                        <ul class="review-stars">
                                                            <li><span class="fa fa-star-o"></span></li> 
                                                            <li><span class="fa fa-star-o"></span></li> 
                                                            <li><span class="fa fa-star-o"></span></li>
                                                             <li><span class="fa fa-star-o"></span></li>
                                                              <li><span class="fa fa-star-o"></span></li>
                                                              </ul>
                                                               <ul class="review-stars filled" style="width: calc(100% - 2px);">
                                                                   <li><span class="fa fa-star"></span></li>
                                                                    <li><span class="fa fa-star"></span></li>
                                                                     <li><span class="fa fa-star"></span></li>
                                                                      <li><span class="fa fa-star"></span></li>
                                                                       <li><span class="fa fa-star"></span></li>
                                                                       </ul>
                                            </div> <span>(1 review)</span>
                                            </div>
                                            </div>
                                             <div class="course-students">
                                                 <label>Estudiantes</label>
                                                  <div class="value"   v-text="curso.nombre"> </div>
                                                   <span>Estudiantes</span></div>
                                                    <div class="course-comments-count">
                                                        <div class="value">
                                                            <i class="fa fa-comment"></i>5</div>
                                                            </div> 
                                 <div itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer" class="course-price"  v-if="curso.precio || curso.precio_venta ">
                                                            <div itemprop="price" class="value  has-origin"><span class="course-origin-price">$1,960.00</span>
                                                                    <span v-text="'$' + curso.precio"></span>        </div> <meta itemprop="priceCurrency" content="COP"></div>
                                                                            <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" v-else>
                                                                                    <div class="value  free-course" itemprop="price">
                                                                                         Gratis      
                                                                                    </div>
                                                                    <meta itemprop="priceCurrency" content="COP">
                                                                            </div>
                                        </div>
                         <div class="course-description">
                             <p v-html="curso.descripcion"></p>
                             </div> 
                         
                             <div itemprop="offers" itemscope="itemscope" class="course-price" v-if="curso.precio ">
                             <div itemprop="price" class="value  has-origin">
                             
                                 <span class="course-origin-price">$1,960.00</span>
                       <span v-text="'$' + curso.precio"></span>        </div> <meta itemprop="priceCurrency" content="COP"></div>

                       <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
            <div class="value  free-course" itemprop="price">
                        Gratis    </div>
        <meta itemprop="priceCurrency" content="COP">
    </div>
    
                         <div class="course-readmore"><a  v-bind:href="'/cursos/'+ curso.url_curso">Leer Mas</a></div></div></div></div>
</template>

<script>
    export default {
        props: ['curso'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
