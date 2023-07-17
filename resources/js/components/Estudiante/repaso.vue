<template>
    <div class="row center">
        <div class="panel-top-float" v-if="listCurso[0].state === 2">
            <p><strong>¿Quieres ver el certificado?</strong></p>
            <button @click="iracertificado"> <span><i style="font-size:20px;" class="fas fa-graduation-cap"></i></span>  Ver Certificado</button>
        </div>
        <div class="panel-top-float" v-else-if="listCurso[0].state === 1">
            <p><strong>¿Quieres volver al curso?</strong></p>
            <button @click="volveraclases"> <span><i class="fas fa-arrow-left"></i></span>  Volver al curso</button>
        </div>
            <div class="col-md-12">
                <div class="row" style="background:rgba(0,0,0,0.2);padding:10px;border-radius:8px;color:#000;">
                     <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-2">
                        <p><strong>Modulo a Repasar</strong></p>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="" id="" v-model="moduloSelect">
                            <option value="">Seleciona el modulo</option>
                            <option v-for="(item, index) in listModulos" :key="index" :value="item.id" >{{item.nombre}}</option>
                            
                        </select>
                    </div>
                     <div class="col-md-2 spacing-enter-div-repaso">
                         <button @click="consultar">Consultar</button>
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                </div>
            </div>
            <div v-if="ShowView">
                <div class="col-md-12">
                    <div class="d-flex-style center">
                    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
        </div>
        <div v-else> 
            <div class="col-md-12" style="margin-top:25px;">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-6">
                        <p><strong>Video del Modulo</strong></p>
                    </div>
                    <div class="col-md-5">
                        <p><strong>Material de Apoyo</strong></p>
                    </div>
                </div>
                <hr>
                <div class="row" v-for="(item, index) in listContentMod" :key="index">
                    <div class="col-md-1">
                    
                    </div>
                    <div class="col-md-6" v-html="item.modulo.video">
                     
                    </div>
                    <div class="col-md-4">
                        <p style="text-align:justify;">{{item.modulo.material_apoyo}}</p>
                        <ul>
                            <li v-for="(item2, index2) in item.lectura" :key="index2">
                                <a v-if="item2.tipo_archivo==='pdf'" :href="'/pdf/'+item2.url+'.'+item2.tipo_archivo" target="_blank"><img src="/img/Archivos/pdf.png" style="width:30px; height:40px;"> {{item2.url}}</a>
                                <a v-if="item2.tipo_archivo==='docx'" :href="'/word/'+item2.url+'.'+item2.tipo_archivo" ><img src="/img/Archivos/word.png">{{item2.url}}</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['url','modulo','idperson'],
    data: function(){
        return{
            listModulos:[],
            listContentMod:[],
            moduloSelect:'',
            ShowView:Boolean(1),
            listCurso:[],
        }
    },
    methods:{
        iracertificado: function(){
            window.location.href = "/certificados";
        },
        volveraclases: function(){
            let _this = this;
            window.location.href = "/clase/virtual/"+_this.url;
        },
        consultar: function(){
            let _this = this;
             _this.ShowView = Boolean(1);
            let urls = '/modrepasar?urlcurso='+_this.url+'&mod='+_this.moduloSelect+"&estudiante="+_this.idperson;
            axios.get(urls).then(function(response){
                let result = response.data;
                _this.listModulos = result.modulos;
                _this.listContentMod = result.modulosContent;
                _this.listCurso = result.curso;
                _this.moduloSelect = result.modulosContent[0].modulo.id;
                 _this.ShowView = Boolean(0);
            }).catch(function(error){
                alert(error);
                 _this.ShowView = Boolean(0);
            })
        },
        listarModulos: function(){
            let _this = this;
            _this.ShowView = Boolean(1);
            let urls = '/modrepasar?urlcurso='+_this.url+'&mod='+_this.modulo+"&estudiante="+_this.idperson;
            axios.get(urls).then(function(response){
                let result = response.data;
                _this.listModulos = result.modulos;
                _this.listContentMod = result.modulosContent;
                _this.listCurso = result.curso;
                _this.moduloSelect = result.modulosContent[0].modulo.id;
                 _this.ShowView = Boolean(0);
            }).catch(function(error){
                alert(error);
                 _this.ShowView = Boolean(0);
            })
        },
        ListaContentMod: function(){

        }
    },
    mounted: function(){
        this.listarModulos();
    }
}
</script>