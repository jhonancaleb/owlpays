<?php
    include 'conectar.php';
    $salida="";
    $sql="SELECT p.nombre ,s.id_suscripcion,s.id_prove,s.dni_cliente,s.plan,s.tarjeta,s.fecha_hora,s.fecha_fin,s.total,u.nombres
    FROM suscripciones s 
    INNER JOIN usuarios u ON u.dni_cliente = s.dni_cliente 
    INNER JOIN proveedores p ON s.id_prove = p.id_proveedor ";
    if(isset($_POST['consulta'])) {
        $valor=$_POST['consulta'];
        $sql="SELECT p.nombre ,s.id_suscripcion,s.id_prove,s.dni_cliente,s.plan,s.tarjeta,s.fecha_hora,s.fecha_fin,s.total,u.nombres
        FROM suscripciones s 
        INNER JOIN usuarios u ON u.dni_cliente = s.dni_cliente 
        INNER JOIN proveedores p ON s.id_prove = p.id_proveedor 
        WHERE u.nombres like '%$valor%' OR p.nombre like '%$valor%' ";     
    }
    $sql_res=$db_connect->query($sql);
    if($sql_res->num_rows > 0){
        while($row = $sql_res -> fetch_assoc() ){
            $id_suscripcion=$row['id_suscripcion'];
            $dni_cliente=$row['dni_cliente'];
            $nombres=$row['nombres'];
            $prove=$row['nombre'];
            $plan=$row['plan'];
            $tarjeta=$row['tarjeta'];
            $fecha_hora=$row['fecha_hora'];
            $fecha_fin=$row['fecha_fin'];
            $total=$row['total'];
            $salida.='
                <tr>
                    <td>'.$id_suscripcion.'</td>
                    <td>'.$dni_cliente.'</td>
                    <td>'.$nombres.'</td>
                    <td>'.$prove.'</td>
                    <td>'.$plan.'</td>
                    <td>'.$tarjeta.'</td>
                    <td>'.$fecha_hora.'</td>
                    <td>'.$fecha_fin.'</td>
                    <td>'.$total.'</td>                   
                </tr>
            ';
        }
    }
    else{
        $salida='
            <tr>
                <td colspan=9>
                    <div class="nohay">
                        <img src="../../img/vacio.png" alt="vacio">
                        <p>No hay registros que coincidan con "'.$valor.'"</p>
                    </div>
                </td>
            </tr>
        ';
    }
     echo $salida;
?>