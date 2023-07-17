<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de recuperacion</title>
</head>
<body>
    <style>
    .img-logo{
        justify-content:center;
    }
    </style>
    <table cellspacing="0" cellpadding="10" style="jsutify-content:center;">
        <tbody>
            <tr>
                <td><img style="justify-content:center; text-align:center;width:250px;height:80px;" src="https://d-academy.co/img/LOGO.png" alt=""></td>
            </tr>
            <tr>
                <td>
                   <p>Estimado(a) {{$usuario}},</p>
                </td>
            </tr>
            <tr>
                <td>
                   <p>De antemano, un gusto saludarte, a continuación te contaremos cómo será el paso a seguir para activar tu certificación con Certjoin en <strong>{{$curso}}</strong>.</p>
                </td>
            </tr>
            <tr>
                <td style="padding-left:50px;">
                   <p>1. Nuestro equipo ha recibido tu solicitud de forma <strong>satisfactoria</strong>.</p>
                   <p>2. Una vez validado tu pago, nuestro equipo iniciará el <strong>proceso de activación</strong> de tu <strong> certificación profesional en {{$curso}}</strong>.</p>
                   <p>3. Este proceso de activación tiene un tiempo de <strong>72 horas</strong> (el cual Certjoin acredita tus datos de activación y te da acceso a la plataforma donde podrás descargar el contenido, acceder al simulador y realizar el examen).</p>
                   <p>4. Recuerda que tienes máximo <strong>60 días calendario</strong> para hacer el examen.</p>
                   <p>5. El examen consta de <strong>{{$cantidad}}</strong> y es importante que aciertes en un <strong>{{$porcentaje}}</strong> para poder pasarlo.</p>
                   <p>6. En caso de que no logres pasarlo, tendrás derecho a <strong>repetirlo una segunda ocasión</strong>.</p>
                   <p>7. Para ello te invitamos a que hagas <strong>uso del simulador</strong> las veces que sea necesario para prepararte correctamente y así poder pasar el examen.</p>
                </td>
            </tr>
            <tr>
                <td>
                <p>Agradecemos enormemente que nos hayas escogido como ente certificador y facilitador de tus peldaños en el camino del éxito profesional.</p>
                </td>

            </tr>
            <tr>
            <td>
                    <p>Te recordamos que si luego de las 72 horas de la compra no te ha llegado notificación nuestra, revises en la bandeja de no deseados o puedes escribirnos a <a href="mailto:admisiones@d-academy.co">admisiones@d-academy.co</a> y ¡con gusto te solucionaremos!  </p>
            </td>
            </tr>
            <tr>
                    <td><p>Quedamos atentos a cualquier inquietud,</p></td>
            </tr>
            <tr>
                    <td><p>Cordialmente,</p></td>
            </tr>
            <tr>
                    <td>
                        <img src="https://d-academy.co/img/LOGO.png" stye="width:210px; height:40px;" alt="" srcset="">
                        <p>Equipo de Admisiones</p>
                        <p ><em>D-Academy Academia Digital</em></p>
                        <p>Mail: admisiones@d-academy.co</p>
                    </td>
            </tr>
        </tbody>
    </table>
   
</body>
</html>