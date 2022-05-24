<?php
    ob_start();
    session_start();
    if(isset($_SESSION['username'])){
        header('Location:phpjs/main.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="img/buho.png" type="image/ong">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OwlPays|Login</title>
</head>
<body>
    <header class="head">
        <a href="login.php" class="logo" id="logo">
            <img src="img/icons8-búho-64.png" alt="buho">
            <label for="logo">OwlPays</label>
        </a>
    </header>
    <section class="bg">
        <div class="container">
            <div class="user singinBx">
                <div class="imgBx"><img src="img/img-1.jpg" alt=""> </div>
                <div class="formBx">
                    <form action="login.php" method="post">
                        <h2>Iniciar Sesión</h2>
                        <div class="campo">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="tx_usuario" id="" maxlength="8" minlength="8" placeholder="Usuario" required>
                        </div>
                        <div class="campo">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="tx_password" id="" placeholder="Contraseña" required>
                        </div>
                        <?php
                            if(isset($_POST['tx_usuario'])&& isset($_POST['tx_password'])) 
                            {
                                include "phpjs/conexion.php";
                                $db=new database();
                                $query=$db->connect()->prepare('SELECT dni_cliente AS username,nombres AS name,tipo, password FROM usuarios WHERE dni_cliente=:username AND password=:password');
                                $query->execute([':username' => $_POST['tx_usuario'],
                                                  ':password' => $_POST['tx_password']]);
                                $row=$query->fetch(PDO::FETCH_ASSOC);
                                if($row)
                                {
                                    $user=$_POST['tx_usuario'];
                                    $password=$_POST['tx_password'];
                                    $_SESSION['username']=$user;
                                    if($row['password']==$password && $row['username']==$user  && $row['tipo']=='2'){
                                        header("Location:phpjs/main.php");
                                        //echo "<meta http-equiv='refresh' content='1;URL=main.php?id=".$user."'>";
                                    }
                                    elseif($row['password']==$password && $row['username']==$user  && $row['tipo']=='1'){
                                        header("Location:phpjs/admin/admin_page.php");
                                        //echo "<meta http-equiv='refresh' content='1;URL=main.php?id=".$user."'>";
                                    }
                                    else{
                                        echo "<h4><i class='fa fa-exclamation-triangle icon' aria-hidden='true'></i>
                                        Usuario no encontrado</h4>";
                                    }
                                }
                                else{
                                    echo "<h4><i class='fa fa-exclamation-triangle icon' aria-hidden='true'></i>
                                    Datos no encontrados</h4>";
                                } 
                            }              
                        ?>
                        <div class="botones">
                            <input type="submit" name="" value="Ingresar">
                            <a class="forget" onclick="pass();">Olvidé mi contraseña</a>
                        </div>
                        <p>¿Aún no tienes una cuenta?<a onclick="toggleForm();"> Registrarse</a></p>
                    </form>
                </div>    
            </div> 
            <div class="user singupBx">
                <div class="formBx">
                    <form id="formu-regis" method="post">
                        <h2>Crea una cuenta</h2>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input type="text" name="tx_nombres" id="nombres"  placeholder="Nombres y Apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="campo">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="tx_dni" id="dni" maxlength="8" minlength="8" onkeypress="valide(event);" placeholder="Nombre de usuario DNI" required>
                        </div>
                        <div class="campo">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="tx_correo" id="correo"  placeholder="Correo" required>
                        </div>
                        <div class="campo">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="tx_tele" id="tele" maxlength="9" minlength="9" onkeypress="valide(event);" placeholder="Teléfono" required>
                        </div>
                        <div class="campo">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="tx_pass" id="password"  placeholder="Crea tu contraseña" required>
                        </div>
                        <div id="aviso"></div>
                        <input type="submit" id="btn-regis" value="Registrarse">
                        <p>¿Ya tienes una cuenta?<a onclick="toggleForm();"> Iniciar Sesión</a></p>
                    </form>
                </div>  
                <div class="imgBx"><img src="img/regis.jpg" alt=""> </div>  
            </div>
            <div class="user passBx" id="pass">
                <div class="formBx">
                    <form id="formu-forget" method="post">
                        <h2>¿Olvidaste tu Contraseña?</h2>
                        <p>Ingrese su nombre de usuario y le enviaremos un correo a su gmail con su contraseña</p>
                        <div class="campo">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" id="usuarioxpassword" name="tx_usuario" maxlength="8" onkeypress="valide(event);" minlength="8" placeholder="Escriba su Nombre de Usuario" required>
                        </div>
                        <div id="aviso-password"></div>
                        <input id="btn-pass" type="submit" value="Listo">
                        <p><a onclick="pass();"> Iniciar Sesión</a></p>
                    </form>
                </div>  
                <div class="imgBx"><img src="img/password.jpg" alt=""> </div>  
            </div>    
        </div>
    </section>
    <script src="js/scrypt.js"></script>
</body>
</html>  
<?php
ob_end_flush();
?>