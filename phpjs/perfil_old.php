<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="icon" href="../img/buho.png" type="image/png">
    <title>OwlPays|Mi perfil</title>
</head>
<body>
    <section class="container">
        <header class="head">
            <div class="logo">
                <img src="../img/buho.png" alt="buho">
                <label>OwlPays</label>
            </div>
        </header>
        <main class="container-perfil">
            <h1>Mi perfil</h1>
            <hr>
            <form class="datos" action="perfil.php method="post">
                <div class="div-campo">
                    <label for="">DNI</label>
                    <input type="text" class="campo" maxlength="8"  minlength="8" onkeypress="valide(event)" required>
                </div>
                <div class="div-campo">
                    <label for="">Nombres</label>
                    <input type="text" class="campo" required>
                </div>
                <div class="div-campo">
                    <label for="">Teléfono</label>
                    <input type="text" class="campo" maxlength="9"  minlength="9" onkeypress="valide(event)" required>
                </div>
                <div class="div-campo">
                    <label for="">Correo</label>
                    <input type="email" class="campo" required>
                </div>
                <div class="div-campo">
                    <label for="">Contraseña</label>
                    <input type="password" class="campo" id="password" required disabled><a onclick="habilitar()">Cambiar contraseña</a>
                </div>
                <div class="div-campo">
                    <input type="submit" class="submit" value="Guardar cambios">
                </div>
            </form>
            <a href="javascript:history.back(-1);" class="back">Regresar</a>
        </main>
    </section>
    <script>
        function valide(event){
            if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
        }
        function habilitar() {
            document.getElementById('password').disabled = false;
        }
    </script>
</body>
</html>