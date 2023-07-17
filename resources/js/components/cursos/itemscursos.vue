
<!-- <template>
    <div style="margin-bottom:10px;" v-for="(itemsP, index) in inicio.arraynew" :key="index" >
                <div class="col-md-12" v-if="itemsP.contenido_cate.length >0">
                            <div class="boton-left" @click="verCursosODiplo(itemsP.categoria.nombre,index)">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                <div class="title-course" v-if="itemsP.contenido_cate.length >0">
                        <h2 class="text-derecha" > <span style="border-bottom:2px solid #3490dc;">{{itemsP.categoria.nombre}}</span> </h2>
                    </div>
                    <div class="row home-estu"  v-if="itemsP.categoria.nombre">
                        
                        <div class="col-md-4 espacio col-sm-12" style="cursor:pointer;" v-for="(itemsS, indexs) in itemsP.contenido_cate" :key="indexs" @click="detallecurso(itemsS.url);">
                            <div class="card-deckZ">
                                <div class="card">
                                    
                                    <img class="card-img-top" style="height:210px;"  :src="'/img/cursos/'+itemsS.imagen" alt="Card image cap" v-if="itemsS.imagen">
                                    <img class="card-img-top" style="height:210px;" src="/img/cursos/placeholder.png" alt="Card image cap"  v-else>
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-if="itemsS.imagen" >
                                    <img class="img-apoya"  :src="'/img/Socios/apoyan_cursos/'+itemsS.imgapoya" alt="Card image cap" v-else >
                                    <div class="card-body">
                                        <h5 class="card-title">{{itemsS.curso}}</h5>
                                        <p class="card-text" >{{ itemsS.descripcion}}</p>
                                        <p class="card-text" > </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <small class="text-muted" v-if="itemsS.precioventa!='0.00'"><span class="color-ahorro">Ahora: ${{itemsS.precioventa}} </span><span class="antes" v-if="itemsS.precio!='0.00'"> Antes: ${{itemsS.precio}} </span></small>
                                                <small class="text-muted" v-else><span class="color-ahorro">Gratis</span></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> 
</template>