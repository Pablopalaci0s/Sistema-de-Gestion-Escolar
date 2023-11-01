<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    // Realizar las validaciones
    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        include("../view/contacto.html");
echo "<div class=\"alerta\">Error al enviar mensaje. <br> complete todos los campos.</div>";
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit;
    }

    // Procesar el formulario y almacenar en la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "users";

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar si hay errores de conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO tabla_contacto (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        include("../view/contacto.html");
        echo "<div class=\"bueno\">Gracias por contactarnos. <br> Nos pondremos en contacto contigo pronto.</div>";
    } else {
        echo "Error al procesar el formulario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
