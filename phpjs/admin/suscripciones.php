<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>suscripciones</title>
    <style>
        .content-proves .buscador ul li{
            cursor: pointer;
        }
        .content-proves .buscador ul li a{
            font-size:13px;
        }
        .content-proves table {
            font-size:15px;
        }
        .content-proves table td  {
            padding: 15px 5px !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="repor_sus.php" class="gen_reporte" title="Reporte excel"><i class="fa-solid fa-file-excel"></i>Generar reporte</a>
        <div class="content-proves">
            <div class="buscador">
                <ul>
                    <li onclick="search();"><a>TODOS</a></li>
                    <?php
                        include 'conectar.php';
                        $sql_prod ="SELECT * FROM proveedores";  
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
                    <input type="text" name="tx_cliente" id="tx_cliente" class="input" placeholder="Buscar por cliente" required>
                </form>
            </div>
            <div class="container-table">
                <table id="tabla">
                    <thead>
                        <th>Id</th>
                        <th>Dni Cliente</th>
                        <th>Cliente</th>
                        <th>Proveedor</th>
                        <th>Plan</th>
                        <th>N° Tarjeta</th>
                        <th>Fecha de suscripción</th>
                        <th>Fecha fin</th>
                        <th>Total</th>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(search());
        function search(consulta){
            $.ajax({
                type: "post",
                url: "sus_search.php",
                dataType: "html",
                data: {consulta:consulta},
                success: function (r) {
                    $("#tbody").html(r);
                }
            });
        }
        let campo=document.querySelector('#tx_cliente');
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