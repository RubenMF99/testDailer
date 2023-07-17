<template>
<div class="col-md-12" style="background:#fff;padding:10px;">
    <div class="col-md-12" style="border-bottom:2px solid #808080;margin-bottom:10px;">
        <div class="col-md-1">
        <strong>#</strong>
        </div>
        <div class="col-md-7">
        <strong>Nombre del curso</strong>
        </div>
        <div class="col-md-2">
            <strong>Estado</strong>
        </div>
        <div class="col-md-2">
            <strong>Acción</strong>
        </div>
    </div>
    <!-- dinamico -->
    <div class="col-md-12 table-style" style="padding:10px;" v-for="(item, index) in ListCursoMod" :key="index">
        <div class="col-md-12">
            <div class="col-md-1">
            <strong>{{index+1}}</strong>
            </div>
            <div class="col-md-7">
            <strong>{{item.nombre_curso}}</strong>
            </div>
            <div class="col-md-2">
                <strong v-if="item.estado_curso===1">Activo</strong>
                <strong v-if="item.estado_curso===2">Bloqueado</strong>
                <strong v-if="item.estado_curso===3">Eliminado</strong>
            </div>
            <div class="col-md-2 center">
                <div class="col-md-12" v-if="item.modulos.length>0">
                    <i style="color:#FF9700;cursor:pointer;" :id="'btnS'+item.id" class="fas fa-chevron-down" @click="ver(item.id)" ></i>
                    <i style="color:#FF9700;cursor:pointer;" :id="'btnH'+item.id" class="fas fa-chevron-up hide" @click="ocultar(item.id)" ></i>
                </div>
                <div v-else>
                    <i style="color:#FF9700; cursor:pointer;" class="fas fa-plus" @click="showAdd(item.id, item.nombre_curso)"></i>
                </div>
                
            </div>
        </div>
        <!-- modulos que pertenecen a este curso -->
        <div class="col-md-12 hide" :id="'div'+item.id" style="border:2px solid rgba(0, 0, 0, 0.1);background:#fff;padding-top:10px; padding-bottom:10px;" v-if="item.modulos.length>0">
            <p style="border-bottom:2px solid #808080;"><strong><i style="font-size:10px;" class="fas fa-circle"></i> Modulo(s)</strong></p>
            <div class="col-md-12" style="margin-bottom:10px;" v-for="(itemS, indexs) in item.modulos" :key="indexs">
                <div class="col-md-1">
                <strong>{{indexs+1}}</strong>
                </div>
                <div class="col-md-2">
                <strong style="text-align:justify;">{{itemS.modulo.nombre}}</strong>
                </div>
                <div class="col-md-7">
                    <strong v-html="itemS.modulo.objetivo"></strong>
                </div>
                <div class="col-md-2 center">
                    <i style="cursor:pointer;" class="fas fa-edit" @click="abrirModal(itemS, item.nombre_curso)"></i>
                </div>
            </div>
             
            
        </div>
    </div>
    <div class="col-md-12 center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-if="paginate.current_page > 1" aria-label="Atras" >
                        <a class="page-link" href="#" @click="changePage(paginate.current_page-1)">
                            <span aria-hidden="true">Atras</span>
                        </a>
                    </li>
                    <li class="page-item" v-for="(page, index) in pageNumber" :key="index" :class="page == isActived?'active':'' ">
                        <a class="page-link" href="#" @click="changePage(page)"><span>{{page}}</span></a>
                    </li>
                    <li v-if="paginate.current_page < paginate.last_page" aria-label="Siguiente">
                        <a class="page-link" href="#" @click="changePage(paginate.current_page+1)" >
                            <span aria-hidden="true">Siguiente</span>
                        </a>
                    </li>
                </ul>
            </nav>
            </div>
            <!-- creando el modulo del curso -->
            <div class="modal fade" id="modal" z-index="100" role="dialog" >
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="padding:20px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editando el <strong>{{this.modulo}}</strong> del curso </h5>
                        <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 center">
                            <h5><strong>{{this.curso}}</strong></h5>
                        </div>
                        <div class="col-md-12">
                            <p><strong>1) Objetivo del modulo</strong></p>
                            <textarea class="form-control" v-model="objetivo" name="" id="" cols="30" rows="5" placeholder="objetivo del modulo"></textarea>
                            <br>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                           <div class="col-md-12" v-html="urlvideo"></div>
                           <div class="col-md-12 center" >
                               <br>
                               <button @click="cambiarvideo" >Cambiar Video</button>
                           </div>
                           <br>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-12" style="margin-top:20px;">
                            <strong>2) Material de apoyo</strong>
                            <br>
                            <textarea class="form-control" style="margin-top:20px;" v-model="material" name="" id="" cols="30" rows="5" placeholder="material de apoyo"></textarea>
                        </div>
                        <div class="col-md-12" style="margin-top:20px;">
                            
                            <div class="row" style="margin-bottom:20px;">
                                
                                <div class="col-md-8">
                                    <p><strong>¿Deseas agregar un nuevo material de apoyo?</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <button @click="addMaterial">Agregar</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row" v-for="(item, index) in listContent" :key="index">
                                <div class="col-md-8">
                                    <p>Material de apoyo</p>
                                <p ><strong>{{index+1}})</strong> <a href="#"><strong>{{item.url}}</strong></a> </p>
                            
                                </div>
                                <div class="col-md-4">
                                    <p>Acción</p>
                                   <!-- <i style="color:#337ab7;font-size:20px;" class="fas fa-edit"></i>  -->
                                   <i @click="RemoveMaterial(index,item.url,item.tipo_archivo)" style="color:red;font-size:20px;cursor:pointer;" class="fas fa-trash"></i>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary"  @click="cerrarModal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- editar el modulo del curso -->
            <div class="modal fade" id="modal1" z-index="100" role="dialog" >
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="padding:20px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Creando el <strong>{{this.cmodulo}}</strong> del curso </h5>
                        <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 center">
                            <h5><strong>{{this.curso}}</strong></h5>
                        </div>
                        <div class="col-md-12">
                            <p><strong>1) Contenido del modulo</strong></p>
                            <textarea class="form-control" v-model="objetivo" name="" id="" cols="30" rows="5" placeholder="objetivo del modulo"></textarea>
                            <br>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                           <div class="col-md-12" v-html="urlvideo"></div>
                           <div class="col-md-12 center" >
                               <br>
                               <button @click="cambiarvideo" >Cambiar Video</button>
                           </div>
                           <br>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-12" style="margin-top:20px;">
                            <strong>2) Material de apoyo</strong>
                            <br>
                            <textarea class="form-control" style="margin-top:20px;" v-model="material" name="" id="" cols="30" rows="5" placeholder="material de apoyo"></textarea>
                        </div>
                        <div class="col-md-12" style="margin-top:20px;">
                            <p>Material de apoyo</p>
                            <ul>
                                <li v-for="(item, index) in listContent" :key="index"><a href="">{{item.url}}</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
