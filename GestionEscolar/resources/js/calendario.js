$(document).ready(function () {
    const calendar = $('#calendar').fullCalendar({
        editable: false,
        // cargar datos
        events: '../../../models/calendario/get_events.php',
        selectable: false,
        selectHelper: true,
    });

    // Mostrar el formulario al hacer clic en el botón "mostrar_Formulario"
    $("#mostrar_Formulario").click(function () {
        $("#formulario").show();

        // reset datos para evitar repeticion 
        $("#eventoFormulario")[0].reset();
    });

    // Ocultar formulario al hacer clic en el botón "cancelar"
    $('#cancelar').click(function () {
        $("#formulario").hide();
    });

    // Enviar el formulario al hacer clic en "Guardar"
    $("#eventoFormulario").submit(function (event) {
        event.preventDefault();

        // Obtener los valores del formulario
        const titulo = $("#titulo").val();
        const inicio = $("#inicio").val();
        const fin = $("#fin").val();

        // En caso de usuario "imprudente" validar los datos ingresados antes de enviarlos al servidor, en caso de quitar el required
        if (!titulo || !inicio || !fin) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Realizar una solicitud AJAX 
        $.ajax({
            url: '../../../controllers/calendario/guardar_evento.php',
            type: 'POST',
            data: {
                titulo: titulo,
                inicio: inicio,
                fin: fin
            },
            success: function (response) {
                // Recargar los eventos 
                calendar.fullCalendar('refetchEvents');
            },
            error: function () {
                alert("Error al guardar el evento. Inténtelo nuevamente.");
            }
        });

        // Ocultar el formulario después de enviar los datos
        $("#formulario").hide();
    });
});
