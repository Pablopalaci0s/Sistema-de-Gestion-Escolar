$(document).ready(function () {
    const generarBtn = $("#generarBtn");

    const opcionesGenerar = $("#opcionesGenerar");

    generarBtn.click(function () {
        opcionesGenerar.slideDown();

        setTimeout(function () {
            opcionesGenerar.slideUp();
        }, 6000);

        
    });

});
