// esperar carga de la pag
$(document).ready(function () {
    cargarEventos();
});

// Config del calendario FullCalendar
var calendar = $('#calendar').fullCalendar({
    editable: false,
    events: '../../../models/calendario/get_events.php',
    selectable: false,
    selectHelper: true,
});

// Cargar eventos 
function cargarEventos() {
    $.ajax({
        url: "../../../controllers/calendario/listar_eventos.php",
        method: "POST",
        success: function (data) {
            $("#eventos-lista").html(data);
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar los eventos: " + status);
        }
    });
}

// Eliminar eventos
function eliminarEvento(idEvento) {
    if (confirm("¿Estás seguro de que deseas eliminar este evento?")) {
        $.ajax({
            url: "../../../controllers/calendario/eliminar_evento.php?id=" + idEvento,
            method: "POST",
            success: function (response) {
                cargarEventos(); 
                // recargar lista de eventos al eliminar uno
                calendar.fullCalendar('refetchEvents');
            },
            error: function (xhr, status, error) {
                console.error("Error al eliminar el evento: " + status);
            }
        });
    }
}

// Mostrar contendorr
$("#eliminar_evento").click(function () {
    $("#paginacion_contenedor").show();
});

// Ocultar contendorr
$('#cancelar_evento').click(function () {
    $("#paginacion_contenedor").hide();
});
