<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins',sans-serif;
            color:white;
        }
        table {
            display:table;
            overflow: hidden;
            position:relative;
            text-align: center;
            border:2px solid #8a1f3a;
            border-radius: 5px;
            width: 100%;
        }
        table th {
            background: #8a1f3a;
            padding: 5px;
            height: 3em;
        }
        table tr{
            transition: all 0.3s ;
            position: relative;
        }
        table tr:hover {
            background: #232e37;
        }
        table td {
            padding: 5px 10px;
        }
        table td.nombres {
           text-align: left;
        }
        table td img {
            width: 3em;
            height: 3em;
        }
    </style>
</head>
<body>
    <table>
        <th>Id</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Plan Básico</th>
        <th>Plan Estándar</th>
        <th>Plan Premium</th>
        <th>Logo</th>
        <?php
            include 'conectar.php';
            $cat=$_GET['cat'];
            $sql_prod ="SELECT * FROM proveedores WHERE categoria='$cat'";  
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
                 
            
        ?>
    </table>  
</body>
</html>