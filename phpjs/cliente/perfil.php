<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/buho2.png" type="image/ong">
    <link rel="stylesheet" href="../../css/perfil.css">
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
            <a href="area_client.php"><li><i class="fa-light fa-house"></i>Inicio</li></a>
            <a href="perfil.php"><li><i class="fa-regular fa-circle-user"></i>Mi perfil</li></a>
            <a href="suscripciones.php"><li><i class="fa-regular fa-list-check"></i>Mis suscripciones</li></a>
            <a href=""><li><i class="fa-regular fa-bell"></i>Notificaciones</li></a>
            <a href="../cerrar_sesion.php"><li><i class="fa-regular fa-right-from-bracket"></i>Salir</li></a>
        </ol>          
    </header>
    <main class="cuerpo">
        <h3>Mi Perfil</h3><hr>
        <div class="password">
            <div class="icono"><i class="fa-solid fa-key"></i></div>
            <a id="btn-password">Cambiar contraseña de seguridad</a>
        </div>
        <section class="cuadro perfil">
            <ul>
                <li class="title dark">Información de perfil</li>
                <li><p>Nombres completos</p><span class="dark">JHONAN MUÑOZ CARRILLO</span></li>
                <li><p>DNI(Nombre de usuario)</p><span class="dark">71749122</span></li>
            </ul>
            <a class="link" id="show-edit-perfil">Editar información de perfil</a>
        </section>
        <section class="cuadro cuenta">
            <ul>
                <li class="title dark">Información de la cuenta</li>
                <li><p>Dirección de correo electrónico</p><span class="dark">jhonancalen@gmail.com</span></li>
                <li><p>Número de celular </p><span class="dark">993884118</span></li>
            </ul>
            <a class="link" id="show-edit-cuenta">Editar información de la cuenta</a>
        </section>
    </main>
    <section id="fondo">
        <form action="post" id="perfil">
            <h4>Editar información de perfil</h4>
            <div class="content">
                <label for="" class="dark">DNI(Usuario)</label>
                <input type="text" class="campo" onkeypress="valide(event)" maxlength="8" minlength="8" readonly>
            </div>
            <div class="content">
                <label for="" class="dark">Nombres y Apellidos</label>
                <input type="text" class="campo" placeholder="Escriba nombres y apellidos completos">
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-perfil-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" type="submit" class="button" value="Guardar">
        </form>
        <form action="post" id="cuenta">
            <h4>Editar información de cuenta</h4>
            <div class="content">
                <label for="" class="dark">Correo electrónico</label>
                <input type="email" class="campo" placeholder="Escriba su dirección de correo electrónico">
            </div>
            <div class="content">
                <label for="" class="dark">Número de telefono</label>
                <input type="text" class="campo" onkeypress="valide(event)" maxlength="9" minlength="9" placeholder="Escriba su número telefónico">
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-cuenta-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" type="submit" class="button" value="Guardar">
        </form>
        <form action="post" id="password">
            <h4>Cambiar clave de seguridad</h4>
            <div class="content">
                <label for="" class="dark">Contraseña actual</label>
                <input type="password" class="campo" placeholder="Queremos saber si es usted">
            </div>
            <div class="content">
                <label for="" class="dark">Nueva contraseña</label>
                <input type="password" class="campo" placeholder="Cree su nueva clave de seguridad">
            </div>
            <div class="content">
                <label for="" class="dark">Confirme su nueva contraseña</label>
                <input type="password" class="campo" placeholder="Escriba de nuevo su clave de seguridad">
            </div>
            <input style="--color:#e44040" type="button" class="button" id="btn-password-hide" value="Cancelar">
            <input style="--color:var(--bg-cyan)" type="submit" class="button" value="Guardar">
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
        btn_hide_cuenta.onclick=edit_cuenta;
        //el otro form
        const btn_edit_perfil=document.querySelector('#show-edit-perfil');
        let formu_perfil=document.querySelector('#perfil');
        const btn_hide_perfil=document.querySelector('#btn-perfil-hide')
        function edit_perfil() {
            fondo.classList.toggle("active");
            formu_perfil.classList.toggle("active");   
        }
        btn_edit_perfil.onclick=edit_perfil;
        btn_hide_perfil.onclick=edit_perfil;  

        //el otro form password
        const btn_password=document.querySelector('#btn-password');
        let formu_password=document.querySelector('#password');
        const btn_hide_password=document.querySelector('#btn-password-hide')
        function edit_password() {
            fondo.classList.toggle("active");
            formu_password.classList.toggle("active");   
        }
        btn_password.onclick=edit_password;
        btn_hide_password.onclick=edit_password; 
    </script>
</body>
</html>