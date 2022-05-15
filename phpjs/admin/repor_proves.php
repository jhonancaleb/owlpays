<table border=1> 
    <caption>REPORTE DE PROVEEDORES</caption> 
    <th>id_proveedor</th>
    <th>nombre</th>
    <th>categoria</th>
    <th>plan1</th>
    <th>plan2</th> 
    <th>plan3</th> 
<?php   
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment;filename=reporte_proveedores.xls"); 
    include 'conectar.php';
    $sql_prod ="SELECT * FROM proveedores";  
    $result_prod = $db_connect -> query($sql_prod);
    if($result_prod -> num_rows > 0) {
        while ( $rows = $result_prod -> fetch_assoc()) {           
            echo'
            <tr>
                <td>'.$rows['id_proveedor'].'</td>
                <td>'.$rows['nombre'].'</td>
                <td>'.$rows['categoria'].'</td>
                <td>'.$rows['plan1'].'</td>
                <td>'.$rows['plan2'].'</td>
                <td>'.$rows['plan3'].'</td>
            </tr>      
            '; 
        }
    }
?>  
</table>
