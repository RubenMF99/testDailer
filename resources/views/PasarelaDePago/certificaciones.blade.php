<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --<</meta>-->
<title>D-Academy | Pagos en linea</title>
<!-- Bootstrap -->
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'<</script>
<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'<</script>
<![endif]-->
</head>
<body>
<style>
body{
    background-image:url('/img/fondos/certificado2.jpg');
    background-size:100%, cover;
    background-repeat:no-repeat;

}
.caja-style{
    background:rgba(255,255,255,0.9);
    padding:30px;
    box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.4);
    position:relative;
    top:25%!important;
}
.caja-style img{
    text-align:center;
    justify-content:center;
    width:180px;
    position:relative;
    left:25%;
    margin-bottom:30px;
    margin-top:30px;
}
.caja-style h2{
    text-align:center;
    margin-bottom:25px;
    font-size:25px;
}
.caja-style p{
    text-align:justify;
    font-size:16px;
}
.btn-style{
    background:#FF9700;
    padding-left:20px;
    padding-right:20px;
    padding-top:10px;
    padding-bottom:10px;
    color:#ffffff;
    border:none;
    justify-content:center;
    font-weight: bolder;
    font-size:14px;
    text-align:center;
    position:relative;
    left:25%;
    margin-top:10px;
    transition:0.2s ease-out;
}
.btn-style:hover{
    background:#337ab7;
}
.link{
    color:#3490dc;
    font-size:16px;
}
.link:hover{
    color:#337ab7;
    text-decoration-line:underline;
    cursor:pointer;
}
</style>
<br><br><br><br><br><br>
<div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 center caja-style">
        <img style="" src="{{asset('img/LOGO.png')}}" alt="">
            <h2>¡hola! <br> <span style="text-transform:capitalize;">{{session()->get('nombre')}}</span> </h2>
           <p> Hemos enviado la información con los siguientes 
           pasos para iniciar tu proceso en la Certificación Profesional 
           de <span style="font-weight:500; text-transform:uppercase; color:#000;"  id="curso"></span>, 
            es importante que revises tu bandeja de entrada y de no deseados 
            (en caso de que no encuentres el correo).
            </p>
            <p>Estamos encantados que hayas confiado en nosotros como tu centro de
             certificación en tu camino profesional.</p>
            <p>¿No te ha llegado el correo? <br> <span id="enviar" class="link" >Enviar nuevamente</span></p> 
        <button onclick="enviar();" class="btn-style">¡RECIBIDO!</button>
    </div>
    <div class="col-md-4"></div>
   <div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js'> </script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'> </script>
<script>
function getQueryParam(param) {
location.search.substr(1)
.split('&')
.some(function(item) { // returns first occurence and stops
return item.split('=')[0] == param && (param = item.split('=')[1])
})
return param
}

$(document).ready(function() {
 //llave publica del comercio
 //Referencia de payco que viene por url
 
var ref_payco = getQueryParam('ref_payco');
 //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
 var urlapp = 'https://secure.epayco.co/validation/v1/reference/' + ref_payco;
$.get(urlapp, function(response) {
    if (response.success) {
        // Transaccion Aprobada
                if (response.data.x_cod_response == 1) {

                } 
                //Transaccion Rechazada
                if (response.data.x_cod_response == 2) {
                // console.log('transacción rechazada');
                }
                //Transaccion Pendiente
                if (response.data.x_cod_response == 3) {
                // console.log('transacción pendiente');
                } 
                //Transaccion Fallida
                if (response.data.x_cod_response == 4) {
                // console.log('transacción fallida');
                }
                $('#fecha').html(response.data.x_transaction_date);
                $('#curso').html(response.data.x_description);
                $('#respuesta').html(response.data.x_response);
                $('#referencia').text(response.data.x_id_invoice);
                $('#motivo').text(response.data.x_response_reason_text);
                $('#recibo').text(response.data.x_transaction_id);
                $('#banco').text(response.data.x_bank_name);
                $('#autorizacion').text(response.data.x_approval_code);
                $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);
                
                
                // guardando la factura y los datos de la transaccion 
                let urlData = "/transDataPay?referencia="+ ref_payco
                +"&n_recibo="+response.data.x_transaction_id
                +"&estado="+response.data.x_transaction_state
                +"&fecha_pago="+response.data.x_transaction_date
                +"&CodigoRespuesta="+response.data.x_cod_response
                +"&Curso="+response.data.x_extra1;
                $.get(urlData, function(responses) {
                    

                });
    } else 
    {
        alert('Error consultando la información');
    }
});
});

// $('#enviar').attr('onclick','enviar();');
function enviar(){
    window.location.href = "/";
}
// function action_page(action){
//     switch(action){
//         case 1:
//             if(localStorage.getItem('ayuda')===null||localStorage.getItem('ayuda')===undefined){
//                 window.location.href = "/mis-cursos";
//              }else{
//                 localStorage.removeItem('ayuda');
//                 localStorage.setItem('primera_ves',1);
//                 window.location.href = "/perfil";
//             }
//             break;
//         case 2:
//             window.location.href = "/";
//             break;
//         case 3:
//             window.location.href = "/transacciones/";
//             break;
//         default:
//             location.reload();
//             break;
//     }
// }
</script>
</body>
</html>  