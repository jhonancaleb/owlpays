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
                                $mensaje="Hola ".$name."\nAcabamos de recibir tu solicitud de recuperación de contraseña\n 
                                Contraseña: ".$password."
                                \nAtentamente OwlPays."; 
                                $asunto="RECUPERACIÓN DE CONTRASEÑA";
                                mail($correo_destino,$asunto,$mensaje);  
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