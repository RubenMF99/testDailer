<template>
    <div class="row cards-pay center">
        <p style="width:50%;font-size:20px;">Este certificado tiene un valor de <br><br><strong>${{curso[0].precio_venta}} USD</strong></p>
        <button id="comprar" @click="pagarCurso" class="btn-style-pay-cer" style='margin-bottom:20px;background:#FF9700;'>comprar certificación</button>
        <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/pagos_procesados_por_epayco_260px.png" alt="">
    </div>
</template>
<script>
export default {
    props:['curso','persona','ruta'],
    data(){
        return{
            Respuesta:'',
            showView:true,
        }
    },
    methods:{
        restaurar(){
                let me = this;
                if(localStorage.getItem('rutaCompra')===null || localStorage.getItem('rutaCompra')===undefined ){
                    me.confirmar(me.curso[0]['id'],0);
                }else{
                    localStorage.removeItem('rutaCompra');
                    me.confirmar(me.curso[0]['id'],1);
                    
                }
        },
        confirmar(curso_id,back_url){
                let me = this;
                var url= '/verificar?curso='+curso_id+'&estudiante='+me.persona;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.Respuesta = respuesta.yesornot;
                    if(Boolean(me.Respuesta))
                    {
                        me.showView = false;
                    }else{
                        if(back_url===1)
                        {
                            // verificar si estas los datos completos
                            let url2 = "/request-data";
                            axios.get(url2).then(function(response){
                                let data = response.data;
                                if(data.state)
                                {
                                    $('#comprar').click();
                                }else{
                                    localStorage.setItem('button','comprar');
                                    $('#datospersonales').modal("show");
                                }
                            }).catch(function(error){
                                console.log(error);
                            });
                            
                        }
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pagarCurso(){
                let me = this;
               if(me.persona===""){
                   let ruta_act = me.ruta+"certificaciones/"+me.curso[0]['url_curso'];
                  localStorage.setItem('rutaCompra',ruta_act);
                    $('#modal-edit-client.modal').addClass('fadeview');
                    $('#modal-edit-client.modal').addClass('modal-view');
                    $('#modal-edit-client').modal('show');
                    document.getElementById('Mm').click();
               }else{
                   let url2 = "/request-data";
                            axios.get(url2).then(function(response){
                                let data = response.data;
                                if(data.state)
                                {
                                   me.abrirPago();
                                }else{
                                    localStorage.setItem('button','comprar');
                                    $('#datospersonales').modal("show");
                                }
                            }).catch(function(error){
                                console.log(error);
                            });
                   
               }
        },
        abrirPago: function(){
             let me = this;
            let fecha = new Date();
            let dia = fecha.getDay();
            let mes = fecha.getMonth();
            let hora= fecha.getHours()+fecha.getMinutes();
            let fecha_act = dia+mes+hora;
            var datos ={
		  name: me.curso[0]['nombre_curso'],
          description:  me.curso[0]['nombre_curso'],
          invoice: me.curso[0]['id']+me.persona+fecha_act,
          currency: "cop",
          amount: me.curso[0]['precio_venta'],
          tax_base: "0",
          tax: "0",
          country: "co",
          lang: "es ",

          //Onpage="false" - Standard="true"
          external: "true",


          //Atributos opcionales
          extra1: me.curso[0]['id'],
          extra2: "extra2",
          extra3: "extra3",
           confirmation: me.ruta + "certificacion/epayco",
          response: me.ruta + "certificacion/epayco",

          //Atributos cliente
          name_billing: "",
          address_billing: "",
          type_doc_billing: "",
          mobilephone_billing: "",
		  number_doc_billing: "",
             }
             
			var handler = ePayco.checkout.configure({
  				key: '73af41ec66291540f87ed89465ff6c97',
                  test: true
                  
  			});
			 handler.open(datos);
              
        }
    },
    mounted(){
        this.restaurar();
    }
}
</script>