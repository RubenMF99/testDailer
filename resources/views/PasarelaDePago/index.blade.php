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
<header id='main-header' style='margin-top:20px'>
<div class='row'>
<div class='col-lg-12 franja'>
<img class='center-block' src='{{asset("img/logo_d_academy.png")}}' style=''>
</div>
</div>
</header>
<div class='container'>
<div class='row' style='margin-top:20px'>
<div class='col-lg-8 col-lg-offset-2'>
<h4 style='text-align:left'> Respuesta de la Transacción </h4>
<hr >
</div >
<div class='col-lg-8 col-lg-offset-2' >
<div class='table-responsive'>
<table class='table table-bordered'>
<tbody>
<tr>
<td>Referencia </td>
<td id='referencia'> </td>
</tr>
<tr>
<td class='bold'> Fecha </td>
<td id='fecha' class=''>  </td>
</tr>
<tr>
<td> Respuesta </td>
<td id='respuesta'>  </td>
</tr>
<tr>
<td> Motivo </td>
<td id='motivo'> </td>
</tr>
<tr>
<td class='bold'> Banco </td>
<td class='' id='banco'>
</tr>
<tr>
<td class='bold'> Recibo </td>
<td id='recibo'>  </td>
</tr>
<tr>
<td class='bold'> Total </td>
<td class='' id='total'>
</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>
<div class="row">
    <div class="col-md-6">
    <button class="btn btn-primary" style="float:right;" id="accion" onclick=""></button>
    </div>
    
</div>
</div>

<footer>
<div class='row'>
<div class='container'>
<div class='col-lg-8 col-lg-offset-2'>
<img src='https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/pagos_procesados_por_epayco_260px.png' style='margin-top:10px; float:left'>  <img src='https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/credibancologo.png' height='40px' style='margin-top:10px; float:right'>
</div>
</div>
</div>
</footer>
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
                $('#respuesta').html(response.data.x_response);
                $('#referencia').text(response.data.x_id_invoice);
                $('#motivo').text(response.data.x_response_reason_text);
                $('#recibo').text(response.data.x_transaction_id);
                $('#banco').text(response.data.x_bank_name);
                $('#autorizacion').text(response.data.x_approval_code);
                $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);
                
                
                // guardando la factura y los datos de la transaccion 
                let urlData = "/transData?referencia="+ ref_payco+"&n_recibo="+response.data.x_transaction_id+"&estado="+response.data.x_transaction_state+"&fecha_pago="+response.data.x_transaction_date+"&CodigoRespuesta="+response.data.x_cod_response+"&Curso="+response.data.x_extra1;
                $.get(urlData, function(responses) {
                    if (Boolean(responses)) {
                        if(response.data.x_cod_response===2 || response.data.x_cod_response === 4)
                        {
                            $('#accion').attr('onclick','action_page(2);');
                        }else if(response.data.x_cod_response===3){
                            $('#accion').attr('onclick','action_page(3);');
                        }else{
                            $('#accion').attr('onclick','action_page(1);');
                        }
                        
                        $('#accion').html('Volver');
                    }else{
                        alert('Error al Guardar la informacion');
                        $('#accion').attr('onclick','action_page(2);');
                        $('#accion').html('Recargar Pagina');
                    }

                });
    } else 
    {
        alert('Error consultando la información');
    }
});
});

function action_page(action){
    switch(action){
        case 1:
            window.location.href = "/mis-cursos";
            break;
        case 2:
            window.location.href = "/";
            break;
        case 3:
            window.location.href = "/transacciones/";
            break;
        default:
            location.reload();
            break;
    }
}
</script>
</body>
</html>  