<template>

                    <div class="row" style="background:#ffffff;">
                        <div class="col-md-12 center">
                            <h2 v-if="tipoCurso!==3">¡Creemos los modulos de los {{this.titulo}}!</h2>
                            <h2 v-else>¡Creemos material apoyo!</h2>
                        </div>
                                    <div v-if="tipoCurso!==3" class="col-md-12 espacio-input">
                                        <p class="text-derecha"><strong v-text="modulo"></strong> Porcentaje: <input type="text"  style="width:10%;text-align:center;" v-model="valorModulo" name="" id=""><strong> %</strong></p> 
                                    </div>
                                    <div v-if="tipoCurso!==3" class="col-md-12 espacio-input">
                                        <br> <textarea class="form-control" name="" id="" placeholder="Objetivo del modulo" cols="30" rows="10" v-model="objetivo"></textarea><br>
                                    </div>
                                    <div v-if="tipoCurso!==3" class="col-md-4 espacio-input ">
                                        <p><strong>¿Que video tienes para subir?</strong></p>
                                        <input type="radio" id="r1" name="video" @change="Visualizar(1)" v-model="r1"><label style="cursor:pointer;" for="r1">Tengo video de YouTube</label><br>
                                        <input type="radio" id="r2" name="video" @change="Visualizar(2)" v-model="r2"><label style="cursor:pointer;" for="r2">Tengo video externo</label><br>
                                        <input type="radio" id="r3" name="video" checked="true" @change="Visualizar(3)" v-model="r3"><label style="cursor:pointer;" for="r3">No tengo video</label>
                                        <input type="text" @input="loadVideo" class="form-control" :placeholder="placeholders" id="" v-model="urlvideo" v-if="viewinput">
                                    </div>
                                    <div v-if="tipoCurso!==3" class="col-md-8 espacio-input center">
                                        <div><p><strong>Preview del Video</strong></p></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8" v-html="preview">

                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div v-if="tipoCurso!==3" class="col-md-12">
                                      <br>  <textarea class="form-control" v-model="descripMaterialApoyo" cols="30" rows="10" placeholder="Descripcion del material de apoyo"></textarea>
                                    </div>
                                    <div class="col-md-12 espacio-input" id="divDinamic" style="margin-top:25px;">
                                        <p class="text-derecha" style="background:rgba(0,0,0,0.2); padding:15px;"><strong>Material de apoyo #{{listDiv.length}}</strong> 
                                        <span style="float:right;margin-top:-5px;"> <button class="style-btn-alert" @click="agregaqr" ><i style="font-size:20px;" class="fas fa-plus"></i></button> 
                                        <button class="style-btn-error" @click="borrar(1)"> <i style="font-size:20px;" class="fas fa-times"></i></button></span></p>
                                            <div class="row custom-file" style="margin-bottom:15px;padding:10px;" v-for="(items,index) in listDiv" :key="index" :id="'Divp'+(index+1)">
                                               <div class="col-md-1"></div>
                                                <div class="col-md-6 center">
                                                    <input type="file"  @change="uploadFile(index+1)" class="custom-file-input" :id="items.nombre+(index+1)" :name="items.nombre" lang="es">
                                                    <label class="custom-file-label" :id="'filelabel'+(index+1)" :for="items.nombre+(index+1)">Seleccionar Archivo</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="state" id="">
                                                        <option value="2">No Publicar</option>
                                                        <option value="1">Publicar</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                    </div>
                                    <div class="col-md-12 espacio-input center" style="margin-bottom:20px;">
                                       <br> <button v-if="!view" class="guardar" @click="guardar">Guardar</button>
                                       <button v-else-if="view" class="guardar">Guardando...</button> <br>
                                    </div>
                    </div>

