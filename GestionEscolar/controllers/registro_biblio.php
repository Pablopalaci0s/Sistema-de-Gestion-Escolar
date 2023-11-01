<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recopilar los datos del formulario
$nombre = $_POST['nombre'];
$numero_identificacion = $_POST['numero_identificacion'];
$contrasena = $_POST['contrasena'];

// Insertar los datos en la tabla estudiantes_login sin el campo "rol"
$sql = "INSERT INTO estudiantes_login (nombre, numero_identificacion, contrasena) VALUES ('$nombre', '$numero_identificacion', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado con éxito";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
