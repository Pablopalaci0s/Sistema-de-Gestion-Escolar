<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambiar si el servidor de la base de datos es diferente
$username = "root"; // Cambiar al usuario de la base de datos
$password = ""; // Cambiar a la contraseña de la base de datos
$dbname = "users"; // Cambiar al nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}
?>