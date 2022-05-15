<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="repor_proves.php" class="gen_reporte">Generar reporte</a>
        <div class="content-formu">
            <form class="formu" action="proveedores.php" method="post" enctype="multipart/form-data">
                <h1>Agrega proveedores</h1>
                <input type="text" name="tx_nombre" id="" class="input" placeholder="Nombre del proveedor" required>
                <select name="tx_categoria" id="" class="input" placeholder="Categoria" required>
                    <option value="STREAMING">STREAMING</option>
                    <option value="EDUCACION">EDUCACION</option>
                    <option value="DISEÑO">DISEÑO</option>
                    <option value="NUBE">NUBE</option>
                </select>
                <input type="text" name="tx_plan1" id="" class="input" placeholder="Plan1" required>
                <input type="text" name="tx_plan2" id="" class="input" placeholder="Plan2" required>
                <input type="text" name="tx_plan3" id="" class="input" placeholder="Plan3" required>
                <div class="file-img">
                    <input type="file" name="img" id="file" required>
                    <label for="file"><i class="fa-solid fa-upload"></i> Subir imagen</label>
                </div>
                <?php
                    include 'conectar.php';
                    if(!empty($_POST['tx_nombre'])=="")
                    {  }
                    else
                    {
                        $nombre=$_POST["tx_nombre"];
                        $categoria=$_POST["tx_categoria"];
                        $plan1=$_POST["tx_plan1"];
                        $plan2=$_POST["tx_plan2"];
                        $plan3=$_POST["tx_plan3"];
                        /* imagen */
                        $tamanoimg=$_FILES["img"]["size"];
                        $imagen=fopen($_FILES["img"]["tmp_name"], "r");
                        $imagen_bin=fread($imagen,$tamanoimg);
                        $imagen_bin=mysqli_escape_string($db_connect,$imagen_bin);
                        $sql_prod ="INSERT INTO proveedores(nombre,categoria,plan1,plan2,plan3,image) values('$nombre','$categoria','$plan1','$plan2','$plan3','$imagen_bin')";  
                        $result_prod = $db_connect -> query($sql_prod);
                    }       
                ?>
                <input type="submit" class="submit" value="Agregar">
            </form>
            <div class="img">
                <img src="../../img/undraw1.svg" alt="">
            </div>
        </div>
        <div class="content-proves">
            <div class="buscador">
                <ul>
                    <li><a href="proveedores.php">TODOS</a></li>
                    <li><a href="prove_cat.php?cat=STREAMING" target="frame_cat" onclick="mostrar();">STREAMING</a></li>
                    <li><a href="prove_cat.php?cat=DISEÑO" target="frame_cat" onclick="mostrar();">DISEÑO</a></li>
                    <li><a href="prove_cat.php?cat=EDUCACIÓN" target="frame_cat" onclick="mostrar();">EDUCACION</a></li>
                    <li><a href="prove_cat.php?cat=NUBE" target="frame_cat" onclick="mostrar();">NUBE</a></li>
                </ul>
                <form action="proveedores.php" method="post">
                    <input type="text" name="tx_prove" id="" class="input" placeholder="Escriba el proveedor" required>
                    <input type="submit" value="Buscar" class="submit">
                </form>
            </div>
            <table id="tabla">
                <th>Id</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Plan1</th>
                <th>Plan2</th>
                <th>Plan3</th>
                <th>Logo</th>
                <?php
                    include 'conectar.php';
                    if(!empty($_POST['tx_prove'])=="")
                    {  
                        $sql_prod ="SELECT * FROM proveedores";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $rows = $result_prod -> fetch_assoc() ) {
                                $code = $rows['id_proveedor'];
                                $name = $rows['nombre'];
                                $cate = $rows['categoria'];
                                $plan1 = $rows['plan1'];
                                $plan2 = $rows['plan2'];
                                $plan3 = $rows['plan3'];
                                $imagen = $rows['image'];
                                echo'
                                 <tr>
                                     <td>'.$code.'</td>
                                     <td class="nombres">'.$name.'</td>
                                     <td>'.$cate.'</td>
                                     <td>'.$plan1.'</td>
                                     <td>'.$plan2.'</td>
                                     <td>'.$plan3.'</td>
                                     <td><img src="data:image/jpg;base64,'.base64_encode($imagen).'" alt="'.$name.'"></td>
                                 </tr>
                                ';
                           }
                        } 
                    }
                    else
                    {
                        $prove=$_POST['tx_prove'];
                        $sql_prod ="SELECT * FROM proveedores WHERE nombre LIKE '%".$prove."%'";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $rows = $result_prod -> fetch_assoc() ) {
                                $code = $rows['id_proveedor'];
                                $name = $rows['nombre'];
                                $cate = $rows['categoria'];
                                $plan1 = $rows['plan1'];
                                $plan2 = $rows['plan2'];
                                $plan3 = $rows['plan3'];
                                $imagen = $rows['image'];
                                echo'
                                 <tr>
                                     <td>'.$code.'</td>
                                     <td class="nombres">'.$name.'</td>
                                     <td>'.$cate.'</td>
                                     <td>'.$plan1.'</td>
                                     <td>'.$plan2.'</td>
                                     <td>'.$plan3.'</td>
                                     <td><img src="data:image/jpg;base64,'.base64_encode($imagen).'" alt="'.$name.'"></td>
                                 </tr>
                                ';
                           }
                        } 
                        else{
                            echo'
                                <tr>
                                    <td colspan=7>
                                        <div class="nohay">
                                            <img src="https://cdn-icons.flaticon.com/png/512/5445/premium/5445197.png?token=exp=1652628568~hmac=398ae2dbccfc5802d8f4e477d25f32f7" alt="vacio">
                                            <p>No hay proveedores que coincidan con "'.$prove.'"</p>
                                        </div>
                                    </td>
                                </tr>
                            ';
                        }
                    }   
                ?>
            </table>
            <iframe src="" frameborder="0" name="frame_cat" id="Iframe"></iframe>
        </div>
    </div>
    <script>
        // Selecting the iframe element
        let frame = document.getElementById("Iframe");
          
        /* // Adjusting the iframe height onload event
        frame.onload = function()
        // function execute while load the iframe
        {
          // set the height of the iframe as 
          // the height of the iframe content
          frame.style.height = 
          frame.contentWindow.document.body.scrollHeight + 'px';
           
  
         // set the width of the iframe as the 
         // width of the iframe content
         frame.style.width  = 
         frame.contentWindow.document.body.scrollWidth+'px';
              
        }  */
        let tabla = document.getElementById("tabla");
        function mostrar(){
            tabla.style.display = "none";
            frame.style.display = "block";
        }
        </script>
</body>
</html>