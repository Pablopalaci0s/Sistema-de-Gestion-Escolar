<?php
session_start();
include "../models/conexion.php"; // Asegúrate de incluir tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $grado = $_POST["grado"];
    $seccion = $_POST["seccion"];
    $clave_acceso = $_POST["clave_acceso"];
    
    // Obtener el ID del tutor de la sesión actual
    $tutor_id = $_SESSION["estudiante_id"];

    // Insertar la clase en la base de datos
    $sql = "INSERT INTO clases (nombre, grado, seccion, clave_acceso, tutor_id, clave_admin) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $nombre, $grado, $seccion, $clave_acceso, $tutor_id, $tutor_id);

    if ($stmt->execute()) {
        // La clase se ha creado exitosamente. Redirigir al índice correspondiente.
        $_SESSION["clases_unidas"][$conn->insert_id] = true; // Guardar que el usuario se unió a esta clase
        header("Location: ../view/vista_classroom.php");
        exit();
    } else {
        echo "Error al crear la clase: " . $stmt->error;
    }

    $stmt->close();
}
?>
