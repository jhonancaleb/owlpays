<?php
    session_start();
    $user=$_SESSION['username'];
    if($user==null || $user==''){
        header("Location:../index.php");
        die();
    }
    include "conexion.php";
    $db=new database();
    $query=$db->connect()->prepare('SELECT dni_cliente AS username,nombres AS name FROM usuarios WHERE dni_cliente=:username');
    $query->execute([':username' => $user]);
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $idd=$row['username'];
    $nombres=$row['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../../img/buho.png" type="image/png">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script><!-- //mi kit en font awesome -->
    <link rel="stylesheet" href="../../css/menu.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owlpays Admin</title>
</head>
<body>
    <div class="body">
        <div class="menu-barra" id="menu-barra">
            <div class="con-bar">
                <div class="bar" id="btn" title="Menú"><i class="fa-solid fa-bars" id="icon_bar"></i></div>
            </div>
            
            <a href="admin_page.php" class="logo" id="logo">
                <img src="../../img/buho.png" alt="">
                <label id="ie">Owlpays Admin</label>
            </a>
            <div class="opciones">
                <a class="opcion" href="" title="Usuarios" target="cuerpo"><span><i class="fa-solid fa-user-group"></i></span>            <h2 class="letra">Usuarios</h2></a>
                <a class="opcion" href="suscripciones.php" title="Suscripciones" target="cuerpo"><span><i class="fa-solid fa-clipboard"></i></span> <h2 class="letra">Suscripciones</h2></a>
                <a class="opcion" href="proveedores.php" title="Proveedores" target="cuerpo"><span><i class="fa-brands fa-servicestack"></i></span>       <h2 class="letra">Proveedores</h2></a>
                <!-- <a class="opcion" href="../grados/grados.php" title="Grados" target="cuerpo"><span><i class="fa-solid fa-graduation-cap"></i></span>  <h2 class="letra"></h2></a>
                <a class="opcion" href="../asistencia/asistencia.php" title="Asistencia" target="cuerpo"><span><i class="fa-solid fa-calendar-check"></i></span>  <h2 class="letra">Asistencia</h2></a> -->
            </div>
            <div class="usuario">
                <div class="datos">
                    <img class="usuario-desa" src="../../img/usuario.png" alt="">
                    <label class="usuario-desa"><?php echo $nombres?></label>
                </div>
                <a class="salir" href="../cerrar_sesion.php" title="Cerrar Sesión"><span><i class="fa-solid fa-right-from-bracket"></i></span></a>
            </div>
        </div>
        <iframe name="cuerpo" src="admin_vista.php" frameborder="0"></iframe>
    </div>
   <script>
       /* window,alert("hola") */
        const boton=document.querySelector("#btn");
        let menu=document.querySelector("#menu-barra");
        let logo=document.querySelector("#logo");
        let iconbar=document.querySelector("#icon_bar");
        let letra_insti=document.querySelector("#ie");
        let opcion=document.querySelectorAll(".letra");
        let usuario=document.querySelectorAll(".datos")[0];
        let salir=document.querySelectorAll(".salir")[0];
        function barra(){
            /* window,alert("hola"); */
            boton.classList.toggle("desactive");
            iconbar.classList.toggle("desactive");
            menu.classList.toggle("oculto");
            letra_insti.classList.toggle("desactive");
            usuario.classList.toggle("oculto");
            salir.classList.toggle("solo");
            opcion.forEach((item)=> 
            item.classList.toggle("oculto")); 
        }
        boton.onclick = barra; //en proceso
   </script> 
</body>
</html>