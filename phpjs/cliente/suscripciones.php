<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/buho2.png" type="image/ong">
    <link rel="stylesheet" href="../../css/suscripciones.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Owlpays|Suscripciones</title>
</head>
<body>
    <header class="head">
        <a href="area_client.php" class="logo" id="logo">
            <img src="../../img/buho2.png" alt="buho">
            <label for="logo">OwlPays</label>
        </a>
        <div class="usuario">
            <i class="fa-regular fa-circle-user"></i>           
        </div>  
        <ol class="menu">
            <a href="area_client.php"><li><i class="fa-light fa-house"></i>Inicio</li></a>
            <a href="perfil.php"><li><i class="fa-regular fa-circle-user"></i>Mi perfil</li></a>
            <a href="suscripciones.php"><li><i class="fa-regular fa-list-check"></i>Mis suscripciones</li></a>
            <a href=""><li><i class="fa-regular fa-bell"></i>Notificaciones</li></a>
            <a href="../cerrar_sesion.php"><li><i class="fa-regular fa-right-from-bracket"></i>Salir</li></a>
        </ol>        
    </header>
    <main class="cuerpo">
        <h3>Mis suscripciones</h3><hr>
        <div class="container-sus">
            <article class="suscripcion">
                <table>
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="servicio">
                                <img src="../../img/edeam.png" alt="">
                                <span>NETFLIX</span>    
                            </td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table>
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table >
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table >
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table >
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table >
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            <article class="suscripcion">
                <table >
                    <caption>Codigo de suscripción 00001</caption>
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Monto</th>
                            <th>Fecha de suscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NETFLIX</td>
                            <td>MENSUAL</td>
                            <td>S/ 34</td>
                            <td>12-09-2022</td>
                        </tr>
                    </tbody>
                </table>
            </article>
            
        </div>
        <div class="total">
            <i class="fa-light fa-money-bill"></i>
            TOTAL :<span> S/ 3000</span>
        </div>
    </main>
    <script>
        const btn_menu=document.querySelector('.usuario');
        let menu=document.querySelector('.menu');
        function show_menu() {
            menu.classList.toggle('active');
        }
        btn_menu.onclick=show_menu;
    </script>
</body>
</html>