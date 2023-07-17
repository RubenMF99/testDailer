<template>
        <div class="container">
            <!-- cuadros de cursos -->
            <div   v-for="(itemsP, index) in inicio.arraynew" :key="index" >
                <div  class="title-course" v-if="itemsP.contenido_cate.length >0">
                        <h2 style="font-weight: 800;" class="text-derecha" v-if="itemsP.contenido_cate.length >0">{{itemsP.categoria.nombre}}</h2>
                        <p style="font-size:18px;" class="text-justificado" v-if="itemsP.categoria.nombre==='Diplomados'&& itemsP.contenido_cate.length >0">Teniendo en cuenta el contínuo cambio 
                            de las diferentes necesidades de las industrias, nuestros diplomados te ayudarán a fortalecer y crear esas 
                            nuevas capacidades que son requeridas actualmente en el mundo laboral. 
                        </p>
                        <p style="font-size:18px;color:#000;" class="text-justificado" v-else-if="itemsP.categoria.nombre==='Cursos'&& itemsP.contenido_cate.length >0">
                            Aprovecha nuestra oferta académica de cursos especializados por industria, acompañado de sus habilidades y experiencias.
                        </p>
                        <p style="font-size:18px;color:#000;" class="text-justificado" v-else-if="itemsP.categoria.nombre==='Master Class'&& itemsP.contenido_cate.length >0">
                            Accede a miles de lecciones de profesionales prominentes mientras comparten sus historias, habilidades, atajos, fracasos y éxitos.
                        </p>
                        <p style="font-size:18px;color:#000;" class="text-justificado" v-else-if="itemsP.categoria.nombre==='Certificaciones'&& itemsP.contenido_cate.length >0">
                            Aprovecha la alianza D-Academy – Certjoin y accede a las mejores certificaciones online, con simuladores y 2 oportunidades para presentar los examenes.
                        </p>
                        <br>
                    </div>
                    <div style="margin-bottom:50px;" class = "row" v-if="itemsP.contenido_cate.length >0">
                        <!--  -->
                        <div class="col-md-4 espacio" style="cursor:pointer;" v-for="(itemsS, indexs) in itemsP.contenido_cate" :key="indexs" @click="detallecurso(itemsS.url);">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:226px;"  :src="'/img/cursos/'+itemsS.imagen" alt="Card image cap" v-if="itemsS.imagen">
                                    <img class="card-img-top effect-img" style="height:226px;" src="/img/cursos/placeholder.png" alt="Card image cap"  v-else>
                                    <img class="img-apoya" style="background:#ffffff;"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-if="itemsS.imagen" >
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-else >
                                    <button class="btn-style-course-cate">Iniciar curso</button>
                                    <div class="card-body" style="z-index:10;">
                                        <h5 class="card-title">{{itemsS.curso}}</h5>
                                        <p class="card-text" >{{ itemsS.descripcion}}</p>
                                        <p class="card-text" > </p>
                                    </div>
                                    <div class="row style-footer-card" >
                                            <div class="col-md-12">
                                                <small class="text-muted" v-if="itemsS.precioventa!='0.00'"><span class="color-ahorro pago">Ahora: ${{itemsS.precioventa}} USD </span><span class="antes" v-if="itemsS.precio!='0.00'"> Antes: ${{itemsS.precio}}USD </span></small>
                                                <small class="text-muted" v-if="itemsS.precioventa=='0.00'"><span class="color-ahorro gratis"><i class="fas fa-check"></i> Ahora: Gratis </span><span class="antes" v-if="itemsS.precio=='0.00'"></span></small>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div @click="filtro(itemsP.categoria.nombre);" class="btn-mostrar-mas-marterclass" style="" v-if="itemsP.contenido_cate.length >0">
                                Ver todos los {{itemsP.categoria.nombre}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</template>
<script>
export default {
    data(){
        return{
            inicio:{
                arraynew:[
                ],
            }
        }
    },
    props:['ruta'],
    computed:{
    },
    methods:{
        listar_curso_categoria(){
                let me=this;
                var url= '/Listarcursocate/';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.inicio.arraynew = respuesta.Curos_Categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        filtro(curso){
            window.location.href = "/Busqueda?que_deseas_aprender="+curso;
        },
        detallecurso(curso){
            window.location.href = "/curso/"+curso;
        }
    },
    mounted() {
            this.listar_curso_categoria();
    }
    
}
</script>