<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>suscripciones</title>
    <style>
        .content-proves .buscador ul li a{
            font-size:13px;
        }
        .content-proves table {
            font-size:15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="repor_sus.php" class="gen_reporte" title="Reporte excel"><i class="fa-solid fa-file-excel"></i>Generar reporte</a>
        <div class="content-proves">
            <div class="buscador">
                <ul>
                    <li><a href="suscripciones.php">TODOS</a></li>
                    <?php
                        include 'conectar.php';
                        $sql_prod ="SELECT * FROM proveedores";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $fila = $result_prod -> fetch_assoc() ) {
                                echo'
                                <li><a href="suscri_prove.php?prove='.$fila['nombre'].'" target="frame_cat" onclick="mostrar();">'.$fila['nombre'].'</a></li>
                                ';
                            }
                        }
                    ?>                   
                </ul>
                <form action="suscripciones.php" method="post">
                    <input type="text" name="tx_cliente" id="" class="input" placeholder="Buscar por cliente" required>
                    <input type="submit" value="Buscar" class="submit">
                </form>
            </div>
            <table id="tabla">
                <th>Id</th>
                <th>Dni Cliente</th>
                <th>Cliente</th>
                <th>Proveedor</th>
                <th>Plan</th>
                <th>N° Tarjeta</th>
                <th>Fecha de suscripción</th>
                <th>Total</th>
                <?php
                    include 'conectar.php';
                    if(!empty($_POST['tx_cliente'])=="")
                    {  
                        $sql_prod ="SELECT s.plan,s.dni_cliente,s.id_prove,s.id_suscripcion,s.fecha_hora,s.tarjeta,s.total,p.nombre,p.id_proveedor, u.nombres FROM 
                        suscripciones s, proveedores p, usuarios u WHERE s.id_prove = p.id_proveedor and u.dni_cliente=s.dni_cliente";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $fila = $result_prod -> fetch_assoc() ) {
                                $cod=$fila['id_suscripcion'];
                                $des=$fila['dni_cliente'];
                                $cli=$fila['nombres'];
                                $nom=$fila['nombre'];
                                $can=$fila['plan'];
                                $tar=$fila['tarjeta'];
                                $fec=$fila['fecha_hora'];
                                $tot=$fila['total'];
                                    echo"
                                    <tr>
                                        <td>".$cod."</td>
                                        <td>".$des."</td>
                                        <td>".$cli."</td>  
                                        <td>".$nom."</td> 
                                        <td>".$can."</td> 
                                        <td>".$tar."</td> 
                                        <td>".$fec."</td> 
                                        <td>".$tot."</td> 
                                    </tr>";
                            }
                        } 
                    }
                    else
                    {
                        $cliente=$_POST['tx_cliente'];
                        $sql_prod ="SELECT s.plan,s.dni_cliente,s.id_prove,s.id_suscripcion,s.fecha_hora,s.tarjeta,s.total,p.nombre,p.id_proveedor, u.nombres FROM 
                        suscripciones s, proveedores p, usuarios u WHERE s.id_prove = p.id_proveedor and u.dni_cliente=s.dni_cliente and u.nombres LIKE '%".$cliente."%'";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $fila = $result_prod -> fetch_assoc() ) {
                                $cod=$fila['id_suscripcion'];
                                $des=$fila['dni_cliente'];
                                $cli=$fila['nombres'];
                                $nom=$fila['nombre'];
                                $can=$fila['plan'];
                                $tar=$fila['tarjeta'];
                                $fec=$fila['fecha_hora'];
                                $tot=$fila['total'];
                                    echo"
                                    <tr>
                                        <td>".$cod."</td>
                                        <td>".$des."</td>
                                        <td>".$cli."</td>  
                                        <td>".$nom."</td> 
                                        <td>".$can."</td> 
                                        <td>".$tar."</td> 
                                        <td>".$fec."</td> 
                                        <td>".$tot."</td> 
                                    </tr>";
                            }
                        } 
                        else{
                            echo'
                                <tr>
                                    <td colspan=7>
                                        <div class="nohay">
                                            <img src="../../img/vacio.png" alt="vacio">
                                            <p>No hay suscipciones que coincidan con el cliente "'.$cliente.'"</p>
                                        </div>
                                    </td>
                                </tr>
                            ';
                        }
                    }   
                ?>
            </table>
            <iframe src="" frameborder="0" name="frame_cat" id="Iframe"></iframe>
        </div>
    </div>
    <script>
        let frame = document.getElementById("Iframe");
        let tabla = document.getElementById("tabla");
        function mostrar(){
            tabla.style.display = "none";
            frame.style.display = "block";
        }
        </script>
</body>
</html>