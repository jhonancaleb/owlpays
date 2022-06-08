<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    include '../conectar.php';
    //contar proveedores
    $sql = "SELECT COUNT(*) total FROM proveedores";
    $result = mysqli_query($db_connect, $sql);
    $fila = mysqli_fetch_assoc($result);
    $tot_prove=$fila['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/buho2.png" type="image/ong">
    <link rel="stylesheet" href="../../css/area_client.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>OwlPays|Área del Cliente</title>
</head>
<body>
    <header class="head">
        <a href="area_client.php" class="logo" id="logo">
            <img src="../../img/buho2.png" alt="buho">
            <label for="logo">OwlPays</label>
        </a>
        <div class="usuario">
            <i class="fa-regular fa-circle-user"></i>           
        </div>
        <ol class="menu">
            <a href="area_client.php"><li><i class="fa-solid fa-house"></i>Inicio</li></a>
            <a href="perfil.php"><li><i class="fa-regular fa-circle-user"></i>Mi perfil</li></a>
            <a href="suscripciones.php"><li><i class="fa-solid fa-bell-concierge"></i>Mis suscripciones</li></a>
            <a href=""><li><i class="fa-regular fa-bell"></i>Notificaciones</li></a>
            <a href="../cerrar_sesion.php"><li><i class="fa-solid fa-right-from-bracket"></i>Salir</li></a>
        </ol>          
    </header>
    <main class="cuerpo">
        <div class="buscador">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input class="campo"  type="text" id="tx_proveedor" placeholder="Encuentra el servicio que buscas. Más de <?php echo $tot_prove;?> p...">
            <i class="x fa-regular fa-circle-xmark" id="btn-clear"></i>
        </div>
        <ul class="categorias">
            <li onclick="search()"style="--text:'TODOS'"><i class="fa-solid fa-border-all"></i></li>
        <?php
            $sql="SELECT * FROM categorias";
            $sql_proc=$db_connect->query($sql);
            while ($row=$sql_proc->fetch_assoc()) {
                switch($row['nombre']){
                    case 'NUBE':
                        $ico='<i class="fa-solid fa-cloud-arrow-down"></i>';
                        break;
                    case 'DISEÑO':
                        $ico='<i class="fa-solid fa-object-group"></i>';
                        break;
                    case 'EDUCACION':
                        $ico='<i class="fa-solid fa-chalkboard"></i>';
                        break;
                    case 'STREAMING':
                        $ico='<i class="fa-solid fa-tv"></i>';
                        break;
                }
                ?>
                    <li onclick="search('<?php echo $row['nombre'];?>')"style="--text:'<?php echo $row['nombre'];?>'"><?php echo $ico;?></li>
                <?php
            }
                ?>
            
        </ul>
        <div class="container-proveedores" id="proveedores">
        </div>
    </main>
    <section class="fondo">
        <div class="container-iframe">
            <iframe src="" frameborder="0" name="iframe" id="planes"></iframe>
            <div class="cerrar"><i class="fa-solid fa-xmark"></i></div>
        </div>
    </section>
    <script>
        const btn_menu=document.querySelector('.usuario');
        let menu=document.querySelector('.menu');
        function show_menu() {
            menu.classList.toggle('active');
        }
        btn_menu.onclick=show_menu;
        //limpiar buscador
        const btn_clear=document.querySelector('.x')
        function clear_search() {
            document.querySelector('.campo').value="";
            search();
        } 
        btn_clear.onclick=clear_search;
        //ajax proveedores 
        $(search());
        function search(consulta) {
            $.ajax({
                type: "POST",
                url: "proveedores.php",
                dataType: "html",
                data: {consulta: consulta},
                success: function (r) {
                    $("#proveedores").html(r);
                    
                }
            });
        }

        $(document).on('keyup', '#tx_proveedor', function(){
            var valor=$(this).val();
            if (valor ==""){
                search();
            }
            else{
                search(valor);
            }
        })

        //aparecer fondo planes 
        let planes=document.querySelector('.fondo');
        let cerrar=document.querySelector('.cerrar');
        function show_planes(){
            planes.classList.toggle('active');
        }
        cerrar.onclick=show_planes;
    </script>
</body>
</html>