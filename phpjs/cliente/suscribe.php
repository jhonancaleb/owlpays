<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    include '../conectar.php';                            
    $id=$_GET['id'];
    $user=$_SESSION['username'];
    $proveedor=$_POST['tx_servicio'];
    $plan=$_POST['tx_plan'];
    $precio=$_POST['tx_precio'];
    $tarjeta=$_POST['tx_tarjeta'];
    //fechas
    ini_set('date.timezone','America/Lima');
    $fecha=date('Y-m-d H:i:s');
    //FECHA_FINAL
    if($plan=='MENSUAL'){
        $mod_date = strtotime($fecha."+ 1 month");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    elseif($plan=='SEMANAL'){
        $mod_date = strtotime($fecha."+ 1 week");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    elseif($plan=='QUINCENAL'){
        $mod_date = strtotime($fecha."+ 15 days");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    //comprbar si ya sta suscrito a este servicio
    $sql="SELECT * from suscripciones where id_prove=$id";
    $sql_res=$db_connect->query($sql);
    if($sql_res -> num_rows > 0){
        echo'
        <h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Usted ya está suscrito a este servicio.</h4>
        ';
    }
    else{
        $insertar="INSERT INTO suscripciones(dni_cliente,id_prove,plan,tarjeta,fecha_hora,fecha_fin,total) 
        values('$user','$id','$plan','$tarjeta','$fecha','$fecha_fin','$precio')";
        if($result=$db_connect -> query($insertar)){
            echo'
            <h4 class="warning"><i class="fa-solid fa-check"></i> Suscripción relizada con exito.</h4>
            <script>
                document.querySelector("#aviso").classList.add("ok");
                setTimeout(function(){
                    top.location.reload();
                },1500);
            </script>
            ';
            //enviar mensaje
            $sql_prod ="SELECT u.nombres,u.telefono, p.nombre,u.correo FROM usuarios u , proveedores p WHERE dni_cliente=$user and id_proveedor=$id";  
            $result_prod = $db_connect -> query($sql_prod);
             while ( $rows = $result_prod -> fetch_assoc() ) {
                   $number = $rows['telefono'];
                   $name = $rows['nombres'];
                   $name_prove= $rows['nombre'];
                   $correo_destino= $rows['correo'];
                   $imagen= $rows['image'];
                   }          
            //envio a correo
            /* $asunto="SUSCRIPCIÓN A ".$name_prove.".";
            $destinatario=$correo_destino;
            $cuerpo='
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Correo</title>
                <style>
                    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
                    *{
                        padding: 0;
                        margin: 0;
                        box-sizing: border-box;
                        font-family: "arial";
                    }
                    body{
                        width: 100%;
                        height: 100vh;
                        display:flex;
                        justify-content: center;
                        align-items: center;
                    }
                    .container-mensaje{
                        width: 30em;
                        height: 35em;
                        padding: 10px 40px;
                        border:3px solid rgb(230, 223, 223);
                    }
                    .container-mensaje .header{
                        width: 100%;
                        display: flex;
                        align-items: center;
                        gap:10px;
                        height: 4em;
                    }
                    .container-mensaje .header img{
                        width: 3em;height: 3em;
                    }
                    .container-mensaje .header label{
                        font-size: 30px;
                    }
                    .cuerpo{
                        margin:2em auto;
                        width: 98%;
                    }
                    .cuerpo span{
                        color:#0077ff;
                        font-weight: bold;
                    }
                    .cuerpo h1{
                        text-align: center;
                        font-family: "Poppins",sans-serif;
                        font-weight: 700;
                    }
                    .cuerpo .mensaje{
                        color:#5f5a5a;
                        margin: 10px auto;
                    }
                    .cuerpo .suscripcion{
                        width: 98%;
                    }
                    .cuerpo .suscripcion img{
                        width: 7em;
                        height: 7em; 
                        margin:1em 8.5em;}
                    .cuerpo .datos table{
                        margin:1em auto;
                        width: 40%;
                    }
                    .cuerpo .datos table .th{
                        color:#0e417a;
                        font-size:15px;
                        font-weight: bold;
                        font-family: "Poppins",sans-serif;
                        width: 50%;
                        text-align: left;
                    }
                    .cuerpo .datos table td{
                        font-size:13px;
                        text-align: center;
                    }
                    .footer{
                        position: relative;
                        bottom: 0;
                        text-align: center;
                        font-size:12px;
                    }
                </style>
            </head>
            <body>
                <div class="container-mensaje">
                    <div class="header">
                    <img src="https://cdn-icons-png.flaticon.com/512/2369/2369321.png" alt="Buho.png" clas="img-logo">
                    <label for="">OwlPays</label>
                    </div>
                    <hr>
                    <div class="cuerpo">
                        <h1>SUSCRIPCIÓN EXITOSA</h1>
                        <p class="mensaje">Hola '.$name.'.Acabas de realizar una suscripción a un servicio de <span>'.$name_prove.'</span>.</p>
                        <div class="suscripcion">
                        <img src="data:image/jpg;base64,'.base64_encode($imagen).'" alt="" class="img-service">
                            <div class="datos">
                                <table>
                                    <tr>
                                        <td class="th">Plan</td>
                                        <td>'.$plan.'</td>
                                    </tr>
                                    <tr>
                                        <td class="th">Precio</td>
                                        <td>S/'.$precio.'</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="footer">
                        <hr>
                        <p>
                            Ha recibido esta notificación obligatoria del servicio de correo electrónico para mantenerle actualizado acerca de los cambios importantes en el producto o en la cuenta de OwlPays.</p>
                    </div>
                        
                </div>      
            </body>
            </html>
            ';
            //cabeceras para el envio del correo en formato html
           $cabecera="MIME-Version: 1.0\r\n";
           $cabecera.="Content-type: text/html; charset=iso-8859-1\r\n";
           mail($destinatario,$asunto,$cuerpo,$cabecera);  */

           //envio de mesaje de watsaap
           require_once ('vendor/autoload.php'); // if you use Composer
            //require_once('ultramsg.class.php'); // if you download ultramsg.class.php

          $token="pkognlf2rjj1xurl"; // Ultramsg.com token
          $instance_id="instance7176"; // Ultramsg.com instance id
          $client = new UltraMsg\WhatsAppApi($token,$instance_id);

          $to="+51".$number; 
          $body="Hola ".$name."\nTe acabas de suscribir a ".$name_prove."\nPlan  : ".$plan.".\nPrecio: S/".$precio.".\nAtentamente OwlPays."; 
          $api=$client->sendChatMessage($to,$body);
        }
        else{
            echo'
            <h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Al parecer ocurrió un error.</h4>
            ';
        }  
    }
    
     
    ob_end_flush();
?>