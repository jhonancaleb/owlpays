<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../img/buho.png">
    <script src="myscript.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Owlpays|Inicio Sesion</title>
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
                    <li><a class="boton2" href="#">Iniciar sesion</a></li>
                </ul>
            </div>
        </header>
        <form  method="post" action="inicio_sesion.php" class="form_sesion">
            <div class="datos">
                <div class="" id=""><h1>Inicio de sesión</h2></div>
                <div class="en">
                   <label class="label"><h2>Usuario</h2></label>
                    <div class="en_usuario" id="">
                        <span class="icon-is-left" ><i id="es" class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" name="tx_usu" id="tx_usu" placeholder="Su usuario es su DNI" onfocus="myFunction()" required>
                    </div>
                </div>
                <div class="en">
                    <label class="label"><h2>Contraseña</h2></label>
                    <div class="en_contraseña" id="">
                        <span class="icon-is-left" ><i id="es" class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" name="tx_pass" id="tx_pass" placeholder="Escriba su contraseña" onfocus="myFunction()" required>
                    </div>
                </div>
                <div class="avisos">
                <?php
                    $i=uniqid();
                    if(isset($_POST['tx_usu'])&& isset($_POST['tx_pass'])) 
                    {
                        include "conexion.php";
                        $db=new database();
                        $query=$db->connect()->prepare('SELECT dni_cliente AS username,nombres AS name,tipo, password FROM usuarios WHERE dni_cliente=:username AND password=:password');
                        $query->execute([':username' => $_POST['tx_usu'],
                                          ':password' => $_POST['tx_pass']]);
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        if($row)
                        {
                            $_session=$row;
                            $user=$_POST['tx_usu'];
                            $_SESSION['username']=$user;
                            if($row['password']==$_POST['tx_pass'] && $row['username']==$_POST['tx_usu']  && $row['tipo']=='2'){
                                header("Location:main.php?id=".$user."");
                                //echo "<meta http-equiv='refresh' content='1;URL=main.php?id=".$user."'>";
                            }
                            elseif($row['password']==$_POST['tx_pass'] && $row['username']==$_POST['tx_usu']  && $row['tipo']=='1'){
                                header("Location:admin/admin_page.php");
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
                &nbsp;&nbsp;<a href="forget_pass.php" class="forget">Olvidé mi contraseña</a>
                </div>
                <input type="submit" value="Ingresar">
                <div class="a">
                    <a href="regis.php">Registrarse</a>
                </div>
            </div>
            <div class="img"></div>
        </form>
    </section>
</body>
</html>