<?php
session_start();
include "../models/conexion.php"; 

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos (debes configurar tus propios datos de conexión)
$conn = new mysqli("localhost", "root", "", "users");

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clase_id = $_GET["id"]; // Obtener el ID de la clase desde la URL
    $codigo_acceso = $_POST["codigo_acceso"]; // Obtener el código de acceso enviado por el formulario

    // Consulta SQL para verificar si el código de acceso es válido
    $sql = "SELECT id FROM clases WHERE id = ? AND clave_acceso = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $clase_id, $codigo_acceso);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // El código de acceso es válido, por lo que el estudiante se une a la clase
        $_SESSION["clases_unidas"][$clase_id] = true; // Marcar la clase como unida

        // Redirigir a la página de índice de la clase
        header("Location: index_clase.php?id=" . $clase_id);
        exit();
    } else {
        // El código de acceso no es válido, mostrar un mensaje de error
        $error_message = "Código de acceso incorrecto. Por favor, inténtalo de nuevo.";
    }

    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unirse a una Clase</title>
    <link rel="stylesheet" href="../resources/css/classroom.css">
</head>
<body>
    <header>
        <span class="logo"><i class="ri-home-line"></i><span>Aula Virtual</span></span>
        <ul class="navbar">
            <li><a href="vista_classroom.php">Inicio</a></li>
        </ul>
        <div class="main">
            <a href="../controllers/login.php" class="user"><i class="ri-user-fill"></i>   <span>Bienvenido, <?php echo $nombreUsuario; ?></span></a>
        </div>
    </header>
    <div class="container">
        <h2>Unirse a una Clase</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="codigo_acceso">Código de Acceso:</label>
            <input type="text" name="codigo_acceso" required>
            <input type="submit" value="Unirse a la Clase">
        </form>
    </div>
</body>
</html>
