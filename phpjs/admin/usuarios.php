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
        <a href="repor_usu.php" class="gen_reporte"><i class="fa-solid fa-file-lines"></i>Generar reporte</a>
        <div class="content-formu">
            <form class="formu" action="usuarios.php" method="post" enctype="multipart/form-data">
                <h1>Agrega Usuarios</h1>
                <input type="text" name="tx_dni" id="" class="input" placeholder="DNI del usuario" maxlength="8" minlength="8" required>
                <input type="text" name="tx1" id="" class="input" placeholder="Nombres y Apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                <input type="email" name="tx2" id="" class="input" placeholder="Correo" required>
                <input type="text" name="tx3" id="" class="input" placeholder="Teléfono" maxlength="9"  minlength="8" required>
                <input type="text" name="tx4" id="" class="input" placeholder="Contraseña" required>
                <select name="tx_tipo" id="" class="input" placeholder="Categoria" required>
                    <option selected disabled>Seleccione tipo</option>    
                    <option value="1">ADMINISTRADOR</option>
                    <option value="2">USUARIO</option>
                </select>
                <?php
                    include 'conectar.php';
                    if(!empty($_POST['tx_dni'])=="")
                    {  }
                    else
                    {
                        $dni=$_POST["tx_dni"];
                        $nombre=$_POST["tx1"];
                        $correo=$_POST["tx2"];
                        $telefono=$_POST["tx3"];
                        $password=$_POST["tx4"];
                        $tipo=$_POST["tx_tipo"];
                        $sql_prod ="INSERT INTO usuarios(dni_cliente,nombres,correo,telefono,password,tipo) values('$dni','$nombre','$correo','$telefono','$password','$tipo')";  
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
                    <li onclick="search();"><a>LISTA DE USUARIOS</a></li>
                </ul>
                <form method="post">
                    <input type="text" name="tx_usu" id="tx_usu" class="input" placeholder="Escriba el usuario" required>
                </form>
            </div>
            <div class="container-table">
                <table id="tabla">
                    <thead>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                        <th>PASSWORD</th>
                        <th>TIPO</th>
                        <th>RECIBO</th>
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
                url: "usu_search.php",
                dataType: "html",
                data: {consulta:consulta},
                success: function (r) {
                    $("#tbody").html(r);
                }
            });
        }
        let campo=document.querySelector('#tx_usu');
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

