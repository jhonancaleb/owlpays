<?php
    include '../conectar.php';
    $salida="";
    $sql="SELECT * from proveedores";
    if(isset($_POST['consulta'])){
        $q=$_POST['consulta']; 
        $sql="SELECT * from proveedores where nombre like '%".$q."%' or categoria like '%".$q."%'";
    }
    $sql_res=$db_connect->query($sql);
    if($sql_res -> num_rows > 0){
        while($row = $sql_res->fetch_assoc()){
            $nombre=$row['nombre'];
            $id=$row['id_proveedor'];
            $categoria=$row['categoria'];
            $plan1=$row['plan1'];
            $plan2=$row['plan2'];
            $plan3=$row['plan3'];
            $image=$row['image'];
            $salida.='
            <article class="proveedor">
                <img src="data:image/jpg;base64,'.base64_encode($image).'" alt="'.$nombre.'">
                <h3>'.$nombre.'</h3>
                <a href="planes.php?id='.$id.'" target="iframe" class="btn-sus" onclick="show_planes();">SUSCRIBIRSE</a>
            </article>
            ';
        }
    }
    else{
        $salida.='
        <div class="aviso">
            <img src="../../img/vacio.png" alt="vacio">
            <p>No hay proveedores que coincidan con <span>"'.$q.'"</span></p>
        </div>
        ';
    }

    echo $salida;
?>