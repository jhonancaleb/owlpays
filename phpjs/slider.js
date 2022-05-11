const slider=document.querySelector("#slider");
let sliderSection=document.querySelectorAll(".slider-section");
let sliderSectionLast=sliderSection[sliderSection.length -1];

const btnleft=document.querySelector("#btn-left");
const btnright=document.querySelector("#btn-right");

slider.insertAdjacentElement('afterbegin',sliderSectionLast);

function next(){
    let sliderSectionFirst = document.querySelectorAll(".slider-section")[0];
    slider.style.marginLeft="-120em";
    slider.style.transition="all 0.5s";
    setTimeout(function(){
        slider.style.transition="none";
        slider.insertAdjacentElement('beforeend',sliderSectionFirst);
        slider.style.marginLeft="-60em";
    },500);
}

function prev(){
    let sliderSection= document.querySelectorAll(".slider-section");
    let sliderSectionLast=sliderSection[sliderSection.length -1];
    slider.style.transition="all 0.5s";
    slider.style.marginLeft="0";
    setTimeout(function(){
        slider.style.transition="none";
        slider.insertAdjacentElement('afterbegin',sliderSectionLast);
        slider.style.marginLeft="-60em";
    },500);
}

btnright.addEventListener("click",function(){
    prev();
});

btnleft.addEventListener("click",function(){
    next();
});

setInterval(function(){
    next();
},5000)


//cookies
function aceptar(){
    document.querySelector('#fondo-cookie').style.display="none";
    //cookies
    localStorage.setItem('cookies-aceptadas', true);
}

if(localStorage.getItem('cookies-aceptadas')){
    document.querySelector('#fondo-cookie').style.display="none";
} 