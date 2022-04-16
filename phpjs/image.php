<?php
if(!empty($_GET['id'])){
    include 'conectar.php';

    // Obteniendo datos de la imagen
    $result = $db_connect -> query("SELECT image FROM proveedores WHERE id_proveedor = {$_GET['id']}");
    
    if($result -> num_rows > 0){
        $imgData = $result -> fetch_assoc();
        
        // Renderizando la imagen
        header("Content-type: image/png"); 
        echo $imgData['image']; 
    }else{
        echo 'No disponible';
    }
}
?>