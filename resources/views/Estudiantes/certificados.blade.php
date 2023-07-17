<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/css/StylesPerson.css" rel="stylesheet">
    <style>
@page{
    margin:0cm 0cm;
}

body{
    width:100%;
    height:100%;
    background-image: url('/certificado_estruct/fondos/CERTIFICADO D-ACADEMY2.png');
    background-size:100%;
    /* background-color:red; */
    background-attachment:fixed;
    background-repeat:no-repeat;
    background-position:center left;
}
</style>
</head>
<body>
<div class="letra" style="font-family:'Helvetica';position:absolute; height:100%; width:100%;  color: #000;">
        
<div style="text-aling:left; top:140px; position:relative; padding-left:50px;padding-right:80px;">
        <img style="background:transparent;float:right; position:relative; margin-right:-8%; margin-top:-130px;" src="{{$codigobarra}}" alt="">
            <p style="position:relative; font-size:20px; margin-bottom:15px;text-align:left;padding-top:50px; color:#337ab7;">Certifica que</p>
            <p style="position:relative;text-transform:uppercase; font-size:48px;margin-bottom:3px;text-align:left;color:#FF9700;"><strong style="font-weight: 400;">{{$estudiante}}</strong><br>
            </p>
            <p style="font-size:20px;text-align:left;color:#3490dc;margin-top:10px;">Identificado con {{$identificacion}} <br>{{$numeroCedula}}</p>
            <p style="position:relative;font-size:20px; text-align:left;margin-bottom:-8px;color:#3490dc;margin-top:8px;">Cursó y aprobó {{$tipocurso}}</p>
        <p style="position:relative; text-transform: uppercase; text-align:left; width:70%;"> <strong style="font-size:28px;color:#3490dc;font-weight: 400;">{{$curso}}</strong><br>
        <p style="text-align:left;font-size:20px;position:relative;margin-top:12px;margin-bottom:-4px;color:#3490dc;">Con una duración de <strong>{{$horas}}</strong> se hace entrega</p>
        <p style="position:relative; font-size:20px;margin-top:0.5px; text-align:left; color:#3490dc;"> de esta constancia a los <strong>{{$dia}}</strong> dias  del mes <br> de <strong>{{$mesaño}}</strong>.<br>
            </p>
            <div style="float:right;width:290px;top:-90px;position:relative;margin-right:8%;">
            <p><img style="height:170px;margin-left:-18%;" src="{{$firma}}" ></p>
            <p style="margin-top:-73px;width:240px;margin-left:5%;border-bottom:4px solid #337ab7;"></p>
            <p style="margin-left:5%; font-size:18px;"> <strong style="text-transform:uppercase;display:none;">{{$director}}</strong> 
            <span style="font-size:18px;text-transform:capitalize !important;">Director Ejecutivo</span></p>
            </div>
  
</div>
</div>
</body>
</html>





