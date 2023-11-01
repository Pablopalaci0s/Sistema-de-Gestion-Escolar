document.getElementById('contacto-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Detener el envío del formulario

    // Obtener los valores de los campos
    var nombre = document.getElementById('nombre-input').value;
    var correo = document.getElementById('correo-input').value;
    var mensaje = document.getElementById('mensaje-input').value;

    // Realizar validaciones
    if (nombre.trim() === '') {
        alert('Por favor, ingresa tu nombre.');
        return;
    }

    if (correo.trim() === '') {
        alert('Por favor, ingresa tu correo electrónico.');
        return;
    }

    if (mensaje.trim() === '') {
        alert('Por favor, ingresa un mensaje.');
        return;
    }

    // Envío del formulario si pasa todas las validaciones
    this.submit();
});
