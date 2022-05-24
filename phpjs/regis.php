<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="myscript.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/buho.png">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Owlpays|Registrarse</title>
</head>
<body>
    <section>
        <header class="head">
            <div class="logo">
                <img src="../img/buho.png" alt="buho">
                <label>OwlPays</label>
            </div>
            <div class="botones">
                <ul>
                    <li><a class="boton1" href="#">Registrate</a></li>
                    <li><a class="boton2" href="inicio_sesion.php">Iniciar sesion</a></li>
                </ul>
            </div>
        </header>
        <section class="container">
            <form method="post" action="regis.php" class="form_regis">
                <div class="datos">
                    <div class="" id=""><h1>Registrate aquí</h2></div>
                    <div class="en">
                        <div class="en_nombres" id="">
                            <span class="icon-is-left" ><i id="es" class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="tx_nombres" id="tx_nombres" placeholder="Escriba sus nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                    <div class="en">
                        <div class="en_dni" id="">
                            <span class="icon-is-left" ><i class="fa fa-id-card" aria-hidden="true"></i></span>
                            <input type="text" name="tx_dni" id="tx_dni" maxlength="8" placeholder="Escriba su DNI" onKeypress="valide(event);" required>
                        </div>
                    </div>
                    <div class="en">
                        <div class="en_correo" id="">
                            <span class="icon-is-left" ><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" name="tx_correo" id="tx_correo" placeholder="Escriba su correo electrónico" required>
                        </div>
                    </div>
                    <div class="en">
                        <div class="en_telefono" id="">
                            <span class="icon-is-left" ><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                            <input type="text" name="tx_tele" id="tx_tele" maxlength="9" placeholder="Escriba su número telefónico" onKeypress="valide(event);" required>
                        </div>
                    </div>
                    <div class="en">
                        <div class="en_contraseña" id="">
                            <span class="icon-is-left" ><i id="es" class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                            <input type="password" name="tx_pass" id="tx_pass" placeholder="Cree su contraseña" required>
                        </div>
                    </div>
                    <?php
                     include ("conectar.php");
                     if(!empty($_POST['tx_nombres'])=="")
                     {}
                     else{                         
                        $user=$_POST['tx_dni'];
                        $telefono=$_POST['tx_tele'];
                        $correo=$_POST['tx_correo'];
                        $sql_prod ="SELECT * FROM usuarios WHERE dni_cliente=$user OR telefono=$telefono OR correo='$correo'";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if ($result_prod -> num_rows > 0) {
                            echo'
                            <h4>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Al parecer alguien ya esta registrado con los mismos datos.
                            </h4>
                            ';
                        }
                        else{
                        $names=$_POST['tx_nombres'];
                        $dni=$_POST['tx_dni'];
                        $correo=$_POST['tx_correo'];
                        $telefono=$_POST['tx_tele'];
                        $contrase=$_POST['tx_pass'];
                        //crear cuenta
                        $insertar="insert into usuarios values('$dni','$names','$correo','$telefono','$contrase','2'";
                        $result= $db_connect -> query($insertar);
                        
                        //enviar mail de bienvenida
                        $asunto="BIENVENIDO A OWLPAYS";
                        $destinatario=$correo;
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
                                    <h1>BIENVENIDO</h1>
                                    <p class="mensaje">Hola '.$names.'. Acabas de inscribirte a OwlPays, la pagina que contiene los servicios mas populares del mercado. </p>
                                    <div class="suscripcion">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4245/4245516.png" alt="" class="img-service">
                                        <div class="datos">
                                            <p>Te damos la bienvenida. Esperamos que estes bien y que tu estadía sea larga. </p>
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
                        //envio al WhatsAppApi
                        //envio de mesaje de watsaap
                        require_once ('vendor/autoload.php'); // if you use Composer
                        //require_once('ultramsg.class.php'); // if you download ultramsg.class.php

                        $token="pkognlf2rjj1xurl"; // Ultramsg.com token
                        $instance_id="instance7176"; // Ultramsg.com instance id
                        $client = new UltraMsg\WhatsAppApi($token,$instance_id);

                        $to="+51".$telefono; 
                        $body="BIENVENIDO A OWLPAYS\n Hola".$names."\nTe acabas de inscribir a OwlPays, la página con los servicios mas populares del mercado.Esperamos que tu estadía sea larga.\nAtentamente OwlPays."; 
                        $api=$client->sendChatMessage($to,$body);

                        //entrar a su cuenta
                        $_SESSION['username']=$user;
                        echo "<meta http-equiv='refresh' content='1;URL=main.php?id=".$user."'>";
                        }    
                     }
                    ?>
                    <input type="submit" value="Registrarse">
                    <div class="a">
                        <a href="inicio_sesion.php">Iniciar sesión</a>
                    </div>
                </div>
                <div class="img"><img src="../img/bot.png" alt=""></div>
            </form>
        </section>
    </section>
</body>
</html>
