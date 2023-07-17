<template>
	<div class="col-md-3 cuadro-vender">
    <div class="col-md-12 center " style="margin-top:45px;">
        <p style="font-size:20px;margin-bottom:35px;">{{curso[0].nombre_curso}}</p>
        <div class="col-md-12" style="margin-bottom:10px;">
             <span v-if="curso[0].precio!=0.00">Antes:</span> <span class="text-tachado" style="margin-bottom:15px;" v-text="'$'+curso[0].precio+' USD'" v-if="curso[0].precio!=0.00"> </span>

            <span style="margin-bottom:15px;"  v-else-if="curso[0].precio==0.00"> <br></span>
        </div>
       

             <div class="title-vender" v-text="'$'+curso[0].precio_venta" v-if="curso[0].precio_venta!=0.00"></div>
             
        <div class="title-vender" v-else-if="curso[0].precio_venta==0.00"> <span v-if="showView">Gratis </span>  <span v-else style="line-height: 40px;margin-bottom:20px;">Ya estas registrado </span></div>
        <p style="font-size:20px;margin-top:10px;" v-if="curso[0].precio_venta!=0.00">USD</p>
   <div style="margin-top:10px;"  v-if="curso[0].precio_venta!=0.00">
			<button id="comprar"  @click="pagarCurso()" v-if="showView">
				Comprar		</button>
		</div>
            
               <div style="margin-top:10px;"  v-else>
			<button id="comprar"  @click="RegistrarmeCurso()" v-if="showView">
				Ingresar al curso		</button>
                <button id="comprar"  @click="irCuros()" v-else>
				Ingresar al curso		</button>
		</div>
        <div class="text-derecha" style="margin-top:45px;">
            <p style="margin-top:5px;"><strong>Inicio de Clases:</strong> {{curso[0].fecha_inicial}}</p>
            <p style="margin-top:-18px;"><strong>Instructor:</strong> 
            <span v-if="curso[0].primer_nombre">{{curso[0].primer_nombre}}</span>
            <span v-if="curso[0].segundo_nombre">{{curso[0].segundo_nombre}}</span>
            <span v-if="curso[0].primer_apellido">{{curso[0].primer_apellido}}</span>
            <span v-if="curso[0].segundo_apellido">{{curso[0].segundo_apellido}}</span>
            </p>
            <p style="margin-top:-18px;"><strong>Categoria:</strong> {{curso[0].nombre_categoria}}</p>
            <!-- <p>Maximo Estudiantes: {{}}</p> -->
        </div>
    </div>
</div>
    
</template>

<script>
    export default {
        mounted() {
            this.restaurar();
        }, 
                data (){
			return {
                    Respuesta:'',
                    showView:true,
                    }
                },
        props: ['curso',
        'ruta','persona'],
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
                            $('#comprar').click();
                        }
                        
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            RegistrarmeCurso(){
                let me = this;
                if(me.persona===""){
                   let ruta_act = me.ruta+"curso/"+me.curso[0]['url_curso'];
                  localStorage.setItem('rutaCompra',ruta_act);
                  $('#modal-edit-client.modal').addClass('fadeview');
                    $('#modal-edit-client.modal').addClass('modal-view');
                  $('#modal-edit-client').modal('show');
               }else{
                var url= '/ingresarCurso?curso='+me.curso[0]['id']+'&estudiante='+me.persona;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.Respuesta = respuesta.yesornot;
                    if(Boolean(me.Respuesta))
                    {
                        if(me.curso[0]['id_tipo_curso']===1)
                        {
                            window.location.href = "/mis-diplomados";
                        }else if(me.curso[0]['id_tipo_curso']===2){
                            window.location.href = "/mis-cursos";
                        }else if(me.curso[0]['id_tipo_curso']===3){
                             window.location.href = "/clase/virtual/introduccion/"+me.curso[0]['url_curso'];
                           // window.location.href = "/mis-master-class";
                        }else if(me.curso[0]['id_tipo_curso']===4){
                            window.location.href = "/mis-certificaciones";
                        }
                        
                    }else{
                        alert('Ya No Hay cupo para este curso');
                    }
                })
                .catch(function (error) {
                    alert(error);
                    console.log(error);
                });
               }
            },
            pagarCurso(){
                let me = this;
               if(me.persona===""){
                   let ruta_act = me.ruta+"curso/"+me.curso[0]['url_curso'];
                  localStorage.setItem('rutaCompra',ruta_act);
                    $('#modal-edit-client.modal').addClass('fadeview');
                    $('#modal-edit-client.modal').addClass('modal-view');
                    $('#modal-edit-client').modal('show');
                  
               }else{
                   me.abrir_pago();
               }
        },
        irCuros: function(){
            let me = this;
                        if(me.curso[0]['id_tipo_curso']===1)
                        {
                            window.location.href = "/mis-diplomados";
                        }else if(me.curso[0]['id_tipo_curso']===2){
                            window.location.href = "/mis-cursos";
                        }else if(me.curso[0]['id_tipo_curso']===3){
                            window.location.href = "/mis-master-class";
                        }else if(me.curso[0]['id_tipo_curso']===4){
                            window.location.href = "/mis-certificaciones";
                        }
        },
        abrir_pago(){
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
          currency: "usd",
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
          confirmation: me.ruta + "respuesta",
          response: me.ruta + "respuesta",

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
        }
    }
</script>
