<?php
    include 'conectar.php';
    $salida="";
    $sql="SELECT * FROM proveedores";
    if(isset($_POST['consulta'])) {
        $valor=$_POST['consulta'];
        $sql="SELECT * FROM proveedores WHERE nombre like '%$valor%' OR categoria like '%$valor%'";     
    }
    $sql_res=$db_connect->query($sql);
    if($sql_res->num_rows > 0){
        while($row = $sql_res -> fetch_assoc() ){
            $id_proveedor=$row['id_proveedor'];
            $nombre=$row['nombre'];
            $categoria=$row['categoria'];
            $plan1=$row['plan1'];
            $plan2=$row['plan2'];
            $plan3=$row['plan3'];
            $image=$row['image'];          
            $salida.='
                <tr>
                    <td>'.$id_proveedor.'</td>
                    <td>'.$nombre.'</td>
                    <td>'.$categoria.'</td>
                    <td>'.$plan1.'</td>
                    <td>'.$plan2.'</td>
                    <td>'.$plan3.'</td>
                    <td><img src="image.php?id='.$id_proveedor.'" alt="'.$nombre.'"></td>
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