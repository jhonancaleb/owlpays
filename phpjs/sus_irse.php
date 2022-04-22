<!DOCTYPE html>
<html lang="en">
<head>
<!--     <script src="sli.js"></script>
 -->    <link rel="stylesheet" href="../css/sus_irse.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "conectar.php";
        $code=$_GET['id'];
        $sql_prod ="SELECT * FROM proveedores WHERE id_proveedor = '$code'";  
        $result_prod = $db_connect -> query($sql_prod);
        if ($result_prod -> num_rows > 0) {
           while ( $rows = $result_prod -> fetch_assoc() ) {
               $code = $rows['id_proveedor'];
               $name = $rows['nombre'];
               $cate = $rows['categoria'];
           }
        }
    ?>
    <form action="plan.php?id=<?php echo $code ?>" method="post" class="container">
        <div class="con-margin" id="con-margin"> 
            <div class="con-planes" id="con-planes">
                <div class="datos">
                    <img src="image.php?id=<?php echo $code ?>" alt="">
                    <h2><?php echo $name ?></h2>
                </div>
                <div class="planes">
                    <?php
                        include "conectar.php";
                        $code=$_GET['id'];
                        $user=$_GET['user'];
                        $sql_prod ="SELECT * FROM proveedores WHERE id_proveedor = '$code'";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if ($result_prod -> num_rows > 0) {
                           while ( $rows = $result_prod -> fetch_assoc() ) {
                               $code = $rows['id_proveedor'];
                               $name = $rows['nombre'];
                               $cate = $rows['categoria'];
                               $p1 = $rows['plan1'];
                               $p2 = $rows['plan2'];
                               $p3 = $rows['plan3'];
                           }
                           echo'
                           <div class="plan">
                                <h3>BÁSICO / SEMANAL</h3>
                                <h1>S/'.$p1.'</h1>
                                <a id="boton1" href="plan.php?user='.$user.'&id='.$code.'&plan=BÁSICO/SEMANAL&p='.$p1.'" target="datos_plan"  class="btn_comprar">Comprar</a>
                           </div>
                           <div class="plan">
                                <h3>ESTANDAR/ QUINCENAL</h3>
                                <h1>S/'.$p2.'</h1>
                                <a id="boton2" href="plan.php?user='.$user.'&id='.$code.'&plan=ESTÁNDAR/QUINCENAL&p='.$p2.'" target="datos_plan" class="btn_comprar">Comprar</a>
                           </div>
                           <div class="plan">
                                <h3>PREMIUM / MENSUAL</h3> 
                                <h1>S/'.$p3.'</h1>
                                <a id="boton3" href="plan.php?user='.$user.'&id='.$code.'&plan=PREMIUM/MENSUAL&p='.$p3.'" target="datos_plan" class="btn_comprar">Comprar</a>
                           </div>
                           ';
                        }
                    ?>

                </div>
                <a id="boto">Elija el plan de su agrado</a>
            </div>
            <div id="con-elegido" class="con-elegido" >
                <iframe frameBorder="0" name="datos_plan" scrolling="no"></iframe>
                <div id="volver" class="volver"><img src="../img/volver.png" width=40 height=40 alt="back"><h3>Regresar</h3></div>
            </div>
        </div> 
    </form>
</body>
<script type="text/javascript">
    let con=document.querySelector("#con-planes");
    let con2=document.querySelector("#con-elegido");
    const btn=document.querySelector("#boton1");
    const btn2=document.querySelector("#boton2");
    const btn3=document.querySelector("#boton3");
    const back=document.querySelector("#volver");
    function next(){
        setTimeout(function(){
        con.style.transition="none";
        con.style.visibility="hidden";
        con2.style.transition="all 0.5s";
        con2.style.marginLeft="-125.3em";
        },100);
    }
    function prev(){
        setTimeout(function(){
        con.style.transition="none";
        con.style.visibility="visible";
        con2.style.transition="all 0.5s";
        con2.style.marginLeft="0";
        },100);
    }
    btn.addEventListener("click",function(){
        next();
    });
    btn2.addEventListener("click",function(){
        next();
    });
    btn3.addEventListener("click",function(){
        next();
    });
    back.addEventListener("click",function(){
        prev();
    });
</script>
</html>