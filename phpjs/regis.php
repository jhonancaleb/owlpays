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
    <title>Owlpays|Inicio Sesion</title>
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
                        $insertar="insert into usuarios values('$dni','$names','$correo','$telefono','$contrase')";
                        $result= $db_connect -> query($insertar);
                        //entarra a su cuenta
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