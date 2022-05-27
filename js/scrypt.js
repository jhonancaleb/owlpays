//funcion de animacion de formularios
function toggleForm(){
    let container=document.querySelector('.container');
    let bg=document.querySelector('.bg');
    let pass=document.querySelector('.passBx');
    pass.classList.remove('active')
    container.classList.toggle('active')
    bg.classList.toggle('active') 
    changeTitle();  
}
//funcion de animacion de formularios de password
function pass(){
    let pass=document.querySelector('.passBx');
    pass.classList.toggle('active');
    changeTitlepass();
}
//funcion cambiar title del html login register
var clic = 1;
function changeTitle(){ 
    if(clic==1){
       document.title="OwlPays|Register";
       clic = clic + 1;
    } 
    else{
        document.title="OwlPays|Login";
        clic = 1;
    }
}
//funcion cambiar title del html password
function changeTitlepass(){ 
    if(clic==1){
       document.title="OwlPays|Olvidé mi contraseña";
       clic = clic + 1;
    } 
    else{
        document.title="OwlPays|Login";
        clic = 1;
    }
}
//funcion que valida solo entrada de numeros
function valide(event){
    if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
}
//funcion ajax de registrar 
$('#btn-regis').click(function(){
    if($("#nombres").val().length ==0 || $("#correo").val().length ==0 || $("#password").val().length ==0){
        $("#aviso").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i>Por favor. Complete todos los datos.</h4>')
    }
    else if($("#tele").val().length !=9) {
        $("#aviso").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> El N° Teléfono debe tener 9 números.</h4>')
    }
    else if($("#dni").val().length !=8){
        $("#aviso").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i>El DNI debe tener 8 números.</h4>')
    }
    else{
        var datos=$('#formu-regis').serialize();
        $.ajax({
            type: "POST",
            url: "regis.php",
            data: datos,

            success: function (r) {
                $("#aviso").html(r);                      
            }
        });
    }
    return false;
}) 
document.getElementById('correo').addEventListener('input', function() {
    campo = event.target;
    
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
        $("#aviso").html('<h4 class="ok"><i class="fa-solid fa-check"></i> Correo válido.</h4>')
    } else {
        $("#aviso").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Ingrese un correo válido.</h4>')
    }
});


//furncion ajax de forghet password 
//funcion ajax de registrar 
$('#btn-pass').click(function(){
    if($("#usuarioxpassword").val().length ==0){
        $("#aviso-password").html('<h4 class="warning"><i class="fa fa-exclamation-triangle icon" aria-hidden="true"></i> Por favor. Escriba su DNI.</h4>')
    }
    else{
        var datos=$('#formu-forget').serialize();
        $.ajax({
            type: "POST",
            url: "forget.php",
            data: datos,

            success: function (r) {
                $("#aviso-password").html(r);                      
            }
        });
    }
    return false;
})