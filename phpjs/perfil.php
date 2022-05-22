<?php
    session_start();
    $var=$_SESSION['username'];
    if($var==null || $var==''){
        header("Location:inicio_sesion.php");
        die();
    }
    include("conectar.php");
    $dni_cli = $var;  
	$sql_prod = "Select * from usuarios where dni_cliente =  $dni_cli";
	$result_prod = $db_connect -> query($sql_prod);

    if ($result_prod -> num_rows > 0) {
    	while ($fila = $result_prod -> fetch_assoc() )
    	{
    		$dni=$fila['dni_cliente'];
            $nom=$fila['nombres'];
            $tel=$fila['telefono'];
            $dir=$fila['correo'];
            $pass=$fila['password'];
    	}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="icon" href="../img/buho.png" type="image/png">
    <title>OwlPays|Mi perfil</title>
</head>
<body>
    <section class="container">
        <header class="head">
            <div class="logo">
                <img src="../img/buho.png" alt="buho">
                <label>OwlPays</label>
            </div>
        </header>
        <main class="container-perfil">
            <h1>Mi perfil</h1>
            <hr>
            <form class="datos" action="perfil.php" method="post">
                <div class="campos">
                    <div class="div-campo">
                        <label for="">DNI</label>
                        <input type="text" readonly="readonly" name="dni_cliente" value="<?php echo $dni;?>" class="campo"  maxlength="8"  minlength="8" onkeypress="valide(event)" required>
                    </div> 
                    <div class="div-campo">
                        <label for="">Nombres</label>
                        <input type="text" name="nombres"  class="campo" value="<?php echo $nom;?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required >
                    </div>    
                    <div class="div-campo">
                        <label for="">Teléfono</label>
                        <input type="text" name="telefono" class="campo" value="<?php echo $tel;?>" maxlength="9"  minlength="9" onkeypress="valide(event)" required>
                    </div>
                    <div class="div-campo">
                        <label for="">Correo</label>
                        <input type="mail" name="direccion" class="campo" value="<?php echo $dir;?>" required>
                    </div> 
                    <div class="div-campo">
                        <label for="">Contraseña</label>
                        <input type="password" id="password" name="contraseña" class="campo" value="<?php echo $pass;?>" id="password" required readonly><a onclick="habilitar()">Cambiar contraseña</a>
                    </div>  
                </div>
                <div class="div-password">
                    <input type="submit" class="submit" value="Guardar cambios">
                </div>
                <?php
                	include("conectar.php");
                	if(!empty($_POST['nombres'])=="")
                	{}
                	else
                	{
                		$dni_cli=$_POST['dni_cliente'];
                        $nomb=$_POST['nombres'];
                		$tele=$_POST['telefono'];
                		$direc=$_POST['direccion'];
                		$passw=$_POST['contraseña'];
                		$modi=("UPDATE usuarios set dni_cliente=$dni_cli, nombres='$nomb',telefono=$tele,correo='$direc',password='$passw' where dni_cliente=$dni");
                		$reg=$db_connect->query($modi);
                        echo "<meta http-equiv='refresh' content='0;URL=perfil.php'>"; 
                	}
                ?> 
            </form>
            <a href="main.php?id=<?php echo $dni_cli ?>" class="back">Regresar</a>
        </main>
    </section>  
    <script>
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        function habilitar() {
            $("#password").attr("readonly",false);
        }
    </script>
</body>
</html>