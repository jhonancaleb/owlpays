<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/proves.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#>" method="POST" class="buscador">
        <div class="categoria">
             <select name="categorias" id="categorias" onchange="update()">
                <option value="" selected disabled>--Seleccione una categoría--</option>
                <option value="all">Todas las categorías</option>
                <option value="STREAMING">STREAMING</option>
                <option value="DISEÑO">DISEÑO</option>
                <option value="EDUCACION">EDUCACIÓN</option>
             </select>
        </div> <p>ó</p>
        <div class="buscar">
            <input type="text" name="tx_bus" id="" placeholder="Escriba el proveedor que busca">
        </div>
        <input type="submit" value="Buscar">
    </form>
    <section class="container">
        <?php
        include "conectar.php";
        $user=$_GET["id"];
        if(!empty($_POST['tx_bus'])=="")
        {  
        $sql_prod ="SELECT * FROM proveedores";  
        $result_prod = $db_connect -> query($sql_prod);
        if ($result_prod -> num_rows > 0) {
           while ( $rows = $result_prod -> fetch_assoc() ) {
               $code = $rows['id_proveedor'];
               $name = $rows['nombre'];
               $cate = $rows['categoria'];

               echo '
               <div class="proveedor">
                   <img src="image.php?id='. $code .'" width="110" height="110">
                   <h1>'.$name.'</h1>
                   <a href="sus_irse.php?id='.$code.'&user='.$user.'">SUSCRIBIRSE</a>
               </div>
               ';
               }}
        }
        else
        {
            error_reporting(0);
            $ser= $_POST['tx_bus'];
            $sql_prod ="SELECT * FROM proveedores WHERE nombre LIKE '%$ser%'"; 
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
               while ( $rows = $result_prod -> fetch_assoc() ) {
                   $code = $rows['id_proveedor'];
                   $name = $rows['nombre'];
                   $cate = $rows['categoria'];
                                   echo '
                   <div class="proveedor">
                       <img src="image.php?id='. $code .'" width="110" height="110">
                       <h1>'.$name.'</h1>
                       <a href="sus_irse.php?id='.$code.'&user='.$user.'">SUSCRIBIRSE</a>
                   </div>
                   ';
                   }}
        }
        ?>
    </section>
</body>
</html>