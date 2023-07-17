<template>
    <div class="row">
        <div class="col-md-12 col-xs-12 header-card">
            <h3>Hola, <br> <span style="text-transform: capitalize;font-weight: bolder;">{{nombre}}</span>   <span style="font-size:18px;float:right;position:relative; ">  <strong>Correo Electronico:</strong> {{correo}} </span> </h3>
            
        </div>
        <div class="col-md-12 col-xs-12 header-Body2" v-if="pag===0" >
            <p style="text-align:left !important;" ><strong>Listado de cursos</strong></p>
            <button class="New" style="float:right;" @click="siguiente(1)">Crear Nuevo Curso</button>
        </div>
        <div class="col-md-12 col-xs-12 header-Body" v-else >
            <p>Paso <strong>{{this.pag}}</strong> de <strong v-if="typeCurso===3">3</strong> <strong v-else>4</strong> </p>
            
            
        </div>
          
          <template v-if="pag===0">
           <div class="col-md-12" style="background:#ffffff;padding-top:20px;padding-bottom:20px;">
               <div class="col-md-12" style="margin-bottom:20px; border-bottom:1px solid rgba(0,0,0,0.1);padding-bottom:10px;"  v-for="(item, index) in listarcursos" :key="index">
                   <div class="col-md-3">
                   <img v-if="item.imagen_destacada" class="imgList" :src="'/img/cursos/'+item.imagen_destacada" alt="">
                   <img v-else class="imgList" src="/img/cursos/placeholder.png" alt="">
               </div>
               <div class="col-md-4 classListCourse" >
                   <h2 style="font-size:20px;">{{item.nombre_curso}}</h2>
                   <p><strong>Instructor:</strong> {{item.primer_nombre+" "+item.primer_apellido}}</p>
                   <p v-if="item.fecha_inicial"><strong>Fecha de Inicio:</strong> {{item.fecha_inicial}}</p>
                   <p v-else><strong>Fecha de Inicio:</strong> ---</p>
                   <p  v-for="(item_two, index) in student" :key="index"><strong v-if="item_two.id_curso===item.id">Estudiantes Inscrito:  {{item_two.alumnos}}</strong></p>
               </div>
                <div class="col-md-3 classEstadoStyle">
                    <p><strong>Referencia:</strong> {{item.codigo}}</p>
                    <p><strong>Fecha y hora de creación:</strong> {{item.created_at}}</p>
                    <p v-if="item.estado_registro==0"><strong>Estado:</strong> <span style="color:#3490dc;"> <strong>Borrador</strong></span></p>
                    <p v-if="item.estado_registro==1"><strong>Estado:</strong> <span style="color:#01AB22;"> <strong>Publicado</strong></span></p>
                    <p><strong>Tipo de curso:</strong> {{item.tipo_curso}}</p>
               </div>
               <div class="col-md-2 classButtonStyle">
                   <!-- <button ><i class="fas fa-edit"></i></button> -->
                   <button @click="abrirModal('myModal_'+item.id)"><i class="fas fa-edit"></i></button>
                   <button><i class="fas fa-trash"></i></button>
               </div>
               <editar-curso-component  :comboDuracion="comboDuracion" :typeDuracion="comboTipoDuracion" :dataCourse="item" :idCurso="item.id" :name="item.nombre_curso" :typeCursos="item.id_tipo_curso"></editar-curso-component>
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
               
           </div>
         </template>
         <template v-if="pag===1">
        <div class="col-md-12 col-xs-12 cards center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h2>¿Escoge el tipo de curso a subir?</h2>
                    </div>
                    <div class="col-md-4" style="margin-bottom:20px;" @click="siguiente(2, item.id, item.nombre)" v-for="(item, index) in combotipocurso" :key="index">
                        <div class="style-squart">
                            <i class="fas fa-university" v-if="item.id===1"></i>
                            <i class="fab fa-discourse" v-if="item.id===2"></i>
                            <i class="fas fa-marker" v-if="item.id===3"></i>
                            <i class="fas fa-file-signature" v-if="item.id===4"></i>
                            <p>Crear {{item.nombre}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12" ><span style="cursor:pointer;" @click="back(0)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span></div>
        </div>
         </template>
       <!-- modulo de creacion de los cursos -->
        <template v-if="pag===2">
            <div class="col-md-12 col-xs-12 cards" v-if="typeCurso===1">
                 <!-- diplomados -->
                <p>Por lo pronto no esta disponible está session de diplomados.</p>
                <span style="cursor:pointer;" @click="back(1)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span>
            </div>
            <div class="col-md-12 col-xs-12 cards" v-if="typeCurso===2">
                <!-- cursos -->
                <crear-curso :persona="this.persona" :tipoCurso="this.typeCurso"></crear-curso>
            </div>
            <div class="col-md-12 col-xs-12 cards" v-if="typeCurso===3">
               <!-- master class -->
                <crear-masterClass :persona="this.persona" :tipoCurso="this.typeCurso"></crear-masterClass>
            </div>
            <div class="col-md-12 col-xs-12 cards" v-if="typeCurso===4">
                 <!-- certificaciones -->
                <crear-certificado :persona="this.persona" :tipoCurso="this.typeCurso"></crear-certificado>
            </div>
            <div class="col-md-12" style="margin-top:25px;">

                <div class="col-md-6 center"  style="cursor:pointer;">
                  <span style="cursor:pointer;" @click="back(1)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span>
                </div>
                <div class="col-md-6 center">
                    <button @click="siguiente(3)" class="siguiente">Siguiente</button>
                </div>
            </div>
         </template>
         <!-- creacion de modulo -->
         <template v-if="pag===3">
            <div class="col-md-12">
                <crear-modulo :tipoCurso="this.typeCurso" :titulo="this.titulo"></crear-modulo>
            </div>
            <div class="col-md-12" style="margin-top:25px;">
                <div class="col-md-6 center">
                   <span style="cursor:pointer;" @click="back(2)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span>
                </div>
                <div class="col-md-6 center">
                    <button @click="siguiente(5)" class="siguiente" v-if="typeCurso===3">Siguiente</button>
                    <button @click="siguiente(4)" class="siguiente" v-else>Siguiente</button>
                </div>
            </div>
         </template>
         <!--  -->
         <template v-if="pag===4">
            <div class="col-md-12">
                <crear-quiz :typeCurso="this.typeCurso" :id_curso="this.curso" :sw="1"></crear-quiz>
            </div>
            <div class="col-md-12" style="margin-top:25px;">
                <div class="col-md-6 center">
                   <span style="cursor:pointer;" @click="back(3)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span>
                </div>
                <div class="col-md-6 center">
                    <button @click="siguiente(5)" class="siguiente">Siguiente</button>
                </div>
            </div>
         </template>
         <template v-if="pag===5">
            <div class="col-md-12">
                <crear-quiz :typeCurso="this.typeCurso" :id_curso="this.curso" :sw="2"></crear-quiz>
            </div>
            <div class="col-md-12" style="margin-top:25px;">
                <div class="col-md-6 center" >
                   <span style="cursor:pointer;" @click="back(4)"><i class="fas fa-arrow-left"></i> <strong>Volver</strong></span>
                </div>
                <div class="col-md-6 center">
                    <button @click="siguiente(0)" class="siguiente">Finalizar {{titulo}}</button>
                </div>
            </div>
         </template>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['persona', 'nombre','correo'],
    data: function(){
        return{
            pag:0,
            student:[],
            combotipocurso:[], comboDuracion:[],  listarcursos:[],  comboTipoDuracion:[],
            typeCurso:'',  curso:'',  titulo:'',
            paginate:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0,
            },
            offset:3,
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
        abrirModal: function(value){
            $('#'+value+'').modal(true);
        },
        changePage: function(page){
            let _this = this;
            _this.paginate.current_page = page;
            _this.listarCursos(page);
        },
        siguiente: function(next, id, name){
            let _this=this;
            if(name!==undefined){ _this.titulo = name; }
           if(next===1)
            {
                this.listartipocurso();
                _this.pag = next;
            }
           else if(next===3)
           {
               if(_this.typeCurso===2){
                   let curso =localStorage.getItem('CCurso');
                   if(curso===null||curso===undefined||curso===""){}else{
                        _this.pag = next;
                    }
               }
               if(_this.typeCurso===3){
                   let masterClass = localStorage.getItem('CMC');
                   if(masterClass===null||masterClass===undefined||masterClass===""){}else{
                        _this.pag = next;
                    }
               }
               if(_this.typeCurso===4){
                   let curso =localStorage.getItem('CCertif');
                   if(curso===null||curso===undefined||curso===""){}else{
                        _this.pag = next;
                    }
               }
               if(_this.typeCurso===1){
                   let curso =localStorage.getItem('CDiplo');
                   if(curso===null||curso===undefined||curso===""){}else{
                        _this.pag = next;
                    }
               }
           }
           else if(next===4)
           {
               let mod = localStorage.getItem('CMod');
               if(mod===null||mod===undefined||mod===""){}else{
                    _this.pag = next;
                }
           }
           else if(next===0){
               let mod = localStorage.getItem('Final');
               if(mod===null||mod===undefined||mod===""){
                   let TextMessage = "¿Desea finalizar sin antes guardar el examen final?";
                    _this.MensajeAlert('D - Academy Información',TextMessage,'warning',true,'Si', 'No','warning');
               }else{
                     _this.crearM();
                    _this.pag = next;
                    _this.listarCursos();
                }
           }
           else if(next===2){
                _this.pag = next;
                _this.typeCurso = id;
           }
           else if(next===5)
           {
               let mod = localStorage.getItem('CMod');
               if(mod===null||mod===undefined||mod===""){alert("hola")}else{
                    _this.pag = next;
                }
           }
        },
        MensajeAlert: function(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
                {
                    let _this = this;
                    const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                        swalWithBootstrapButtons.fire({
                        title: TitleMessage,text:TextMessage,
                        type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                        cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                        }).then((result) => {
                            if(result.value){
                                 _this.crearM();
                                _this.pag = 0;
                                 _this.listarCursos();
                            }
                            
                        });
        },
         listartipocurso: function(){
            let _this = this;
            let url = "/listarcombos?combo="+0;
            axios.get(url).then(function (response) {
                let data = response.data;
                _this.combotipocurso = data.tiposcurso;
                _this.comboDuracion = data.tipoduracion;
                _this.comboTipoDuracion = data.tipocategoria;
            }).catch();
        },
        back: function(value){
            let _this = this;
            if(value===1){
                _this.listartipocurso();
            }
            _this.pag = value;
        },
        crearM: function(){
            if(localStorage.getItem('CCurso')!==null || localStorage.getItem('CCurso')!==undefined||localStorage.getItem('CCurso')!=="")
            {
                localStorage.removeItem('CCurso');
            }
             if(localStorage.getItem('CMC')!==null || localStorage.getItem('CMC')!==undefined||localStorage.getItem('CMC')!=="")
            {
                localStorage.removeItem('CMC');
            }
               if(localStorage.getItem('CCertif')!==null || localStorage.getItem('CCertif')!==undefined||localStorage.getItem('CCertif')!=="")
            {
                localStorage.removeItem('CCertif');
            }
             if(localStorage.getItem('CDiplo')!==null || localStorage.getItem('CDiplo')!==undefined||localStorage.getItem('CDiplo')!=="")
            {
                localStorage.removeItem('CDiplo');
            }
        },
       
        listarCursos: function(page){
             let _this = this;
            let url = "/listarCursoP?persona="+_this.persona+"&page="+page;
            axios.get(url).then(function (response) {
                let data = response.data;
                console.log(data);
                _this.listarcursos = data.curso.data;
                _this.paginate = data.paginate;
                _this.student = data.alumnos;
            }).catch();
        }
    },
    mounted: function(){
        this.listartipocurso();
        this.listarCursos();
        this.crearM();
    }

}
</script>