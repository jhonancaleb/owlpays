<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    $user=$_SESSION['username'];
    include '../conectar.php';
    //contar proveedores
    $sql = "SELECT sum(total) total FROM suscripciones where dni_cliente=$user";
    $result = mysqli_query($db_connect, $sql);
    $fila = mysqli_fetch_assoc($result);
    $total_pagar=$fila['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/buho2.png" type="image/ong">
    <link rel="stylesheet" href="../../css/suscripciones.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Owlpays|Suscripciones</title>
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
            <a href="area_client.php"><li><span><i class="fa-solid fa-house"></i></span>Inicio</li></a>
            <a href="perfil.php"><li><i class="fa-regular fa-circle-user"></i>Mi perfil</li></a>
            <a href="suscripciones.php"><li><i class="fa-solid fa-bell-concierge"></i>Mis suscripciones</li></a>
            <a href=""><li><i class="fa-regular fa-bell"></i>Notificaciones</li></a>
            <a href="../cerrar_sesion.php"><li><i class="fa-solid fa-right-from-bracket"></i>Salir</li></a>
        </ol>        
    </header>
    <main class="cuerpo">
        <h3>Mis suscripciones</h3><hr>
        <div class="container-sus">
        <?php 
            $sql_prod ="SELECT s.tarjeta,s.plan,s.dni_cliente,s.id_prove,s.id_suscripcion,s.fecha_fin,s.fecha_hora,s.total,p.nombre,p.id_proveedor,p.image FROM 
            suscripciones s, proveedores p WHERE s.id_prove = p.id_proveedor AND s.dni_cliente=$user ORDER BY s.id_suscripcion DESC";  
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
                while ( $rows = $result_prod -> fetch_assoc() ) {
                    $id_pro = $rows['id_proveedor'];
                    $id_sus = $rows['id_suscripcion'];
                    $prov = $rows['nombre'];
                    $plan = $rows['plan'];
                    $fecha = $rows['fecha_hora'];
                    $fecha_fin = $rows['fecha_fin'];
                    $tot = $rows['total'];
                    $tarjeta = $rows['tarjeta'];
                    $image = $rows['image'];
                    //convert fechas de string a  fecha
                    $date1 = new DateTime($fecha_fin);
                    $date2 = new DateTime("now");
                    $diff = $date1->diff($date2);
                    // this will output 4 days                           
                    $dias=$diff->days;
                    echo'
                        <article class="suscripcion table-responsive">
                            <div class="opciones">
                                <a href="eli_sus.php?id="'.$id_sus.'" style="--bg:#EE3F4F;" title="Anular suscripción"><i class="fa-solid fa-bell-slash"></i></a>
                                <a href="edi_sus.php?id="'.$id_sus.'" style="--bg:var(--bg-cyan);" title="Cambiar plan"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                            <table>
                                <caption>Codigo de suscripción '.$id_sus.'</caption>
                                <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Plan</th>
                                        <th>Fecha de suscripción</th>
                                        <th>Fecha fin</th>
                                        <th>Tarjeta</th>
                                        <th>Monto</th>
                                        <th>Días restantes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="servicio">
                                            <img src="data:image/jpg;base64,'.base64_encode($image).'" alt="'.$prov.'">
                                            <span>'.$prov.'</span>    
                                        </td>
                                        <td>'.$plan.'</td>
                                        <td>'.$fecha.'</td>
                                        <td>'.$fecha_fin.'</td>
                                        <td>'.$tarjeta.'</td>
                                        <td>S/ '.$tot.'</td>
                                        <td class="dias">'.$dias.'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </article>
                    ';
                }
            }
            else{
                echo'
                <div class="aviso">
                    <img src="../../img/vacio.png" alt="vacio">
                    <p>Al parecer aún no tiene suscripciones.</p>
                </div>
                ';
            }
        ?>            
        </div>
        <div class="total">
            <i class="fa-solid fa-money-bill"></i> TOTAL :<span> S/ <?php echo $total_pagar; ?></span>
        </div>
    </main>
    <script>
        const btn_menu=document.querySelector('.usuario');
        let menu=document.querySelector('.menu');
        function show_menu() {
            menu.classList.toggle('active');
        }
        btn_menu.onclick=show_menu;
    </script>
</body>
</html>