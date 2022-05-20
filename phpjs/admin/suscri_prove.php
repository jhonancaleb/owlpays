<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins',sans-serif;
            color:white;
        }
        table {
            display:table;
            overflow: hidden;
            position:relative;
            text-align: center;
            border:2px solid #8a1f3a;
            border-radius: 5px;
            width: 100%;
        }
        table th {
            background: #8a1f3a;
            padding: 5px;
            height: 3em;
        }
        table tr{
            transition: all 0.3s ;
            position: relative;
        }
        table tr:hover {
            background: #232e37;
        }
        table td {
            padding: 15px 5px !important;
        }
        table td.nombres {
           text-align: left;
        }
        .nohay{
            margin:20px;
        }
        .nohay img {
            width: 10em;
            height: 10em;     
        }
    </style>
</head>
<body>
    <table>
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
            $prove=$_GET['prove'];
            $sql_prod ="SELECT s.plan,s.dni_cliente,s.id_prove,s.id_suscripcion,s.fecha_hora,s.tarjeta,s.total,p.nombre,p.id_proveedor, u.nombres FROM 
            suscripciones s, proveedores p, usuarios u WHERE s.id_prove = p.id_proveedor and u.dni_cliente=s.dni_cliente and p.nombre='$prove'";  
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
                        <td colspan=8>
                            <div class="nohay">
                                <img src="../../img/vacio.png" alt="vacio">
                                <p>Aún no hay suscipciones a "'.$prove.'"</p>
                            </div>
                        </td>
                    </tr>
                ';
            }   
            
        ?>
    </table>  
</body>
</html>