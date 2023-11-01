<?php
// Archivo: crear_clase.php
session_start();
include "../models/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $grado = $_POST["grado"];
    $seccion = $_POST["seccion"];
    $clave_acceso = $_POST["clave_acceso"];
    $clave_admin = $_POST["clave_admin"]; // Nueva línea

    // Verifica la clave de administración (puedes realizar más validaciones según tus necesidades)
    if ($clave_admin != "tu_clave_secreta") {
        echo "Clave de administración incorrecta.";
        exit();
    }

    // Inserta la nueva clase en la base de datos
    $sql = "INSERT INTO clases (nombre, grado, seccion, clave_acceso, clave_admin) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $grado, $seccion, $clave_acceso, $clave_admin);
    
    if ($stmt->execute()) {
        echo "Clase creada exitosamente.";
    } else {
        echo "Error al crear la clase: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
// Función para obtener el nombre del usuario desde la base de datos
function obtenerNombreUsuario($conn, $estudiante_id) {
    // Consultar la base de datos para obtener el nombre del usuario
    $sql = "SELECT nombre FROM estudiantes_login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $estudiante_id);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    $stmt->close();

    return $nombre;
}

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombreUsuario = obtenerNombreUsuario($conn, $_SESSION["estudiante_id"]);

// Consulta SQL para obtener las clases
$sqlClases = "SELECT * FROM clases";

// Ejecutar la consulta de las clases
$resultClases = $conn->query($sqlClases);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Clase</title>
    <link rel="stylesheet" href="../resources/css/crear_clase.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../resources/css/classroom.css">
</head>
<body>
<nav class="navbar">
      <div class="logo">
        <img src="../resources/img/logoo2.png" />
        <h2>Bright Horizon Academy</h2>
      </div>
      <div class="links">
      <a href="../view/vista_classroom.php">Inicio</a>
        <div class="dropdown">
          <a href="#"
            >Explore
            <img src="../resources/img/chevron.png" />
          </a>
          <div class="menu">
            <a href="../view/crear_clase.php"> Crea una clase! </a>
           
            
          </div>
        </div>
        <a href="../view/classroom.php" class="join-link"> Cerrar Sesión </a>
      </div>
    </nav>
<br><br><br><br><br>
    <div class="container">
        <h2>Crear una Clase</h2>
        <form action="procesar_creacion_clase.php" method="post">
            <label for="nombre">Nombre de la Clase:</label>
            <input type="text" name="nombre" required>

            <label for="grado">Grado:</label>
            <input type="text" name="grado" required>

            <label for="seccion">Sección:</label>
            <input type="text" name="seccion" required>

            <label for="clave_acceso">Clave de Acceso:</label>
            <input type="text" name="clave_acceso" required>

            <label for="clave_admin">Clave de Administración:</label>
            <input type="password" name="clave_admin" required> <!-- Campo de contraseña -->

            <input type="submit" value="Crear Clase">
        </form>
    </div>
</body>
</html>
