<?php
session_start();
include "../models/conexion.php"; 

// Verificar si el usuario ha iniciado sesión, de lo contrario, redirigir a la página de inicio de sesión
if (!isset($_SESSION["estudiante_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clase_id = $_GET["id"];
    $clave_admin = $_POST["clave_admin"];

    // Consultar la base de datos para obtener la clave de administrador de la clase
    $sql = "SELECT clave_admin FROM clases WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clase_id);
    $stmt->execute();
    $stmt->bind_result($clave_admin_db);
    $stmt->fetch();
    $stmt->close();

    // Verificar si la clave de administrador ingresada coincide con la clave de la base de datos
    if ($clave_admin === $clave_admin_db) {
        // Asignar una marca al usuario para indicar que ha administrado esta clase
        $_SESSION["clases_administradas"][$clase_id] = true;

        // Redirigir a la página de administración de la clase (reemplaza 'pagina_administracion.php' con la página real)
        header("Location: pagina_administracion.php?id=" . urlencode($clase_id));
        exit();
    } else {
        echo "Clave de administrador incorrecta. Por favor, inténtelo nuevamente.";
    }
}

// Aquí puedes mostrar un formulario de ingreso de clave de administrador si es necesario
?>