</template>
<script>
import Swal from 'sweetalert2';
window.swal = swal; 
export default {
    props:['titulo','persona','tipoCurso'],
    data:function(){
        return{
            listDiv:[{"nombre":"file"}],
            objetivo:'',
            urlvideo:'',
            HtmlVideo:'',
            descripMaterialApoyo:'',
            valorModulo:'15',
            modulo:'Modulo 1',
            modcount:1,
            preview:'<br> No hay video',
            placeholders:'',
            loadIdvideo:'',
            r1:'',r2:'',r3:'',
            viewinput:false,
            view:Boolean(0),
        }
    },
    methods:{
        Visualizar: function(value){
            let _this = this;
            _this.loadIdvideo = value;
            switch (value) {
                case 1:
                    _this.placeholders = '<iframe width="560" height="315" src="https://www.youtube.com/embed/1X_yQ8m0Q2o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=true;
                    _this.HtmlVideo = "";
                    _this.loadIdvideo = 1;
                    break;
                case 2:
                    _this.placeholders = 'http://D-academy/cursos/video.mp4';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=true;
                    _this.HtmlVideo = "";
                    _this.loadIdvideo = 2;
                    break;
                case 3:
                    _this.placeholders = 'No tengo video';
                    _this.urlvideo="";
                    _this.preview = "<br> No hay video";
                    _this.viewinput=false;
                    _this.HtmlVideo = "";
                    break;
                default:
                    break;
            }
        },
        loadVideo: function(){
            let _this = this;
            if(_this.loadIdvideo===1){
                let pVideo = _this.urlvideo;
                let sVideo = _this.urlvideo;
                pVideo = pVideo.split('width="560"').join('width="100%"');
                pVideo = pVideo.split('height="315"').join('height="150"');
                _this.preview = pVideo;
                sVideo = sVideo.split('width="560"').join('width="100%"');
                sVideo = sVideo.split('height="315"').join('height="450"');
                _this.HtmlVideo = sVideo;
            }else{
                _this.preview = '<video src="'+_this.urlvideo+'" width="100%" height="150" alt="" controls></video>';
                _this.HtmlVideo = '<video src="'+_this.urlvideo+'" width="100%" height="150" alt="" controls autoplay></video>';;
            }
        },
        validar: function(){
            return Boolean(1);
        },
        guardar: function(){
            let me = this;
            me.view = Boolean(1);
            if(me.validar()){
                let url = "/modulo/registrar";
                let array = new FormData();
                    
                    array.append('nombre', me.modulo);
                    if(me.tipoCurso === 3)
                    {
                        array.append('curso',parseInt(localStorage.getItem('CMC')));
                    }else if(me.tipoCurso ===2){
                        array.append('curso',parseInt(localStorage.getItem('CCurso')));
                    }else if(me.tipoCurso === 4){
                        array.append('curso',parseInt(localStorage.getItem('CCertif')));
                    }else if(me.tipoCurso === 1){
                        array.append('curso',parseInt(localStorage.getItem('CDiplo')));
                    }
                    array.append('valormod',me.valorModulo);
                    array.append('objetivo' ,me.objetivo);
                    array.append('video',me.HtmlVideo);
                    array.append('material_apoyo',me.descripMaterialApoyo);
                    array.append('countData', me.listDiv.length);
                for (let index = 0; index < me.listDiv.length; index++) {
                    array.append('state[]',document.getElementsByName("state")[index].value);
                    array.append('files[]',document.getElementsByName("file")[index].files[0]);
                }
                axios.post(url, array).then(function(data){
                    console.log(data);
                    let TextMessage ="Se ha guardado correctamente el modulo"+me.modcount;
                    if(me.tipoCurso!==3)
                    {
                        localStorage.removeItem('modulo');
                        me.modcount = me.modcount+1;
                        me.modulo = "Modulo "+ me.modcount;
                        localStorage.setItem('modulo',me.modcount);
                        me.view = Boolean(0);
                    }else{
                        me.view = Boolean(1);
                    }
                    localStorage.setItem('CMod',1);
                    
                            me.valorModulo = 15;
                            me.objetivo = "";
                            me.urlvideo = "";
                            me.descripMaterialApoyo="";
                            me.listDiv =[];
                            me.listDiv =[{"nombre":"file"}];
                            me.HtmlVideo="";
                    me.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','success');

                }).catch(function(data){
                    console.log();
                });
            }
            
        },
        uploadFile: function(val){
            let me = this;
            let file =  $('#file'+val);
            let file_data =  file.prop("files")[0];
            if(file_data===undefined||file_data===null){
               $('#filelabel'+val).html('carga nuevamente porfavor.');
            }else{
                if (!(/\.(pdf|docx)$/i).test(file_data.name)) {
                    let TextMessage = "El archivo a subir no es un pdf o un documento word";
                    me.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','error');
                }else{
                    if(file_data>14680064)
                    {
                        let TextMessage = "El archivo esta muy pesado solo se aceptan 14 megabytes";
                        me.MensajeAlert('D - Academy Información',TextMessage,'warning',false,'Ok', '','error');
                    }else{
                        $('#filelabel'+val).html(file_data.name);
                    }
                    
                }
            }
        },
        removeMod: function(){
           let Mod =  localStorage.getItem('CMod');
           if(Mod === null||Mod===undefined||Mod===""){}else{localStorage.removeItem('CMod')}
           if(this.tipoCurso === 3)
           {
               this.valorModulo = 60;
           }
        },
         agregaqr: function(){
            let newData= {"nombre":"file"}
            this.listDiv.push(newData);
        },
        borrar: function(element){
            this.listDiv.splice(element,1);
        },
        MensajeAlert: function(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
        {
            let me = this;
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                }).then((result) => {
                    if(me.tipoCurso===3){
                        me.view = 1;
                    }else{
                        me.view = Boolean(0);
                    }
                    
                });
        }
    },
    mounted(){
        this.removeMod();
    }
}
</script>