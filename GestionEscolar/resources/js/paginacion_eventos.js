$(document).ready(function () {
  // Asignar eventos
  $('#pagina_anterior').click(function () {
    anteriorPagina();
  });
  $('#pagina_siguiente').click(function () {
    siguientePagina();
  });

  // Elementos a mostrar
  const listaPagina = 4;

  // Pagina actual
  let actualPag = 1;

  // Función para cargar eventos utilizando AJAX
  function cargarEventos() {
    $.ajax({
      url: 'listar_eventos.php',
      type: 'GET',
      success: function (data) {
        $('#eventos-lista').html(data); // Insertar la lista de eventos en el contenedor
        mostrarEventos(); // Mostrar solo los primeros 4 eventos
      },
      error: function (xhr, status, error) {
        console.error('Error al cargar eventos:', error);
      }
    });
  }

  // Mostrar pagina actual
  function mostrarEventos() {
    const inicioIndex = (actualPag - 1) * listaPagina;
    const finalIndex = inicioIndex + listaPagina;

    // Ocultar todos los eventos
    $('#eventos-lista li').hide();

    // Mostrar solo los eventos en el rango de la página actual
    $('#eventos-lista li').slice(inicioIndex, finalIndex).show();
  }

  // Pagina anterior
  function anteriorPagina() {
    if (actualPag > 1) {
      actualPag--;
      mostrarEventos();
    }
  }

  // Pagina siguiente
  function siguientePagina() {
    const totalPag = Math.ceil($('#eventos-lista li').length / listaPagina);
    if (actualPag < totalPag) {
      actualPag++;
      mostrarEventos();
    }
  }

  // Cargar eventos al iniciar
  cargarEventos();
});
