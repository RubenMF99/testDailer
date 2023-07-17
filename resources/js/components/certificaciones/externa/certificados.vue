<template>
        <div class="container" style="padding-left:50px; padding-right:80px;">
            <!-- cuadros de cursos -->
            <div   v-for="(itemsP, index) in inicio.arraynew" :key="index" >
                    <p style="text-align:left;font-size:20px;margin-bottom:-15px;"><strong>{{itemsP.categoria.nombre}}</strong></p>
                    <hr style="margin-bottom:40px;">
                    <div style="margin-bottom:50px;" class = "row" v-if="itemsP.contenido_cate.length>0">
                        <!--  -->
                        <div class="col-md-4 espacio" style="cursor:pointer;" v-for="(itemsS, indexs) in itemsP.contenido_cate" :key="indexs" @click="detallecurso(itemsS.url);">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img  class="card-img-top effect-img" style="height:226px;"  :src="'/img/cursos/'+itemsS.imagen" alt="Card image cap" v-if="itemsS.imagen">
                                    <img class="card-img-top effect-img" style="height:226px;" src="/img/cursos/placeholder.png" alt="Card image cap"  v-else>
                                    <img class="img-apoya" style="background:#ffffff;"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-if="itemsS.imagen" >
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-else >
                                    <button class="btn-style-course-cate">Iniciar certificación</button>
                                    <div class="card-body" style="z-index:10;">
                                        <h5 class="card-title" style="font-size:18px;"><strong>{{itemsS.curso}}</strong></h5>
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
        
        detallecurso: function(curso){
            window.location.href = "/certificaciones/"+curso;
        },
        listarcertifi: function(){
            let _this = this;
            let url = '/ListarCertificaciones';
            axios.get(url).then(function(data){
                let response = data.data;
                console.log(response);
                _this.inicio.arraynew = response.certificado;
            }).catch(function(error){alert(error)})
        }
    },
    mounted() {
         this.listarcertifi();   
    }
    
}
</script>