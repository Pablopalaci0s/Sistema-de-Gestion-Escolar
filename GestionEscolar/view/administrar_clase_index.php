<?php
session_start();

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Verificar si se recibió el ID de la clase por GET
if (!isset($_GET["id"])) {
    header("Location: classroom.php"); // Redirigir si no se proporciona un ID de clase
    exit();
}

$clase_id = $_GET["id"];
$estudiante_id = $_SESSION["estudiante_id"];

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar la información de la clase
$sqlClase = "SELECT * FROM clases WHERE id = ?";
$stmtClase = $conn->prepare($sqlClase);
$stmtClase->bind_param("i", $clase_id);
$stmtClase->execute();
$resultadoClase = $stmtClase->get_result();
$clase = $resultadoClase->fetch_assoc();
$stmtClase->close();

// Verificar si el usuario es el tutor de la clase
if ($estudiante_id != $clase["tutor_id"]) {
    // Si el usuario no es el tutor de la clase, redirigir a la página de inicio
    header("Location: classroom.php");
    exit();
}

// Aquí puedes agregar el código para administrar la clase como el tutor

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Clase - <?php echo $clase["nombre"]; ?></title>
    <link rel="stylesheet" href="../resources/css/administrar_clase.css">
</head>
<body>
    <!-- Aquí puedes agregar el contenido de la página de administración de la clase -->
    <h1>Administración de la Clase: <?php echo $clase["nombre"]; ?></h1>
    <!-- Agrega aquí los elementos y funcionalidades de administración -->
</body>
</html>
