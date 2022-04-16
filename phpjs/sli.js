let con=document.querySelector("#con-planes");
const btn=document.querySelector("#boton1");
const btn2=document.querySelector("#boton2");
const btn3=document.querySelector("#boton3");
function next(){
    /* con.style.transition="all 0.2s"; */
    setTimeout(function(){
    con.style.transition="all 0.2s";
    con.style.marginLeft="-63.3em";
    },500);
    
}
btn.addEventListener("click",function(){
    next();
});
btn2.addEventListener("click",function(){
    next();
});
btn3.addEventListener("click",function(){
    next();
});


