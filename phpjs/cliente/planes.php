<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    $user=$_SESSION['username'];
    include '../conectar.php';
    //contar proveedores
    $id=$_GET['id'];
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
                <h1><?php echo $plan1;?></h1>
                <button id="plan1">Comprar</button>
            </article>
            <article>
                <p>QUINCENAL</p>
                <h1><?php echo $plan2;?></h1>
                <button id="plan2">Comprar</button>            
            </article>
            <article>
                <p>MENSUAL</p>
                <h1><?php echo $plan3;?></h1>
                <button id="plan3">Comprar</button>
            </article>
        </div>
    </div>
    <div class="container suscribirse">

    </div>
</body>
</html>