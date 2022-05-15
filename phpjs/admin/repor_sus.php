<table border=1> 
    <caption>REPORTE DE SUSCRIPCIONES</caption> 
    <th>id_suscripcion</th>
    <th>dni_cliente</th>
    <th>id_prove</th>
    <th>plan</th>
    <th>tarjeta</th> 
    <th>fecha_hora</th> 
    <th>fecha_fin</th> 
    <th>total</th> 
<?php   
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment;filename=reporte_suscripciones.xls"); 
    include 'conectar.php';
    $sql_prod ="SELECT * FROM suscripciones";  
    $result_prod = $db_connect -> query($sql_prod);
    if($result_prod -> num_rows > 0) {
        while ( $rows = $result_prod -> fetch_assoc()) {           
            echo'
            <tr>
                <td>'.$rows['id_suscripcion'].'</td>
                <td>'.$rows['dni_cliente'].'</td>
                <td>'.$rows['id_prove'].'</td>
                <td>'.$rows['plan'].'</td>
                <td>'.$rows['tarjeta'].'</td>
                <td>'.$rows['fecha_hora'].'</td>
                <td>'.$rows['fecha_fin'].'</td>
                <td>'.$rows['total'].'</td>
            </tr>      
            '; 
        }
    }
?>  
</table>