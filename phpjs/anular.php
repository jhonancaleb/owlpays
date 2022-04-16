<?php 
    include "conectar.php";
    $id_sus=$_GET['id'];
    $user=$_GET['user'];
    $sql_prod ="DELETE FROM suscripciones WHERE id_suscripcion=$id_sus";  
    $result_prod = $db_connect -> query($sql_prod);
    echo "<meta http-equiv='refresh' content='0;URL=sus.php?id=".$user."' target='_top'>";
?>