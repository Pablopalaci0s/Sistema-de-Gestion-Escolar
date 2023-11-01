  // Función para manejar la actualización de datos de pago
  function actualizarDatosPago(pagoId, nuevoMes, nuevoEstado) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_datos_pago.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
            } else {
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send('pagoId=' + pagoId + '&mes=' + nuevoMes + '&estado=' + nuevoEstado);
}

// Manejar la lógica de cambio de estado cuando se selecciona un nuevo estado
var estadoSelects = document.getElementsByClassName('estado-select');
for (var i = 0; i < estadoSelects.length; i++) {
    estadoSelects[i].addEventListener('change', function () {
        var selectedValue = this.value;
        var pagoId = this.getAttribute('data-pago-id');
        
        // Obtener el mes actual seleccionado para el pago
        var mesSelect = document.querySelector('[data-pago-id="' + pagoId + '"] .mes-select');
        var selectedMes = mesSelect.options[mesSelect.selectedIndex].value;
        
        actualizarDatosPago(pagoId, selectedMes, selectedValue);
    });
}