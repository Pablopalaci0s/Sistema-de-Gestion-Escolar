
const botonAgregar2 = document.getElementById("botonagregar2");
const modal2 = document.getElementById("miModal2");
const botonCerrar2 = document.getElementById("botonCerrar2");

botonAgregar2.addEventListener("click", () => {
    modal2.style.display = "block";
});

botonCerrar2.addEventListener("click", () => {
    modal2.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal2) {
        modal2.style.display = "none";
    }
});



const botonAgregar = document.getElementById("botonagregar");
const modal = document.getElementById("miModal");
const botonCerrar = document.getElementById("botonCerrar");

botonAgregar.addEventListener("click", () => {
    modal.style.display = "block";
});

botonCerrar.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});



const botonAgregar3 = document.getElementById("botonagregar3");
const modal3 = document.getElementById("miModal3");
const botonCerrar3 = document.getElementById("botonCerrar3");

botonAgregar3.addEventListener("click", () => {
    modal3.style.display = "block";
});

botonCerrar3.addEventListener("click", () => {
    modal3.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal3) {
        modal3.style.display = "none";
    }
});

const botonAgregar4 = document.getElementById("botonagregar4");
const modal4 = document.getElementById("miModal4");
const botonCerrar4 = document.getElementById("botonCerrar4");

botonAgregar4.addEventListener("click", () => {
    modal4.style.display = "block";
});

botonCerrar4.addEventListener("click", () => {
    modal4.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal4) {
        modal4.style.display = "none";
    }
});


