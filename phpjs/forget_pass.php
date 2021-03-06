<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="myscript.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OwlPays|Olvidé mi contraseña</title>
    <link rel="icon" href="../img/buho.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/password.css">
</head>
<body>
    <section class="cuerpo">
        <header class="head">
            <div class="logo">
                <img src="../img/buho.png" alt="buho">
                <label>OwlPays</label>
            </div>
            <div class="botones">
                <ul>
                    <li><a class="boton1" href="regis.php">Registrate</a></li>
                    <li><a class="boton2" href="inicio_sesion.php">Iniciar sesion</a></li>
                </ul>
            </div>
        </header>
        <div class="container-general">
            <div class="container-form">
                <div class="img-form">
                    <img src="../img/password.jpg" alt="">
                </div>
                <form action="forget_pass.php" method="post" class="form">
                    <h2>¿Olvidaste tu contraseña?</h2>
                    <p>Escribe tu usuario(DNI) y te enviaremos un correo a tu cuenta Gmail.</p>
                    <input type="text" class="input" name="tx_usuario" maxlength="8" onKeypress="valide(event);" placeholder="Escribe tu Usuario" required>
                    <?php 
                        include ("conectar.php");
                        if(!empty($_POST['tx_usuario'])=="")
                        {}
                        else{
                            $user=$_POST['tx_usuario'];
                            $sql_prod ="SELECT * FROM usuarios WHERE dni_cliente=$user";  
                            $result_prod = $db_connect -> query($sql_prod);
                            if ($result_prod -> num_rows > 0) {
                                while ( $rows = $result_prod -> fetch_assoc() ) {
                                    $name = $rows['nombres'];
                                    $correo_destino= $rows['correo'];
                                    $password = $rows['password'];
                                }
                                //envio de correo con la contraseña
                                $asunto="RECUPERACIÓN DE CONTRASEÑA";
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
                                            position: relative;
                                            width: 30em;
                                            height: 35em;
                                            padding: 10px 40px;
                                            background: #f3f1f1;
                                            border:3px solid #e6dfdf;
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
                                        .cuerpo h1{
                                            text-align: center;
                                            font-family: "Poppins",sans-serif;
                                            font-weight: 700;
                                            font-size: 24px;
                                        }
                                        .cuerpo .mensaje{
                                            color:#5f5a5a;
                                            margin: 10px auto;
                                        }
                                        .cuerpo .info{
                                            width: 98%;
                                        }
                                        .cuerpo .info img{
                                            position: relative;
                                            width: 7em;
                                            height: 7em;
                                            margin:10px calc(50% - 3em);
                                        }
                                        .cuerpo .datos{
                                            width: 60%;
                                            margin:0 auto;
                                            text-align: center;
                                        }
                                        .cuerpo .datos h2{
                                            font-size: 20px;
                                            color:rgb(30, 91, 204);
                                        }
                                        .cuerpo .datos p{
                                            background: #21025c;
                                            padding: 7px;
                                            border-radius: 5px;
                                            color:white;
                                            margin:5px auto;
                                            cursor:copy;
                                            letter-spacing: 2px;
                                            font-family: "Console";
                                        }
                                        .footer{
                                            position: absolute;
                                            bottom: 20px;
                                            left:50%;
                                            transform: translate(-50%,-50%);
                                            width:90%;
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
                                            <h1>¿OLVIDASTE TU CONTRASEÑA?</h1>
                                            <p class="mensaje">Hola '.$name.'. Acabamos de recibir tu solicitud de recuperación de contraseña. Procura no volver a olvidarla</p>
                                            <div class="info">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7072/7072990.png" alt="">
                                                <div class="datos">
                                                    <h2>Contraseña</h2>
                                                    <p>'.$password.'</p>
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
                                if(mail($destinatario,$asunto,$cuerpo,$cabecera))
                                {
                                    echo'
                                    <h4 class="recibida">
                                    <span class="material-symbols-outlined">check_circle
                                    </span>Solicitud recibida. Le enviaremos un correo.
                                    </h4>
                                    ';
                                }
                                else{
                                    echo'
                                    <h4 class="error">
                                    <span class="material-symbols-outlined">cancel
                                    </span>Al parecer hubo un problema. Intentelo mas tarde.
                                    </h4>
                                    ';
                                }
                            }
                            else{
                                echo'
                                <h4 class="error">
                                <span class="material-symbols-outlined">cancel
                                </span>Al parecer el usuario que ingreso no existe
                                </h4>
                                ';
                            }
                        }
                    ?> 
                    <input type="submit" value="Listo" class="submit">
                </form>
            </div>
        </div>
    </section>
    
</body>
</html> 