<?php
    include 'conectar.php';
    $salida="";
    $sql="SELECT * FROM usuarios";
    if(isset($_POST['consulta'])) {
        $valor=$_POST['consulta'];
        $sql="SELECT * FROM usuarios WHERE nombres like '%$valor%' ";     
    }
    $sql_res=$db_connect->query($sql);
    if($sql_res->num_rows > 0){
        while($row = $sql_res -> fetch_assoc() ){
            $dni=$row['dni_cliente'];
            $nombres=$row['nombres'];
            $correo=$row['correo'];
            $telefono=$row['telefono'];
            $password=$row['password'];
            $tipo=$row['tipo'];
            if($tipo==1){
                $t="ADMINISTRADOR";
            }
            elseif($tipo==2){
                $t="USUARIO";               
            }
            $salida.='
                <tr>
                    <td>'.$dni.'</td>
                    <td>'.$nombres.'</td>
                    <td>'.$correo.'</td>
                    <td>'.$telefono.'</td>
                    <td>'.$password.'</td>
                    <td>'.$t.'</td>
                    <td><a href="recibo.php?u='.$dni.'"" target="_blank"><img src="../../img/recibo.png" alt="recibo" title="Generar recibo"></a></td>
                </tr>
            ';
        }
    }
    else{
        $salida='
            <tr>
                <td colspan=7>
                    <div class="nohay">
                        <img src="../../img/vacio.png" alt="vacio">
                        <p>No hay usuarios que coincidan con "'.$valor.'"</p>
                    </div>
                </td>
            </tr>
        ';
    }
     echo $salida;
?>