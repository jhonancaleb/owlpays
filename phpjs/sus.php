<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/sus.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripciones</title>
</head>
<body>
    <section class="container">
        <fieldset class="fiel">
            <legend>Suscripciones realizadas</legend>
            <?php
            error_reporting(0); 
            include "conectar.php"; 
            $code=$_GET['id'];
            $sql_prod ="SELECT s.plan,s.dni_cliente,s.id_prove,s.id_suscripcion,s.fecha_hora,s.total,p.nombre,p.id_proveedor FROM 
            suscripciones s, proveedores p WHERE s.id_prove = p.id_proveedor AND s.dni_cliente=$code";  
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
                echo '
                <table>
                    <th>Id suscripcion</th>
                    <th>Opciones</th>
                    <th>Proveedor</th>
                    <th>Plan</th>
                    <th>Fecha y hora</th>
                    <th>Total S/</th>
                
                ';
                while ( $rows = $result_prod -> fetch_assoc() ) {
                    $id_pro = $rows['id_proveedor'];
                    $id_sus = $rows['id_suscripcion'];
                    $prov = $rows['nombre'];
                    $plan = $rows['plan'];
                    $fecha = $rows['fecha_hora'];
                    $tot = $rows['total'];
                    echo '
                    <tr>
                       <td>'.$id_sus.'</td>
                       <td style="display:flex; gap:1.5em; justify-content:center;align-items:center">
                            <div class="img-opcion" style="width:3em;display:flex; gap:1.5em; justify-content:center;align-items:center">
                                <a href="anular.php?id='.$id_sus.'&user='.$code.'"><img src="../img/eliminar.png" width=30 height=30  title="Anular suscripción"></a>
                                <a href="modificar.php?id='.$id_sus.'&user='.$code.'"><img src="../img/cambiar.png" width=30 height=30 title="Cambiar plan de suscripción"></a>
                            </div>
                        </td>
                       <td>'.$prov.'</td>
                       <td>'.$plan.'</td>
                       <td>'.$fecha.'</td>
                       <td>'.$tot.'</td>
                    </tr>
                    ';
                    }
                 $sql_prod ="SELECT * FROM suscripciones WHERE dni_cliente=$code ";  
                 $result_prod = $db_connect -> query($sql_prod);
                 while ( $rows = $result_prod -> fetch_assoc() ) {
                    $total=$total+$rows['total'];
                 }   
                 echo '
                 </table>
                 <h2>TOTAL A PAGAR : S/'.$total.' </h2>
                 ';
                }
            else{
                echo'
                <h1>Por el momento no se ha suscrito a ningun servicio</h1>
                ';
            }
            ?>
             
        </fieldset>
    </section>
</body>
</html>