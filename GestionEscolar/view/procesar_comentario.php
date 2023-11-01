<?php
session_start();
include "../models/conexion.php"; // Asegúrate de incluir tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST["comentario"];
    $clase_id = $_POST["clase_id"];
    $estudiante_id = $_SESSION["estudiante_id"];

    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (comentario, clase_id, estudiante_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $comentario, $clase_id, $estudiante_id);

    if ($stmt->execute()) {
        // Comentario insertado exitosamente, puedes redirigir a la página actual o a otra
        header("Location: index_clase.php?id=$clase_id");
        exit();
    } else {
        echo "Error al insertar el comentario: " . $stmt->error;
    }

    $stmt->close();
}
?>
