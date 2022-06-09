<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:../../login.php');
    }
    $user=$_SESSION['username'];
    include '../conectar.php';
    //contar proveedores
    $sql = "SELECT * FROM usuarios where dni_cliente=$user";
    $result = $db_connect->query($sql);
    while ($row = $result->fetch_assoc()){
        $nombres=$row['nombres'];
        $correo=$row['correo'];
        $telefono=$row['telefono'];
        $password=$row['password'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/buho2.png" type="image/ong">
    <link rel="stylesheet" href="../../css/perfil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>OwlPays|Mi Perfil</title>
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
            <a href="area_client.php"><li><i class="fa-solid fa-house"></i>Inicio</li></a>
            <a href="perfil.php"><li><i class="fa-regular fa-circle-user"></i>Mi perfil</li></a>
            <a href="suscripciones.php"><li><i class="fa-solid fa-bell-concierge"></i>Mis suscripciones</li></a>
            <a href=""><li><i class="fa-regular fa-bell"></i>Notificaciones</li></a>
            <a href="../cerrar_sesion.php"><li><i class="fa-solid fa-right-from-bracket"></i>Salir</li></a>
        </ol>          
    </header>
    <main class="cuerpo">
        <h3>Mi Perfil</h3><hr>
        <div class="password" id="btn-password">
            <div class="icono"><i class="fa-solid fa-key"></i></div>
            <a>Cambiar contraseña de seguridad</a>
        </div>
        <section class="cuadro perfil">
            <ul>
                <li class="title dark">Información de perfil</li>
                <li><p>Nombres completos</p><span class="dark"><?php echo $nombres; ?></span></li>
                <li><p>DNI(Nombre de usuario)</p><span class="dark"><?php echo $user; ?></span></li>
            </ul>
            <a class="link" id="show-edit-perfil">Editar información de perfil</a>
        </section>
        <section class="cuadro cuenta">
            <ul>
                <li class="title dark">Información de la cuenta</li>
                <li><p>Dirección de correo electrónico</p><span class="dark"><?php echo $correo; ?></span></li>
                <li><p>Número de celular </p><span class="dark"><?php echo $telefono; ?></span></li>
            </ul>
            <a class="link" id="show-edit-cuenta">Editar información de la cuenta</a>
        </section>
    </main>
    <section id="fondo">
        <form id="perfil" method="post">
            <h4>Editar información de perfil</h4>
            <div class="content">
                <label for="" class="dark">DNI(Usuario)</label>
                <input type="text" class="campo" value="<?php echo $user; ?>" onkeypress="valide(event)" maxlength="8" minlength="8" readonly>
            </div>
            <div class="content">
                <label for="" class="dark">Nombres y Apellidos</label>
                <input type="text" class="campo" id="tx_nombres" value="<?php echo $nombres; ?>" placeholder="Escriba nombres y apellidos completos">
                <div id="avisito-perfil"></div>
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-perfil-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" type="submit" id="btn-guardar-perfil" class="button" value="Guardar">
        </form>
        <form id="cuenta">
            <h4>Editar información de cuenta</h4>
            <div class="content">
                <label for="" class="dark">Correo electrónico</label>
                <input type="email" class="campo" id="tx_correo" value="<?php echo $correo; ?>" placeholder="Escriba su dirección de correo electrónico">
            </div>
            <div class="content">
                <label for="" class="dark">Número de teléfono</label>
                <input type="text" class="campo" id="tx_telefono" value="<?php echo $telefono; ?>" onkeypress="valide(event)" maxlength="9" minlength="9" placeholder="Escriba su número telefónico">
                <div id="avisito-cuenta"></div>
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-cuenta-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" id="btn-guardar-cuenta" type="submit" class="button" value="Guardar">
        </form>
        <form id="password">
            <h4>Cambiar clave de seguridad</h4>
            <div class="content">
                <label for="" class="dark">Contraseña actual</label>
                <input type="password" class="campo" id="tx_password" placeholder="Queremos saber si es usted">
            </div>
            <div class="content">
                <label for="" class="dark">Nueva contraseña</label>
                <input type="password" class="campo" id="tx_new_password1" placeholder="Cree su nueva clave de seguridad">
            </div>
            <div class="content">
                <label for="" class="dark">Confirme su nueva contraseña</label>
                <input type="password" class="campo" id="tx_new_password2" placeholder="Escriba de nuevo su clave de seguridad">
                <div id="avisito-password"></div>
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-password-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" id="btn-guardar-password" type="submit" class="button" value="Guardar">
        </form>
    </section>
    <script>
        //funcion que valida solo entrada de numeros
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        //mostrar menu
        const btn_menu=document.querySelector('.usuario');
        let menu=document.querySelector('.menu');
        function show_menu() {
            menu.classList.toggle('active');
        }
        function reload() {
            location.reload();
        }
        btn_menu.onclick=show_menu;
        //funcion show form de editar datos
        const btn_edit_cuenta=document.querySelector('#show-edit-cuenta');
        let fondo=document.querySelector('#fondo');
        let formu_cuenta=document.querySelector('#cuenta');
        const btn_hide_cuenta=document.querySelector('#btn-cuenta-hide')
        function edit_cuenta(){
            fondo.classList.toggle("active");
            formu_cuenta.classList.toggle("active");   
        }
        btn_edit_cuenta.onclick=edit_cuenta;
        btn_hide_cuenta.onclick=reload;
        //el otro form
        const btn_edit_perfil=document.querySelector('#show-edit-perfil');
        let formu_perfil=document.querySelector('#perfil');
        const btn_hide_perfil=document.querySelector('#btn-perfil-hide')
        function edit_perfil() {
            fondo.classList.toggle("active");
            formu_perfil.classList.toggle("active");   
        }
        btn_edit_perfil.onclick=edit_perfil;
        btn_hide_perfil.onclick=reload;  

        //el otro form password
        const btn_password=document.querySelector('#btn-password');
        let formu_password=document.querySelector('#password');
        const btn_hide_password=document.querySelector('#btn-password-hide')
        function edit_password() {
            fondo.classList.toggle("active");
            formu_password.classList.toggle("active");   
        }
        btn_password.onclick=edit_password;
        btn_hide_password.onclick=reload; 

        //php ajax
        //funcion ajax de editar perfil
        $('#btn-guardar-perfil').click(function(){  
            if($("#tx_nombres").val().length ==0){
                $("#avisito-perfil").html('<h5 class="avisito error">Complete los campos requeridos</h5>')
            }
            else{
                var nombres=$('#tx_nombres').val();
                $.ajax({
                    type: "POST",
                    url: "edit_perfil.php",
                    data: {nombres},
                
                    success: function (r) {
                        $("#avisito-perfil").html(r); 
                        setTimeout(function(){
                            location.reload();
                        },1000);                      
                    }
                });
            }
            return false;
        }) 
        //funcion ajax de editar cuenta
        $('#btn-guardar-cuenta').click(function(){ 
            //onkeyup validar correo"
            emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;  
            if(!emailRegex.test(document.querySelector('#tx_correo').value)){ 
                $("#avisito-cuenta").html('<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Ingrese un correo válido.</h5>')
            }
            else if($("#tx_telefono").val().length !=9){
                $("#avisito-cuenta").html('<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i>El número de telefono debe tener 9 dígitos</h5>')
            }
            else{
                var telefono=$('#tx_telefono').val();
                var correo=$('#tx_correo').val();
                $.ajax({
                    type: "POST",
                    url: "edit_cuenta.php",
                    data: {telefono, correo},
                
                    success: function (r) {
                        $("#avisito-cuenta").html(r); 
                        setTimeout(function(){
                            location.reload();
                        },1000);                      
                    }
                });
            }
            return false;
        }) 
        //onkeyup=mayusculas"
        document.querySelector('#tx_nombres').onkeyup=function(){
            this.value=this.value.toUpperCase();
        }
        //onkeyup validar correo"
        document.querySelector('#tx_correo').onkeyup=function(){
            campo = event.target;    
            emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            //Se muestra un texto a modo de ejemplo, luego va a ser un icono
            if (emailRegex.test(campo.value)) {
                $("#avisito-cuenta").html('<h5 class="avisito ok"><i class="fa-solid fa-check"></i> Correo válido.</h5>')
            } else {
                $("#avisito-cuenta").html('<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Ingrese un correo válido.</h5>')
            }
        }

        //funcion ajax de editar password
        $('#btn-guardar-password').click(function(){ 
            var pa=$("#tx_password").val(); 
            var pn1=$("#tx_new_password1").val(); 
            var pn2=$("#tx_new_password2").val(); 
            if(pa.length==0 || pn1.length==0 || pn2.length==0){
                $("#avisito-password").html('<h5 class="avisito error"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Complete los campos requeridos</h5>')
            }
            else{
                var nombres=pa;
                $.ajax({
                    type: "POST",
                    url: "edit_pass.php",
                    data: {pa:pa, pn1:pn1, pn2:pn2},
                
                    success: function (r) {
                        $("#avisito-password").html(r);                      
                    }
                });
            }
            return false;
        }) 
    </script>
</body>
</html>