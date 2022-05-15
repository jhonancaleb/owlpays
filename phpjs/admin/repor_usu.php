<table border=1> 
    <caption>REPORTE DE USUARIOS</caption> 
    <th>dni_cliente</th>
    <th>nombres</th>
    <th>correo</th>
    <th>telefono</th>
    <th>password</th> 
    <th>tipo</th> 
<?php   
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment;filename=reporte_usuarios.xls"); 
    include 'conectar.php';
    $sql_prod ="SELECT * FROM usuarios";  
    $result_prod = $db_connect -> query($sql_prod);
    if($result_prod -> num_rows > 0) {
        while ( $rows = $result_prod -> fetch_assoc()) {           
            echo'
            <tr>
                <td>'.$rows['dni_cliente'].'</td>
                <td>'.$rows['nombres'].'</td>
                <td>'.$rows['correo'].'</td>
                <td>'.$rows['telefono'].'</td>
                <td>'.$rows['password'].'</td>
                <td>'.$rows['tipo'].'</td>
            </tr>      
            '; 
        }
    }
?>  
</table>