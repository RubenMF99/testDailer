<template>
<div class="container" style="margin-top:50px;">
<template v-if="view">
            <!-- cuadros de cursos -->
            <div class="col-md-3 espacio col-xs-12" style="margin-bottom:10px;"  v-for="(itemsP, index) in inicio.arraynew" :key="index">
                <div class="card-deckZ">
                    <div class="card">
                                    <!--  -->
                                    <img class="card-img-top" style="height:200px;" :src="itemsP.categoria.url_imagen" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size:20px;">{{itemsP.categoria.nombre}}</h5>
                                        <p>{{itemsP.categoria.descripcion}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                
                                                <button @click="verCursosODiplo(itemsP.categoria.nombre,index)">Ver todo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
            </div>
</template>
<template  v-else>

            <!-- cuadros de cursos -->
            <div style="margin-bottom:10px;" v-for="(itemsP, index) in inicio.arraynew2" :key="index" >
                <div class="col-md-12" style=" margin-bottom:30px;border-bottom:2px solid #3490dc;">
                    <div class="row">
                        <div class="title-course col-md-6">
                                <h2 class="text-derecha" > <span style="">{{itemsP.categoria.nombre}}</span> </h2>
                        </div>
                        <div class="col-md-6">
                            <button style="background:#fff;border-radius:8px; color:#337ab7;float:right; bottom:-26px;position:relative;" @click="volver">Volver</button>
                        </div>
                        
                    </div>
                </div>
                
                    <div class = "row home-estu" >
                        <!--  -->
                        <div class="col-md-3 espacio col-sm-12" style="cursor:pointer;" v-for="(itemsS, indexs) in itemsP.contenido_cate" :key="indexs" @click="detallecurso(itemsS.url);">
                            <div class="card-deckZ">
                                <div class="card">
                                    <!--  -->
                                    <img class="card-img-top" style="height:226px;"  :src="'/img/cursos/'+itemsS.imagen" alt="Card image cap" v-if="itemsS.imagen">
                                    <img class="card-img-top" style="height:226px;" src="/img/cursos/placeholder.png" alt="Card image cap"  v-else>
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-if="itemsS.imagen" >
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-else >
                                    <button class="btn-style-course-cate">Entrar</button>
                                    <div class="card-body">
                                        <h5 class="card-title">{{itemsS.curso}}</h5>
                                        <p class="card-text" >{{ itemsS.descripcion}}</p>
                                        <p class="card-text" > </p>
                                    </div>
                                    <div class="row style-footer-card" >
                                            <div class="col-md-12">
                                                <small class="text-muted" v-if="itemsS.precioventa!='0.00'"><span class="color-ahorro pago">Ahora: ${{itemsS.precioventa}} </span><span class="antes" v-if="itemsS.precio!='0.00'"> Antes: ${{itemsS.precio}} </span></small>
                                                <small class="text-muted" v-else><span class="color-ahorro gratis">Gratis </span></small>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                </template>    
    </div>
</template>
<script>
export default {
    data(){
        return{
            inicio:{
                arraynew:[
                ],
                arraynew2:[
                ],
            },
            view:Boolean(1),
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
        volver(){
            this.view = Boolean(1);
        },
        verCursosODiplo(value, scrolltab){
                let me=this;
                var url= '/Listarcursocate2?categoria='+value;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.inicio.arraynew2 = respuesta.Curos_Categorias;
                    if(scrolltab!==0){
                        window.scrollTo(0,0);
                    }
                    me.view = Boolean(0);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        filtro(curso){
            window.location.href = "/Busqueda?que_deseas_aprender="+curso;
        },
        detallecurso(curso){
            var url= '/location?course='+curso;
            axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta);
                    var tipo_curso = respuesta.datos[0].id_tipo_curso;
                    if(tipo_curso===1)
                    {
                        window.location.href = "/mis-diplomados";
                    }
                    else if(tipo_curso===2)
                    {
                        window.location.href = "/mis-cursos";
                    }
                    else if(tipo_curso===3)
                    {
                        let urlNew = "/state-curso/"+respuesta.datos[0].id;
                        axios.get(urlNew).then(function (response){
                            var resp = response.data;
                            if(resp.state !== 2){
                                window.location.href = "/clase/virtual/introduccion/"+curso;
                            }else{
                                window.location.href = "/certificados";
                            }
                        }).catch();
                         
                        //window.location.href = "/mis-master-class";
                    }
                    else if(respuesta.datos.id_tipo_curso===4)
                    {
                        window.location.href = "/mis-certificaciones";
                    }
                    else if(respuesta.datos==='ninguno')
                    {
                        window.location.href = "/curso/"+curso;
                    }
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            
        }
    },
    mounted() {
            this.listar_curso_categoria();
    }
    
}
</script>