<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="repor_proves.php" class="gen_reporte" title="Reporte excel"><i class="fa-solid fa-file-excel"></i>Generar reporte</a>
        <div class="content-formu">
            <form class="formu" action="proveedores.php" method="post" enctype="multipart/form-data">
                <h1>Agrega proveedores</h1>
                <input type="text" name="tx_nombre" id="" class="input" placeholder="Nombre del proveedor" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                <select name="tx_categoria" id="" class="input" placeholder="Categoria" required>
                    <option value="" selected disabled>Seleccione una categoría</option>    
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
                    <li onclick="search();">TODOS</li>
                    <?php
                        include 'conectar.php';
                        $sql_prod ="SELECT * FROM categorias";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $fila = $result_prod -> fetch_assoc() ) {
                                ?>
                                    <li onclick="search('<?php echo $fila['nombre']; ?>');"><a><?php echo $fila['nombre']; ?></a></li>                         
                                <?php
                            }
                        }
                    ?>
                </ul>
                <form method="post">
                    <input type="text" name="tx_prove" id="tx_prove" class="input" placeholder="Escriba el proveedor" required>
                </form>
            </div>
            <div class="container-table">
                <table id="tabla">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Plan Básico</th>
                        <th>Plan Estándar</th>
                        <th>Plan Premium</th>
                        <th>Logo</th>
                    </thead>
                    <tbody id="tbody"></tbody>              
                </table>
            </div>           
        </div>
    </div>
    <script>
        $(search());
        function search(consulta){
            $.ajax({
                type: "post",
                url: "prove_search.php",
                dataType: "html",
                data: {consulta:consulta},
                success: function (r) {
                    $("#tbody").html(r);
                }
            });
        }
        let campo=document.querySelector('#tx_prove');
        campo.onkeyup=function() {
            var valor=campo.value;
            if (valor ==""){
                search();
            }
            else{
                search(valor);
            }
        };
    </script>
</body>
</html>