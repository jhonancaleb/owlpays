<?php 
    $cod=$_GET['id'];
    $plan=$_GET['plan'];
    $precio=$_GET['p'];
    $user=$_GET['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/plan.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="plan.php?user=<?php echo $user; ?>&id=<?php echo $cod; ?>&plan=<?php echo $plan; ?>&p=<?php echo $precio; ?>" method="post" class="datos" onsubmit="enviar(event, this)">
        <h1>Datos de la suscripción</h1>
        <?php
        include "conexion.php";
        $db=new database();
        $query=$db->connect()->prepare('SELECT id_proveedor AS id,nombre AS name FROM proveedores WHERE id_proveedor=:id');
        $query->execute([':id' => $cod]);
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $idd=$row['id'];
        $nombre=$row['name'];
        echo '
        <fieldset>
            <legend>Proveedor</legend>
            <input type="text" name="tx_prove" id="tx_prove" value="'.$nombre.'" readOnly>
        </fieldset>
        <fieldset>
            <legend>Plan</legend>
            <input type="text" name="tx_plan" id="tx_plan" value="'.$plan.' " readOnly>
        </fieldset>
        <fieldset>
            <legend>Precio S/</legend>
            <input type="text" name="tx_precio" id="tx_precio" value="'.$precio.' " readOnly>
        </fieldset>
        <fieldset>
            <legend>Nro. Tarjeta</legend>
            <input type="text" name="tx_tarjeta" id="tx_tarjeta" value="4214" placeholder="Escriba el Nro. de su tarjeta" maxlength="16" onkeypress="valide(event)" required>
        </fieldset>
        <input class="btn-sus" id="boton" type="submit" value="Suscribirse">
        ';
        
        if(!empty($_POST['tx_tarjeta'])=="")
        {  }
        else
        {
            include 'conectar.php';
            $tarjeta=$_POST['tx_tarjeta'];
            ini_set('date.timezone','America/Lima');
            $fecha=date('Y-m-d H:i:s');
            //FECHA_FINAL
            if($plan=='PREMIUM/MENSUAL'){
                $mod_date = strtotime($fecha."+ 1 month");
                $fecha_fin=date("Y-m-d H:i:s",$mod_date);
            }
            elseif($plan=='BÁSICO/SEMANAL'){
                $mod_date = strtotime($fecha."+ 1 week");
                $fecha_fin=date("Y-m-d H:i:s",$mod_date);
            }
            elseif($plan=='ESTÁNDAR/QUINCENAL'){
                $mod_date = strtotime($fecha."+ 15 days");
                $fecha_fin=date("Y-m-d H:i:s",$mod_date);
            }
            $insertar="INSERT INTO suscripciones(dni_cliente,id_prove,plan,tarjeta,fecha_hora,fecha_fin,total) 
            values('$user','$cod','$plan','$tarjeta','$fecha','$fecha_fin','$precio')";
            $result=$db_connect -> query($insertar);

            //enviar mensaje
            $sql_prod ="SELECT u.nombres,u.telefono, p.nombre,u.correo FROM usuarios u , proveedores p WHERE dni_cliente=$user and id_proveedor=$cod";  
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
               while ( $rows = $result_prod -> fetch_assoc() ) {
                   $number = $rows['telefono'];
                   $name = $rows['nombres'];
                   $name_prove= $rows['nombre'];
                   $correo_destino= $rows['correo'];
                   $imagen= $rows['image'];
                   }    
                    //envio a correo
                    $asunto="SUSCRIPCIÓN A ".$name_prove.".";
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
                   mail($destinatario,$asunto,$cuerpo,$cabecera); 

                   //envio de mesaje de watsaap
                   require_once ('vendor/autoload.php'); // if you use Composer
                    //require_once('ultramsg.class.php'); // if you download ultramsg.class.php
	
                  $token="eh6ky3jctvpecvcn"; // Ultramsg.com token
                  $instance_id="instance6274"; // Ultramsg.com instance id
                  $client = new UltraMsg\WhatsAppApi($token,$instance_id);
	
                  $to="+51".$number; 
                  $body="Hola ".$name."\nTe acabas de suscribir a ".$name_prove."\nPlan  : ".$plan.".\nPrecio: S/".$precio.".\nAtentamente OwlPays."; 
                  $api=$client->sendChatMessage($to,$body);
             }        

            
        }
        ?>
    </form>
    <div class="aviso" id="aviso">
        <div class="di letra">
            <p>¡Felicidades!
               Suscripción exitosa.
            </p>
        </div>
        <div class="di ima">
            <img src="../img/avion.png" alt="avion">
        </div>
    </div>
    <script>
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        function enviar(evento, formulario){
            evento.preventDefault(); //Cancelo el envío
                setTimeout(function(){ //Aplico el temporizador
                    formulario.submit(); //Envío los datos
            },1000);         
        }

        let con=document.querySelector("#aviso");
        const btn=document.querySelector("#boton");
        function next(){
            setTimeout(function(){
                con.style.transition="all 0.5s";
                con.style.marginLeft="41em";
            },100);
        }
        btn.addEventListener("click",function(){
            next();
        });
    </script>

</body>
</html>
