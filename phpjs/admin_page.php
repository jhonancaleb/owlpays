<?php
    session_start();
    $user=$_SESSION['username'];
    if($user==null || $user==''){
        header("Location:../index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../img/logo.webp" type="image/webp">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script><!-- //mi kit en font awesome -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="../css/menu.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IE "Levi Ackerman"</title>
</head>
<body>
    <div class="body">
        <div class="menu-barra" id="menu-barra">
            <div class="con-bar">
                <div class="bar" id="btn"><i class="fa-solid fa-bars"></i></div>
            </div>
            
            <div class="logo" id="logo">
                <img src="../img/logo.webp" alt="">
                <label id="ie">IE Levi Ackerman</label>
            </div>
            <div class="opciones">
                <a class="opcion" href="../alumnos/alumnos.php" title="Alumnos" target="cuerpo"><span><i class="fa-solid fa-user"></i></span>            <h2 class="letra">Alumnos</h2></a>
                <a class="opcion" href="../profesores/profesores.php" title="Profesores" target="cuerpo"><span><i class="fa-solid fa-chalkboard-user"></i></span> <h2 class="letra">Profesores</h2></a>
                <a class="opcion" href="../notas/notas.php" title="Notas" target="cuerpo"><span><i class="fa-solid fa-clipboard"></i></span>       <h2 class="letra">Notas</h2></a>
                <a class="opcion" href="../grados/grados.php" title="Grados" target="cuerpo"><span><i class="fa-solid fa-graduation-cap"></i></span>  <h2 class="letra">Grados</h2></a>
                <a class="opcion" href="../asistencia/asistencia.php" title="Asistencia" target="cuerpo"><span><i class="fa-solid fa-calendar-check"></i></span>  <h2 class="letra">Asistencia</h2></a>
            </div>
            <div class="usuario">
                <div class="datos">
                    <img class="usuario-desa" src="../img/usuario.png" alt="">
                    <label class="usuario-desa"><?php echo $datos?></label>
                </div>
                <a class="salir" href="cerrar_sesion.php" title="Cerrar Sesión"><span><i class="fa-solid fa-right-from-bracket"></i></span></a>
            </div>
        </div>
        <iframe name="cuerpo" src="" frameborder="0"></iframe>
    </div>
   <script src="../script.js"></script> 
</body>
</html>