<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    $user=$_SESSION['username'];
    include '../conectar.php';
    $id_sus=$_GET['id_sus'];
    $id_pro=$_GET['id_pro'];
    $sql_prod ="DELETE FROM suscripciones WHERE id_suscripcion=$id_sus";  
    if($result_prod = $db_connect -> query($sql_prod)){
        //enviar mensaje
        $sql_prod ="SELECT u.nombres,u.telefono, p.nombre,u.correo FROM usuarios u , proveedores p WHERE dni_cliente=$user and id_proveedor=$id_pro";  
        $result_prod = $db_connect -> query($sql_prod);
         while ( $rows = $result_prod -> fetch_assoc() ) {
               $number = $rows['telefono'];
               $name = $rows['nombres'];
               $name_prove= $rows['nombre'];
               $correo_destino= $rows['correo'];
               }          
        //envio a correo
        /* $asunto="SUSCRIPCIÓN A ".$name_prove.".";
        $destinatario=$correo_destino;
        $cuerpo='
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Correo</title>
            <style>
                @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
                *{
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                    font-family: "arial";
                }
                body{
                    width: 100%;
                    height: 100vh;
                    display:flex;
                    justify-content: center;
                    align-items: center;
                }
                .container-mensaje{
                    width: 30em;
                    height: 35em;
                    padding: 10px 40px;
                    border:3px solid rgb(230, 223, 223);
                }
                .container-mensaje .header{
                    width: 100%;
                    display: flex;
                    align-items: center;
                    gap:10px;
                    height: 4em;
                }
                .container-mensaje .header img{
                    width: 3em;height: 3em;
                }
                .container-mensaje .header label{
                    font-size: 30px;
                }
                .cuerpo{
                    margin:2em auto;
                    width: 98%;
                }
                .cuerpo span{
                    color:#0077ff;
                    font-weight: bold;
                }
                .cuerpo h1{
                    text-align: center;
                    font-family: "Poppins",sans-serif;
                    font-weight: 700;
                }
                .cuerpo .mensaje{
                    color:#5f5a5a;
                    margin: 10px auto;
                }
                .cuerpo .suscripcion{
                    width: 98%;
                }
                .cuerpo .suscripcion img{
                    width: 7em;
                    height: 7em; 
                    margin:1em 8.5em;}
                .cuerpo .datos table{
                    margin:1em auto;
                    width: 40%;
                }
                .cuerpo .datos table .th{
                    color:#0e417a;
                    font-size:15px;
                    font-weight: bold;
                    font-family: "Poppins",sans-serif;
                    width: 50%;
                    text-align: left;
                }
                .cuerpo .datos table td{
                    font-size:13px;
                    text-align: center;
                }
                .footer{
                    position: relative;
                    bottom: 0;
                    text-align: center;
                    font-size:12px;
                }
            </style>
        </head>
        <body>
            <div class="container-mensaje">
                <div class="header">
                <img src="https://img.icons8.com/cotton/344/owl--v2.png" alt="Buho.png" clas="img-logo">
                <label for="">OwlPays</label>
                </div>
                <hr>
                <div class="cuerpo">
                    <h1>Suscripción Cancelada</h1>
                    <p class="mensaje">Hola '.$name.'.Acabas de cancelar tu suscripción a <span>'.$name_prove.'</span>.</p>
                    <div class="suscripcion">
                    <img src="https://cdn-icons-png.flaticon.com/128/5268/5268671.png" alt="" class="img-service">
                        <div class="datos">
                            <table>
                                <tr>
                                    <td class="th">Plan</td>
                                    <td>'.$plan.'</td>
                                </tr>
                                <tr>
                                    <td class="th">Precio</td>
                                    <td>S/'.$precio.'</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="footer">
                    <hr>
                    <p>
                        Ha recibido esta notificación obligatoria del servicio de correo electrónico para mantenerle actualizado acerca de los cambios importantes en el producto o en la cuenta de OwlPays.</p>
                </div>
                    
            </div>      
        </body>
        </html>
        ';
        //cabeceras para el envio del correo en formato html
       $cabecera="MIME-Version: 1.0\r\n";
       $cabecera.="Content-type: text/html; charset=iso-8859-1\r\n";
       mail($destinatario,$asunto,$cuerpo,$cabecera);  */
       echo "<meta http-equiv='refresh' content='1;URL=suscripciones.php'>";
    }
    else{
        echo'Ocurrió un error';
    }
?>