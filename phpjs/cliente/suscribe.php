<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    include '../conectar.php';                            
    $id=$_GET['id'];
    $user=$_SESSION['username'];
    $proveedor=$_POST['tx_servicio'];
    $plan=$_POST['tx_plan'];
    $precio=$_POST['tx_precio'];
    $tarjeta=$_POST['tx_tarjeta'];
    //fechas
    ini_set('date.timezone','America/Lima');
    $fecha=date('Y-m-d H:i:s');
    //FECHA_FINAL
    if($plan=='MENSUAL'){
        $mod_date = strtotime($fecha."+ 1 month");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    elseif($plan=='SEMANAL'){
        $mod_date = strtotime($fecha."+ 1 week");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    elseif($plan=='QUINCENAL'){
        $mod_date = strtotime($fecha."+ 15 days");
        $fecha_fin=date("Y-m-d H:i:s",$mod_date);
    }
    $insertar="INSERT INTO suscripciones(dni_cliente,id_prove,plan,tarjeta,fecha_hora,fecha_fin,total) 
    values('$user','$id','$plan','$tarjeta','$fecha','$fecha_fin','$precio')";
    if($result=$db_connect -> query($insertar)){
        echo'
        <h4 class="warning"><i class="fa-solid fa-check"></i> Suscripción relizada con exito.</h4>
        <script>
            document.querySelector("#aviso").classList.add("ok");
            setTimeout(function(){
                top.location.reload();
            },1500);
        </script>
        ';
    }
    else{
        echo'
        <h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Al parecer ocurrió un error.</h4>
        ';
    }   
    ob_end_flush();
?>