</div>

</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['idperson'],
    data: function(){
        return{
            pag:0,
            ListCursoMod:[],
            curso:'',
            cmodulo:'Modulo 1',
            modulo:'',
            urlvideo:'',
            listContent:[],
            material:'',
            objetivo:'',
            paginate:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0,
            },
            offset:3,
            deleteFiles:[]
        }
    },
    computed:{
        
        isActived: function(){
            let _this = this;
            return _this.paginate.current_page;
        },
        pageNumber: function(){
            let _this = this;
            if(!_this.paginate.to){
                return [];
            }
            let from = _this.paginate.current_page-_this.offset;
            from < 1 ? from =1 : '';
            let to = from + (_this.offset*2);
            to >= _this.paginate.last_page? to = _this.paginate.last_page:'';
            var array =[];
            while(from <= to){
                array.push(from);
                from++;
            }
            return array;
        }
    },
    methods:{
        cambiarvideo: async function(){
          let _this = this;
           const alerts= await Swal.mixin({
            confirmButtonText: 'Siguiente &rarr;',
            cancelButtonText:'Salir',
            showCancelButton: true,
            progressSteps: ['1'],
           
            })
            const data = alerts.queue([
                {
                input: 'radio',
                inputOptions:{
                    'youtube': 'Tengo video de youtube',
                    'independiente': 'Tengo video independiente',
                },
                title: '¡Ayudanos a subir el video!',
                text: '¿Que tipo de video tienes?',
                
                inputValidator: (value)=>{
                    if(!value){
                        return 'Escoge el video a montar'
                    }
                },
               
            },
            {
                title: '¡Ayudanos a subir el video!',
                text:"D-Academy",
                html: '<p style="text-align:justify;"><strong>Si tienes video de youtube utiliza</strong> <br> <span style="font-size:14px;">(< iframe width="500" height="315" src="https://www.youtube.com/...)</span> <span style="color:#FF9700" ><a href="/subir-video-youtube"  target="_blank">¡Como hago!</a></span></p><p style="text-align:justify;"><strong>Si tienes video independiente utiliza</strong><span style="font-size:14px;"> (htttp://video/v=OkppL2-LslperwqcC&v=1)</span></p>',
                input:'text',
                inputPlaceholder:'Ingrese el texto',
                 inputValidator: (value)=>{
                    if(!value){
                        return 'ingresa la url o el iframe';
                    }
                },
            }
            ]).then((result) => {
            if (result.value) {
                const answers = JSON.stringify(result.value);
                Swal.fire({
                title: 'Correcto haz montado este video!',
                html: `
                   <div>${result.value[1]}</div>
                `,
                confirmButtonText: 'Listo!',
                customClass:'width-video-preview'
                }).then(function(){
                    _this.urlvideo = result.value[1];
                    _this.editVideo = Boolean(1);
                    _this.desrViewVideo = Boolean(1);
                });
            }
            });
        },
        abrirModal: function(items, itemcurso){
            let _this = this;
            _this.curso = itemcurso;
            _this.modulo = items.modulo.nombre;
            _this.objetivo = items.modulo.objetivo;
            _this.material = items.modulo.material_apoyo;
            _this.listContent = items.lectura;
            if(_this.urlvideo===null||_this.urlvideo===undefined||_this.urlvideo==="")
            {

            }else{
                _this.urlvideo = items.video.replace('height="450"','height="350"');
            }
            // default 450 de alto;
            $('#modal').modal('show');
        },
        ver: function(id){
            $('#div'+id+'').removeClass('hide');
            $('#btnS'+id).addClass('hide');
            $('#btnH'+id).removeClass('hide');
        },
        ocultar: function(id){
            $('#div'+id+'').addClass('hide');
            $('#btnS'+id).removeClass('hide');
            $('#btnH'+id).addClass('hide');
        },
        showAdd: function(id, curso_name){
            let _this = this;
            _this.curso = _this.curso_name; 
            _this.objetivo = "";
            _this.modulo ="";
            _this.material = "";
            _this.listContent = [];
            $('#modal1').modal('show');
        },
        changePage: function(page){
            let _this = this;
            _this.paginate.current_page = page;
            _this.listarModulos(page);
        },
        listarModulos: function(page){
            let _this = this;
            let url = '/listarCursoMod?p='+parseInt(_this.idperson)+"&page="+page;
            axios.get(url).then(function(result){
                let data = result.data;
                console.log(data);
                _this.ListCursoMod = data.listaModulos;
                _this.paginate = data.pagination;
            }).catch(function(error){
                console.log(error);
            });
        },
        guardarMod: function(){

        },
        addMaterial: function(){
            alert('Elemento a agregar');
        },
        RemoveMaterial: function(key,nombreC,ext){
            let _this = this;
            Swal.fire({
            title: '¿Deseas Eliminar este archivo: '+ nombreC+'?',
            text: "¡Estas seguro de borrarlo permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.isConfirmed) {
                _this.deleteFiles = [{'id':key,'name':nombreC,'extension':ext}];
                Swal.fire(
                'Borrado!',
                'Tu archivo ha sido eliminado permanentemente, guarda los cambios para que se haga efectivo.',
                'success'
                )
            }
            })
        },
        cerrarModal: function(){
            let _this = this;
            if(_this.deleteFiles.length >0){
                 Swal.fire({
            title: '¿Estas seguro de cerrar sin antes guardar?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Estoy seguro!',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.isConfirmed) {
                _this.deleteFiles = [];
                $("#modal").modal('hide');
            }
            })
            }else{
                $("#modal").modal('hide');
            }
        }

    },
    mounted: function(){
        this.listarModulos();
    }
}
</script>