<?php 
    session_start();
    error_reporting(0);
    $var=$_SESSION['username'];
    if($var==null || $var==''){
        header("Location:inicio_sesion.php");
        die();
    } 
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
    <link rel="icon" type="image/png" src="../img/buho.png">
    <link rel="stylesheet" href="../css/style_main.css">
    <title>Olwpays</title>
    <script>
      var clic = 1;
      function mostrar(){ 
         if(clic==1){
         document.getElementById("ven_exit").style.visibility="visible";
         document.getElementById("ven_exit").style.opacity = "1";
         document.getElementById("im").style.animation = "ani .3s ease .5s forwards"; 
         document.getElementById("ul").style.animation = "ane .3s ease .5s forwards"; 
         clic = clic + 1;
         } else{
             document.getElementById("ven_exit").style.visibility="hidden"; 
             document.getElementById("ven_exit").style.opacity = "0";  
             document.getElementById("im").style.animation = "none"; 
             document.getElementById("ul").style.animation = "none";   
          clic = 1;
         }    
      }
      
    </script>
</head>
<body id="body">
    <?php
    include "conexion.php";
    $code=$_GET['id'];
    $db=new database();
    $query=$db->connect()->prepare('SELECT dni_cliente AS username,nombres AS name FROM usuarios WHERE dni_cliente=:username');
    $query->execute([':username' => $_GET['id']]);
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $idd=$row['username'];
    $nombres=$row['name'];
    ?>
    <section class="all">
        <header class="head">
            <div class="logo">
                <img src="../img/buho.png" alt="buho">
                <label>OlwPays</label>
            </div>
            <div class="user">
                <div class="name">
                <h2><?php echo $nombres;?><br> User : <?php echo $idd;?></h2>
                </div>
                <div class="icon" id="btn-abrir">
                    <img src="../img/usuario.png" alt="user" onclick="mostrar()">
                </div>
                
            </div>
        </header>
        <section class="cuerpo">
            <div id="ven_exit" class="ven_exit">
                <div class="im" id="im">
                    <img src="../img/usuario.png" alt="usuario">
                    <h1><?php echo $nombres;?></h1>
                    <h2>User : <?php echo $idd;?></h2>
                </div>
                <ul id="ul">
                    <li><a href=""><i class="fa fa-bell" aria-hidden="true"></i>  Notificaciones</a></li>
                    <li class="dos"><a href="cerrar_sesion.php"><i class="fa fa-outdent" aria-hidden="true"></i>  Cerrar sesión</a></li>
               </ul>
            </div>
            <div class="container">
                <div class="menu">
                    <h3>Suscribete o dale un vistazo a tus suscricpciones</h3>
                    <ul>
                        <li class="uno"><a href="proves.php?id=<?php echo $idd ?>" target="formularios">► Proveedores y/o Servicios<a>
                        <li class="dos"><a href="sus.php?id=<?php echo $idd ?>" target="formularios">► Mis suscripciones</a></li>
                    </ul>
                </div>
                <iframe class="scro" src="proves.php?id='<?php echo $code ?>'" frameBorder="0" name="formularios"></iframe>
               <!--  frameBorder="0" scrolling="no" -->
            </div>
        </section>
    </section>
</body>
</html>