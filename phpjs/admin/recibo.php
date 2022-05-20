<?php
    ob_start();
    $u=$_GET["u"];
    include 'conectar.php';
    $sql_prod ="SELECT * FROM usuarios WHERE dni_cliente=$u";  
    $result_prod = $db_connect -> query($sql_prod);
    if ($result_prod -> num_rows > 0) {
        while ( $rows = $result_prod -> fetch_assoc() ) {
           $nombres=$rows['nombres'];
           $correo=$rows['correo'];
           $telefono=$rows['telefono'];
        }
    }
    //fechas
    $hoy=date("d-m-Y");
    $mod_date = strtotime($hoy."+ 1 month");
    $fecha_fin=date("d-m-Y",$mod_date);
    $num_recibo=strtotime('now');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../../img/buho.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            padding: 50px;
        }
        hr{border-color:#bd2b07;}
        .logo{
            font-family:'Righteous',sans-serif;
            position: relative;
            margin:20px;
            color: #5a5656;
        }
        .logo img{
            width: 60px;
            height: 60px;
        }
        pre{
            font-family:monospace;
            font-weight: 600;
            line-height:1.5em;
        }
        .letra-red{
            color: #bd2b07;
            font-family:'arial',sans-serif;
            font-weight:bold;
        }
        .datos_factura{
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        table{
            margin:-5px auto 10px auto;
            border:1px solid #bd2b07;
            width: 90%;
            text-align:center;
        }
        table th{
            font-family:"arial";
            background: #bd2b07;
            border:1px solid #bd2b07;
            padding: 5px;
            color:white;
        }
        table tr{
            background: #F0EDED;
            font-family: "Helvetica Neue",Helvetica,Arial
        }
        table td{
            padding: 5px;
        }
        .table-datos{
            border:none;
            width: 20em;
            background: none;
            text-align:left;
        }
        .table-datos tr{
            background: none;
        }
        .datos-pago{
            position: relative;
            width: 10em;
            right: -33em;
            font-family: "Helvetica Neue",Helvetica;
            font-weight: bold;
            height: 2em;
            text-transform: uppercase;
        }
        .condiciones{
            margin:20px 0;
        }
        </style>
    <title>Recibo | <?php echo $nombres?></title>
</head>
<body>
    <div class="logo">
        <img src="../../img/buho.png" alt="" class="img"/> 
        <h1>OwlPays</h1>
    </div>
    <hr>
    <div class="datos_factura">
<pre>
    <span class="letra-red">A</span>
    <span><?php echo $nombres.' '.$u; ?></span>
    <span><?php echo $correo; ?></span>
    <span><?php echo $telefono; ?></span>
</pre>
<table class="table-datos">
    <tr>
        <td><span class="letra-red">Fecha</span></td>
        <td><?php echo $hoy;?></td>
    </tr>
    <tr>
        <td><span class="letra-red">N° recibo</span></td>
        <td><?php echo $num_recibo;?></td>
    </tr>                           
    <tr>
        <span class="letra-red">Fecha vencimiento</span></td>
        <td><?php echo $fecha_fin;?></td>
    </tr>                              
</table>
    </div>
    <table>
        <th>id</th>
        <th>Proveedor</th>
        <th>Plan</th>
        <th>Total</th>
        <?php
            include'conectar.php';
            $sql_prod ="SELECT s.id_suscripcion,s.dni_cliente,s.plan,s.total,p.nombre FROM 
            suscripciones s , proveedores p WHERE p.id_proveedor=s.id_prove AND dni_cliente=$u";  
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
                while ( $rows = $result_prod -> fetch_assoc() ) {
                   $id_sus=$rows['id_suscripcion'];
                   $dni_cliente=$rows['dni_cliente'];
                   $proveedor=$rows['nombre'];
                   $plan=$rows['plan'];
                   $total=$rows['total'];
                
                   echo'
                        <tr>
                           <td>'.$id_sus.'</td>
                           <td>'.$proveedor.'</td>
                           <td>'.$plan.'</td>
                           <td>'.$total.'</td>
                        </tr>
                    
                    ';
                }
            }
            else{
                echo'
                <tr>
                    <td colspan=4> No hay suscripciones</td>
                </tr>
                ';
            }
            
        ?> 
    </table>
    <div class="datos-pago">
        <?php
            $sql_prod ="SELECT * FROM suscripciones WHERE dni_cliente=$u ";  
            $result_prod = $db_connect -> query($sql_prod);
            if ($result_prod -> num_rows > 0) {
                $total = 0;
                while ( $rows = $result_prod -> fetch_assoc() ) {
                   $total=$total+$rows['total'];
                }   
                echo '            
                TOTAL: S/'.$total.'
                ';
            }
        ?>  
    </div>
    <hr>
    <pre class="condiciones">
        <span class="letra-red">Condiciones y forma de pago</span>
        El pago se realizará en el plazo de 15 días. 

        Banco de la Nación 
        IBA ES112 3445 45676
        SWPT/DC ABDESM1XXX
    </pre>
</body>
</html>
<?php
    $html=ob_get_clean();
    //echo $html;

    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    
    $dompdf=new Dompdf();

    $options=$dompdf->getOptions();
    $options->set(array('isRemoteEnabled'=>true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4');

    $dompdf->render();

    $dompdf->stream("recibo_.pdf",array("Attachment"=>false));  
?>

  