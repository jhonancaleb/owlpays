<?php
    session_start();
    $user=$_SESSION['username'];
    include '../conectar.php';
    $pa=$_POST['pa']; 
    $pn1=$_POST['pn1']; 
    $pn2=$_POST['pn2']; 
    $s="SELECT * FROM usuarios WHERE dni_cliente=$user";
    $s_resu=$db_connect->query($s);
    while ($row=$s_resu->fetch_assoc()){
        $password=$row['password'];
    }
    if($password==$pa){
        if($pn1==$pn2){
            $sql="UPDATE usuarios set password='$pn1' WHERE dni_cliente=$user";
            $sql_resu=$db_connect->query($sql);
            try{
                echo' <h5 class="avisito ok"><i class="fa-solid fa-check"></i> Contraseña modificada con éxito</h5>
                <script>
                    setTimeout(function(){
                        location.reload();
                    },1600); 
                </script>
                ';
                
            }
            catch(Exception $e){
                echo'<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Al parecer ocurrió un error</h5>';
            } 
        }
        else{
            echo'<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Debe confirmar correctamente su contraseña nueva.</h5>';
        }
    }
    else{
        echo'<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Contraseña actual errónea.</h5>';
    }
?>