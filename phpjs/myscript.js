/* function mayus();{
    this.value=this.value.toUpperCase();
} */
function valide(event){
    if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
}





