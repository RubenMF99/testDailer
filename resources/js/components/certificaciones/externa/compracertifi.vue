<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row tab-control tab-control-content">
                    <div class="col-md-12">
                    <h3>Certificaciones Vendidas o Descargadas</h3> 
                    <br>
                    </div>
                    <div class="col-md-4 tabItem active">
                        <span><strong> Compras</strong></span>
                    </div>
                    <div class="col-md-4 tabItem">
                        <span><strong> Descargas</strong></span>
                    </div>
            </div>
            <div class="row tab-control-content">
                <template v-if="sw===1">
                    <div class="col-md-12">
                        <i class="fas fa-filter"></i> <strong>Filtrar por:</strong>
                        <hr>
                    </div>
                    
                    <div class="col-md-4">
                        <span> 
                        <span>
                            <strong>¿Que tipo de filtro deseas?</strong>
                            <select @click="tabFiltrar" v-model="filtro" class="form-control">
                            <option value="0">-- Escoger ---</option>
                            <option value="2">Fechas</option>
                            <option value="1">Mes</option>
                            <option value="3">Año</option>

                            </select></span>
                            <br>
                        </span>
                    </div>
                    <div v-if="filtrar===1" class="col-md-4">
                        <div class="row">
                        <strong>Selecciona el mes</strong>
                            <div class="col-md-8">
                                <select v-model="mes" class="form-control" >
                            <option value="0">-- Escoger --</option>
                            <option :value="item.id" v-for="(item, index) in LisMeses" :key="index">{{item.nombre}}</option>
                        </select>
                            </div>
                            <div class="col-md-2">
                                <button @click="buscar(1)">Consultar</button>
                        </div>
                        </div>
                    </div>
                    <div v-if="filtrar===2"  class="col-md-8">
                        <div class="row">
                            <div class="col-md-5">
                               <strong> Desde:</strong> <input v-model="Datefrom" class="form-control" type="date" name="input" id="">
                            </div>
                            <div class="col-md-5">
                                <strong>Hasta:</strong> <input v-model="DateTo" class="form-control" type="date" name="input" :min="Datefrom" id="">
                            </div>
                             <div class="col-md-2">
                                <button @click="buscar(2)">Consultar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div v-if="filtrar===3" class="col-md-4">
                        <div class="row">
                        <strong>Selecciona el año</strong>
                            <div class="col-md-8">
                               <input class="form-control" type="text" v-model="ano" placeholder="Ingresa el año">
                            </div>
                            <div class="col-md-2">
                                <button @click="buscar(3)">Consultar</button>
                            </div>
                        </div>
                    </div>
                </template>
               <div class="col-md-12">
                   <div class="col-md-12">
                      <p><span class="text-centrado" style="margin-bottom:30px;"><strong class="text-centrado">Todas las certificaciones vendidas </strong></span></p> 
                
                     <table class="table">
                        <thead>
                            <tr>

                            <th scope="col">#</th>
                            <th scope="col">Certificado</th>
                            <th scope="col">Nombre Comprador</th>
                            <th scope="col">Correo Comprador</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="loadContent">
                            <tr v-for="(item, index) in ListCompras" :key="index">
                            <th scope="row">{{index+1}}</th>
                            <td>{{item.nombre_curso}}</td>
                            <td>{{item.primer_nombre+' '+item.primer_apellido}}</td>
                            <td>{{item.email}}</td>
                            </tr>
                            </template>
                            <template v-if="!loadContent">
                                <div class="center">
                                    <img style="width:30px; height:30px;" src="/img/cargando/cargar.gif" alt="">
                                </div>
                            </template>
                        </tbody>
                        </table>
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
    props:['compras', 'ruta'],
    data(){
        return{
             ListCompras:[],
             sw:1,
             filtrar:0,
             filtro:0,
             Datefrom:'',
             DateTo:'',
             mes:0,
             ano:'',
             loadContent:Boolean(0),
             LisMeses:[
                 {'id':1,'nombre':'Enero'},
                 {'id':2,'nombre':'Febrero'},
                 {'id':3,'nombre':'Marzo'},
                 {'id':4,'nombre':'Abril'},
                 {'id':5,'nombre':'Mayo'},
                 {'id':6,'nombre':'Junio'},
                 {'id':7,'nombre':'Julio'},
                 {'id':8,'nombre':'Agosto'},
                 {'id':9,'nombre':'Septiembre'},
                 {'id':10,'nombre':'Octubre'},
                 {'id':11,'nombre':'Noviembre'},
                 {'id':12,'nombre':'Diciembre'},
             ]
        }
    },
    methods:{
        listarCompras: function(){
            let _this = this;
            _this.loadContent = Boolean(1);
            _this.ListCompras = _this.compras;
        },
        buscar: function(val){
            let _this = this;

            let url = '';
           _this.loadContent = Boolean(0);
            if(val===1){
                 url = 'venta-certificaciones?mes='+_this.mes;
            }else if(val===2){
                 url = 'venta-certificaciones?fecha_ini='+_this.Datefrom+'&fecha_fin='+_this.DateTo;
            }else if(val===3){
                 url = 'venta-certificaciones?year='+_this.ano;
            }
            axios.get(url).then(function(data){
                let result = data.data;
                _this.loadContent = Boolean(1);
                _this.ListCompras = result[0].compras;
                
            }).catch(function(error){
                _this.loadContent = Boolean(1);
                alert('Error:'+error);
                
            })
        },
        tabFiltrar: function(){
            let _this = this;
            _this.filtrar = parseInt(_this.filtro);
        }
    },
    mounted(){
        this.listarCompras();
    }
}
</script>