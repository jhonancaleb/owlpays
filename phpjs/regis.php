<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="myscript.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg></script>
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
                        <div class="en_direcc" id="">
                            <span class="icon-is-left" ><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <input type="text" name="tx_direcc" id="tx_direcc" placeholder="Escriba su dirección" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
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
                    <input type="submit" value="Registrarse">
                    <?php
                     include ("conectar.php");
                     if(!empty($_POST['tx_nombres'])=="")
                     {}
                     else{
                        $names=$_POST['tx_nombres'];
                        $dni=$_POST['tx_dni'];
                        $direccion=$_POST['tx_direcc'];
                        $telefono=$_POST['tx_tele'];
                        $contrase=$_POST['tx_pass'];
                    
                        $insertar="insert into usuarios values('$dni','$names','$direccion','$telefono','$contrase')";
                        $result= $db_connect -> query($insertar);
                     }
                    ?>
                    <div class="a">
                        <a href="inicio_sesion.php">Iniciar sesión</a>
                    </div>
                </div>
                <div class="img"><img src="../img/bot.png" alt=""></div>
            </form>
        </section>
        <!-- OLAS -->
       <!--  <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div> -->
    </section>
</body>
</html>