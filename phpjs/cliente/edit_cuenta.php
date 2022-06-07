<?php
    session_start();
    $user=$_SESSION['username'];
    include '../conectar.php';
    if(isset($_POST['correo'])){
        $correo=$_POST['correo']; 
        $telefono=$_POST['telefono']; 
        $sql="UPDATE usuarios set correo='$correo', telefono='$telefono' WHERE dni_cliente=$user";
        $sql_resu=$db_connect->query($sql);
        try{
            echo' <h5 class="avisito ok"><i class="fa-solid fa-check"></i> Información modificada con éxito</h5>';
        }
        catch(Exception $e){
            echo'<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i>Al parecer ocurrió un error</h5>';
        } 

    }
?>