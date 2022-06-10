<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    $user=$_SESSION['username'];
    include '../conectar.php';
    //datos del porvedor
    $id=$_GET['id_pro'];
    $sql = "SELECT * FROM proveedores where id_proveedor=$id";
    $result = $db_connect->query($sql);
    while ($row = $result->fetch_assoc()){
        $nombre=$row['nombre'];
        $categoria=$row['categoria'];
        $plan1=$row['plan1'];
        $plan2=$row['plan2'];
        $plan3=$row['plan3'];
        $image=$row['image'];
    }
    //datos de la suscripcion
    $id_sus=$_GET['id_sus'];
    $sql = "SELECT * FROM suscripciones where id_suscripcion=$id_sus";
    $result = $db_connect->query($sql);
    while ($row = $result->fetch_assoc()){
        $tarjeta=$row['tarjeta'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/planes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container elegir">
        <div class="proveedor">
            <img src="data:image/jpg;base64,<?php echo base64_encode($image);?>" alt="<?php echo $nombre;?>">
            <h3><?php echo $nombre;?></h3>
        </div>
        <div class="planes">
            <article>
                <p>SEMANAL</p>
                <h1>S/ <?php echo $plan1;?></h1>
                <button id="plan1">Comprar</button>
            </article>
            <article>
                <p>QUINCENAL</p>
                <h1>S/ <?php echo $plan2;?></h1>
                <button id="plan2">Comprar</button>            
            </article>
            <article>
                <p>MENSUAL</p>
                <h1>S/ <?php echo $plan3;?></h1>
                <button id="plan3">Comprar</button>
            </article>
        </div>
    </div>
    <div class="container suscribirse">
        <div class="volver">
            <i class="fa-solid fa-angles-left"></i> Volver a planes
        </div>
        <form method="post" id="form-plan-ele">
            <h3>Nuevo plan elegido</h3>
            <div class="campos">
                <fieldset class="servicio">
                        <legend>Servicio</legend>
                        <input type="text" class="campo" name="tx_servicio" id="tx_servicio" readonly>
                </fieldset>
                <fieldset class="plan">
                        <legend>Plan</legend>
                        <input type="text" class="campo" name="tx_plan" id="tx_plan" readonly>
                </fieldset>
                <fieldset class="precio">
                        <legend>Precio S/</legend>
                        <input type="text" class="campo" name="tx_precio" id="tx_precio" readonly>
                </fieldset>
                <fieldset class="tarjeta">
                        <legend>Tarjeta crédito/débito</legend>
                        <input type="text" class="campo" value="<?php echo $tarjeta;?>" readonly name="tx_tarjeta" id="tx_tarjeta" onkeypress="valide(event);" maxlength="16" minlength="16" placeholder="Escriba el número de su tarjeta">
                </fieldset>
                <div id="aviso"></div>
                <input type="submit" value="Confirmar" id="btn-sus" class="submit">
            </div>
        </form>
    </div>
    <script>
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        //slider
        let container1=document.querySelector('.elegir');
        let container2=document.querySelector('.suscribirse');
        const volver=document.querySelector('.volver');
        function slider(){
            container1.classList.toggle('active');
            container2.classList.toggle('active');
        }
        volver.onclick=slider;
        //llenar datos al elegir plan
        const btn_plan1=document.querySelector('#plan1');
        const btn_plan2=document.querySelector('#plan2');
        const btn_plan3=document.querySelector('#plan3');
        //campos
        var campo_servicio=document.querySelector('#tx_servicio');
        var campo_plan=document.querySelector('#tx_plan');
        var campo_precio=document.querySelector('#tx_precio');
        //var campo_tarjeta=document.querySelector('#tx_tarjeta');
        function plan1(){
            campo_plan.value='SEMANAL';  
            campo_precio.value='<?php echo $plan1;?>';  
            campo_servicio.value=' <?php echo $nombre;?>';  
            slider();
        }
        btn_plan1.onclick=plan1;
        function plan2(){
            campo_plan.value='QUINCENAL';  
            campo_precio.value='<?php echo $plan2;?>';  
            campo_servicio.value=' <?php echo $nombre;?>';   
            slider();
        }
        btn_plan2.onclick=plan2;
        function plan3(){
            campo_plan.value='MENSUAL';  
            campo_precio.value='<?php echo $plan3;?>';  
            campo_servicio.value=' <?php echo $nombre;?>';  
            slider();
        }
        btn_plan3.onclick=plan3;

        //funcion ajax de registrar suscripcion
        $('#btn-sus').click(function(){
            if($("#tx_tarjeta").val().length == 0){
                $("#aviso").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Por favor. Escriba su número de tarjeta.</h4>')
            }
            else{
                var datos=$('#form-plan-ele').serialize();
                $.ajax({
                    type: "POST",
                    url: "edi_sus_php.php?id_sus=<?php echo $id_sus;?>&id_prove=<?php echo $id;?>",
                    data: datos,

                    success: function (r) {
                        $("#aviso").html(r);                      
                    }
                });
            }
            return false;
        })
    </script>
</body>
</html>