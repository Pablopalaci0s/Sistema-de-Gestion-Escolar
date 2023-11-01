<?php
session_start();
include "../models/conexion.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $numero_identificacion = $_POST["numero_identificacion"];

    // Verificar las credenciales del estudiante de manera segura
    $sql = "SELECT id FROM estudiantes_login WHERE nombre = ? AND numero_identificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $numero_identificacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $estudiante_id = $row["id"];

        // Limpia el búfer de salida antes de redirigir
        ob_end_clean();

        // Establecer la variable de sesión
        $_SESSION["estudiante_id"] = $estudiante_id;

        // Redirigir al estudiante a la página principal de manera segura
        header("Location: biblioteca_estudiante.php?id=" . urlencode($estudiante_id));
        exit();
    } else {
        echo "Credenciales inválidas. Por favor, inténtelo nuevamente.";
    }
}
?>