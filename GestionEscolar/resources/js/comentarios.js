var textoAyuda;
var arregloAyuda=[
    "Ingrese su nombre en <br>este campo de texto",
    "Ingrese su dirección de <br>correo electrónico  en el <br> formato  usuario@dominio.com",
    "Ingrese su comentario",
];

function inic(){
    textoAyuda = document.getElementById("textoAyuda");
    registrarEscuchas(document.getElementById("firstname"), 0);
    registrarEscuchas(document.getElementById("email"), 1);
    registrarEscuchas(document.getElementById("describe"), 2);

}

function registrarEscuchas(objeto, numeroMensaje){
    objeto.addEventListener("focus", function(){
        textoAyuda.style.visibility = "visible";
        textoAyuda.innerHTML = arregloAyuda[numeroMensaje];
    }, false);
    objeto.addEventListener("blur", function(){
        textoAyuda.style.visibility = "hidden";
        textoAyuda.innerHTML = arregloAyuda[9];
    }, false);
}

window.addEventListener("load", inic, false);