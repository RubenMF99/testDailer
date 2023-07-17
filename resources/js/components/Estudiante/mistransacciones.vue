<template>
    <div class="row" style="padding:80px;">
        <table class="table" >
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">N° Recibo</th>
                    <th scope="col">Fecha Pago</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Accion</th>
                    <th scope="col">Descargar</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr v-for="(items, index) in inicio.listPagos" :key="index" >
                    <th scope="row">{{index+1}}</th>
                    <td>{{items.recibo}}</td>
                    <td>{{items.fecha_pago}}</td>
                    <td  >
                        <p  v-if="items.state==='Aceptada'"><i style="color:green;" class="fas fa-check-circle"></i> Pago Realizado Correctamente</p> 
                        <p  v-else-if="items.state==='Rechazada'"><i style="color:red;" class="fas fa-ban"></i> Fondos insuficientes</p> 
                        <p  v-else-if="items.state==='Fallida'"><i style="color:red;" class="fas fa-times-circle"></i> Error de comunicación con el centro de autorizaciones</p> 
                        <p  v-else-if="items.state==='Pendiente'"><i style="color:#FF9821;" class="fas fa-exclamation-circle"></i> Transacción pendiente por validación</p> 
                    </td>
                    <td>
                        <button style="font-size:20px;" @click="detalle(items.referencia);" v-if="items.state!=='Pendiente'"><i class="fas fa-eye"></i></button>
                    </td>
                    <td>
                        <!-- <button @click="check_state(items.referencia);" v-if="items.state==='Aceptada'">Ir a mi curso</button> -->
                        
                        <button style="font-size:20px;" @click="irClase();" v-if="items.state==='Aceptada'"><i class="fas fa-sign-out-alt"></i></button>
                        <button style="font-size:20px;" @click="volver_intentar(items.url);" v-else-if="items.state==='Rechazada'"><i class="fas fa-sync"></i></button>
                        <button style="font-size:20px;" @click="volver_intentar(items.url);" v-else-if="items.state==='Fallida'"><i class="fas fa-sync"></i></button>
                        <button style="font-size:20px;" @click="check_state(items.referencia);" v-else-if="items.state==='Pendiente'"><i class="fas fa-tasks"></i></button>
                    </td>
                    <td>
                        <button style="font-size:20px;" @click="detalle(items.referencia);" v-if="items.state!=='Pendiente'"><i class="fas fa-file-download"></i></button>
                        
                    </td>
                    
                </tr>
                
            </tbody>
        </table>
            <div class="modal fade" id="VerDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalle de Transacción</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table" >
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">epayco (DAVIVIENDA)</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr v-for="(items, index) in inicio.ListaResponse" :key="index" >
                    <th scope="row">{{index+1}}</th>
                    <td>{{items.name}}</td>
                    <td>{{items.value}}</td>
                </tr>
                
            </tbody>
        </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    props:['person'],
    data(){
        return{
            inicio:{
                listPagos:[],
                ListaResponse:[],
            },
        }
    },
    mounted(){
        this.ListarPagos();

    },
    methods:{
        ListarPagos(){
            let me=this;
                var url=  '/listarPagos?cod_persona=' +me.person;
			
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
					  console.log(respuesta);
                    me.inicio.listPagos = respuesta.transaccion;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        irClase(){
            window.location.href = "/mis-cursos";
        },
        detalle(referencia){
            let me = this;
            var url=  'https://secure.epayco.co/validation/v1/reference/' + referencia;
            $.get(url, function(response) {
                if (response.success) {
                    let datas = response.data;
                    me.inicio.ListaResponse=[
                       {'name':'factura','value':datas.x_id_invoice},
                        {'name':'N° de Transacción','value':datas.x_transaction_id},
                        {'name':'Fecha','value':datas.x_transaction_date},
                        {'name':'Nombre','value':datas.x_business},
                        {'name':'Curso','value':datas.x_description},
                        {'name':'Valor','value':datas.x_amount},
                        {'name':'Estado','value':datas.x_transaction_state},
                        {'name':'Motivo','value':datas.x_response}
                        ];
                    $('#VerDetalle').modal('show');
                }else{
                    me.MensajeAlert('D - Academy Información',response.data.description,'warning',false,'Ok', '','error');
                }
            });
        },
        check_state(referencia){
            let me = this;
            var url=  'https://secure.epayco.co/validation/v1/reference/' + referencia;
            $.get(url, function(response) {
                if (response.success) {
                    let datas = response.data;
                    me.inicio.ListaResponse=[
                        {'name':'factura','value':datas.x_id_invoice},
                        {'name':'N° de Transacción','value':datas.x_transaction_id},
                        {'name':'Fecha','value':datas.x_transaction_date},
                        {'name':'Nombre','value':datas.x_business},
                        {'name':'Curso','value':datas.x_description},
                        {'name':'Valor','value':datas.x_amount},
                        {'name':'Estado','value':datas.x_transaction_state},
                        {'name':'Motivo','value':datas.x_response}
                    ];
                    if(datas.x_transaction_state==="Aceptada"){
                        // realizar accion de guardar al estudiante en el curso y cambiar el estado de la transaccion en la base de datos.
                    }
                    $('#VerDetalle').modal('show');
                }else{
                    me.MensajeAlert('D - Academy Información',response.data.description,'warning',false,'Ok', '','error');
                }
            });
            
        },
        MensajeAlert(TitleMessage,TextMessage,TypeMessage,showCancel,TextButtonPrimary, TextButtonSegundary,iconsMessage)
        {
            const swalWithBootstrapButtons = Swal.mixin({customClass:{confirmButton: 'btn btn-success', cancelButton: 'btn btn-danger'}, buttonsStyling: false})
                swalWithBootstrapButtons.fire({
                title: TitleMessage,text:TextMessage,
                type: TypeMessage,showCancelButton: showCancel,confirmButtonColor: '#ffffff',cancelButtonColor: '#d33',confirmButtonText: TextButtonPrimary,
                cancelButtonText: TextButtonSegundary,confirmButtonClass: 'btn btn-primary',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true,icon:iconsMessage
                })
        },
        volver_intentar(url){
            window.location.href = "/curso/"+url;
        }

    },
    computed:{

    }
}
</script>