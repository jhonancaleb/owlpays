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
                   }    
                    //envio a correo
                   $mensaje="Hola ".$name."\nTe acabas de suscribir a ".$name_prove."\nPlan  : ".$plan.".\nPrecio: S/".$precio.".\nAtentamente OwlPays."; 
                   $asunto="SUSCRIPCIÓN A ".$name_prove.".";
                   mail($correo_destino,$asunto,$mensaje);  
                   //envio de mesaje de watsaap
                   require_once ('vendor/autoload.php'); // if you use Composer
                    //require_once('ultramsg.class.php'); // if you download ultramsg.class.php
	
                  $token="eh6ky3jctvpecvcn"; // Ultramsg.com token
                  $instance_id="instance6274"; // Ultramsg.com instance id
                  $client = new UltraMsg\WhatsAppApi($token,$instance_id);
	
                  $to="+51".$number; 
                  $body=$mensaje; 
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
